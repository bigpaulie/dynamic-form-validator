<?php

namespace bigpaulie\form;

use bigpaulie\form\factories\RuleFactory;

class Validator {

    /**
     * Validation rules
     * @var array $_rules
     */
    private $_rules = [];

    /**
     * Validation errors
     * @var array $_errors
     */
    private $_errors = [];

    /**
     * HTTP Request data
     * @var null $_request
     */
    private $_request = null;

    /**
     * Set validation rules
     * @param $rules
     * @return $this
     */
    public function setRules($rules) {
        $this->_rules = $rules;
        return $this;
    }

    /**
     * RuleFactory
     * @var null|RuleFactory
     */
    private $factory = null;

    /**
     * Validator constructor.
     * @param RuleFactory $factory
     */
    public function __construct(RuleFactory $factory)
    {
        $this->factory = $factory;
    }

    /**
     * Set request data
     * @param $request
     * @return $this
     */
    public function setRequest($request) {
        $this->_request = $request;
        return $this;
    }

    /**
     * Get validation errors
     * @return array
     */
    public function getErrors() {
        return $this->_errors;
    }

    /**
     * Run the validation
     * @return bool
     */
    public function run() {
        
        foreach ( $this->_request as $key => $val ) {
            
            /**
             * Iterate through all rules and 
             * determine if this field is valid
             */
            foreach ( $this->_rules as $rule => $value ) {
                /**
                 * Check field name 
                 */
                if ( preg_match($rule , $key) ) {

//                    $factory = new RuleFactory($value);
                    $validator = $this->factory->make($value);

                    if ( !$validator->run($val) ) {
                        $this->_errors[] = sprintf('The field %s is invalid', $key);
                    }

                }
            }

        }

        /**
         * If we have errors 
         * return false and invalidate de form
         */
        if( count($this->_errors) != 0 ) {
            return false;
        }

        return true;
    }

}
