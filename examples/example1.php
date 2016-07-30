<?php

require_once '../vendor/autoload.php';

use bigpaulie\form\Validator;

$rules = [
    '/name_([0-9]+)/i'  => 'string',
    '/email_([0-9]+)/i' => 'email',
    '/date_([0-9]+)/i' => 'date',
];

$data = [
    'name_1' => 'Paul',
    'date_1' => '07/28/2016',
    'email_1' => 'paul@domain.com',
    'name_2' => 'John',
    'date_2' => '06/01/2016',
    'email_2' => 'john@ydomain.co.uk',
];


$form = new Validator();
$form->setRules($rules)
     ->setRequest($data);

try {
    if ( $form->run() ) {
        echo "Success";
    } else {
        echo "Error";
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}

