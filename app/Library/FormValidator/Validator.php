<?php

namespace App\Library\FormValidator;

class Validator {

    private $_rules = [];
    private $_errors = [];
    private $_request = null;

    public function setRules($rules) {
        $this->_rules = $rules;
        return $this;
    }

    public function setRequest($request) {
        $this->_request = $request;
        return $this;
    }

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
                   /**
                    * Check field value
                    */
                    if ( !preg_match($value, $val) ) {
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
