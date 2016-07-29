<?php

require_once 'vendor/autoload.php';

use bigpaulie\Form\Validator;

$rules = [
    '/name_([0-9]+)/i' => '/(.*)/i',
    '/date_([0-9]+)/i' => '/^([0-9]{1,2}\/[0-9]{1,2}\/[0-9]{4})$/i'
];

$data = [
    'name_1' => 'Paul',
    'date_1' => '07/28/2016',
    'name_2' => 'Dan',
    'date_2' => '06/01/2016',
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
} catch (\Error $e) {
    echo $e->getMessage();
}

