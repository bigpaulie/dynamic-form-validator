<?php

namespace bigpaulie\form\rules;

/**
 * Class StringRule
 * Validates strings of characters composed of
 * letters lower case and upper case, numbers,
 * dots and hyphens
 *
 * @package bigpaulie\form\rules
 */
class StringRule implements Rule
{
    /**
     * Validation patter
     * @var string $pattern
     */
    private $pattern = '/^([a-zA-Z0-9\.\-\s]+)$/';

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