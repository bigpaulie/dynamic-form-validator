<?php

namespace bigpaulie\form\rules;


class PasswordRule implements Rule
{

    /**
     * Password matching pattern
     * @var string $pattern
     */
    private $pattern = '/(?=^.{8,}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/';

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