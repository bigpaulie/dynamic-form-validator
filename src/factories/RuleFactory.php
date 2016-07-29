<?php

namespace bigpaulie\form\factories;

use bigpaulie\form\exceptions\InvalidRuleException;
use bigpaulie\form\rules\EmailRule;
use bigpaulie\form\rules\Rule;
use bigpaulie\form\rules\StringRule;

/**
 * Class RuleFactory
 * @package bigpaulie\form\factories
 */
class RuleFactory
{
    /**
     * Available rules
     * @var array $rules
     */
    private $rules = [
        'string' => StringRule::class,
        'email'  => EmailRule::class,
    ];

    private $type = null;

    /**
     * RuleFactory constructor.
     * @param $type
     * @throws InvalidRuleException
     */
    public function __construct($type)
    {
        /**
         * Check if the rule exists
         * otherwise throw an InvalidRuleException
         */
        if ( !array_key_exists(strtolower($type), $this->rules) ) {
            throw new InvalidRuleException("The rule: {$type} doesn't exist.", 500);
        } else {
            $this->type = $type;
        }
    }

    /**
     * Make validator
     * @return Rule
     */
    public function make() {
        return new $this->rules[$this->type]();
    }
}