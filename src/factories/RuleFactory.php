<?php

namespace bigpaulie\form\factories;

use bigpaulie\form\exceptions\InvalidRuleException;
use bigpaulie\form\rules\DateRule;
use bigpaulie\form\rules\EmailRule;
use bigpaulie\form\rules\NumericalRule;
use bigpaulie\form\rules\PasswordRule;
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
        'string'    => StringRule::class,
        'email'     => EmailRule::class,
        'date'      => DateRule::class,
        'numerical' => NumericalRule::class,
        'password'  => PasswordRule::class,
    ];

    /**
     * Validator type
     * @var null|string $type
     */
    private $type = null;

    /**
     * RuleFactory constructor.
     */
    public function __construct() {}

    /**
     * Make Validator
     * @param $type
     * @return mixed
     * @throws InvalidRuleException
     */
    public function make($type) {

        /**
         * Check if the rule exists
         * otherwise throw an InvalidRuleException
         */
        if ( !array_key_exists(strtolower($type), $this->rules) ) {
            throw new InvalidRuleException("The rule: {$type} doesn't exist.", 500);
        } else {
            $this->type = $type;
        }

        return new $this->rules[$this->type]();
    }
}