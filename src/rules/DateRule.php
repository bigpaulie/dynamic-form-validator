<?php
/**
 * Created by PhpStorm.
 * User: paul
 * Date: 29.07.2016
 * Time: 23:14
 */

namespace bigpaulie\form\rules;


class DateRule implements Rule
{

    private $pattern = [
        '/^[0-9]{1,2}\/[0-9]{1,2}\/[0-9]{2,4}$/i'
    ];

    /**
     * Validate the given value
     * @param $value
     * @return mixed
     */
    public function run($value)
    {
        foreach ( $this->pattern as $pattern )
        {
            if ( preg_match($pattern, $value) ) {
                return true;
            }
        }

        return false;
    }
}