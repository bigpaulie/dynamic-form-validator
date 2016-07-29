<?php

namespace bigpaulie\form\rules;


interface Rule
{
    /**
     * Validate the given value
     * @param $value
     * @return mixed
     */
    public function run($value);
}