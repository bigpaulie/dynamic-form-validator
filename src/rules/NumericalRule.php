<?php
/**
 * Created by PhpStorm.
 * User: paul
 * Date: 30.07.2016
 * Time: 13:05
 */

namespace bigpaulie\form\rules;


class NumericalRule implements Rule
{
    /**
     * Numerical matching pattern
     * @var string $pattern
     */
    private $pattern = '/^([0-9\.]+)$/';

    /**
     * Validate the given value
     * @param $value
     * @return mixed
     */
    public function run($value)
    {
        if ( !preg_match($this->pattern, $value) ) {
            return false;
        }

        return true;
    }
}