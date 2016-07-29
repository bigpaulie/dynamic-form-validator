<?php

namespace bigpaulie\form\rules;

/**
 * Class EmailRule
 * Validate email addresses
 * @package bigpaulie\form\rules
 */
class EmailRule implements Rule
{

    /**
     * Validation pattern
     * @var string
     */
    private $pattern = '/^([a-z0-9\.]+\@[a-z0-9\.\-]+\.[a-z\.]{2,4})$/i';

    /**
     * Run the validation
     * @param $value
     * @return bool
     */
    public function run($value)
    {
        if ( preg_match($this->pattern, $value) ) {
            return true;
        } else {
            return false;
        }
    }
}