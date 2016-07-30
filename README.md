# dynamic-form-validator [![Build Status](https://travis-ci.org/bigpaulie/dynamic-form-validator.svg?branch=master)](https://travis-ci.org/bigpaulie/dynamic-form-validator)

This is a simple PHP library for dynamic form validation.
It was written with my own needs in mind, it may not be the best library but it does the job for me.

### Installation
Install the package via composer using :

```
composer require --prefer-dist bipaulie/dynamic-form-validation
```

### Usage

First you should get an instance for the validator, pass it the rules array and data to be validated.

```
$rules = ['/input_name_([0-9]+)/i' => 'filter_name'];

$validator = new Validator();
$validator->setRules($rules)->setRequest($request);

try {
    if ( $validator->run() ) {
        echo "Validation successful.";
    } else {
        echo "Validation failed.";
    }
} catch ( \Exception $e ) {
    echo $e->getMessage();
}

```

### Available filters

#### String validation
The "string" filter validates strings of characters containging : letters, numbers, spaces, dots and hyphens.

#### Date validation
The "date" filter validates dates of the follwing formats :

    * d/m/Y
    * m/d/Y
    * d/m/y
    * m/d/y
    
#### Email validation
The "email" filter validates email addresses 

#### Numeric validation
The "numerical" filter validates numerical values such as integers and floats

#### Password validation
The "password" filter validates passwords of the following format:
- Has at least one uppercase letter
- Has at least one number
- Has at least one special character (!,@,#,$)
- Is at least 8 characters long

#### Examples
Checkout the examples directory form some examples on how to use the validator.

#### Contribution
If you like the library and you feel like something is missing or fix a potential bug, please feel free to submit a 
pull request, if I like your idea or it's useful I will merge it with the repository.

A final note about this library.
I'm using "git flow" to manage this repository, the main branch here is called "**develop**" not master.

**Thank you for using and contributing.**
