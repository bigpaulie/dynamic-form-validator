<?php

use bigpaulie\form\Validator;
use bigpaulie\form\factories\RuleFactory;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

    public $validator;

    public function setUp() {
        $factory = new RuleFactory();
        $this->validator = new Validator($factory);
    }

    /**
     * This test should validate a simple string
     */
    public function testShouldValidateString() {
        $data = ['name_1' => 'just a name'];
        $rule = ['/name_([0-9]+)/i' => 'string'];

        $this->validator->setRequest($data)->setRules($rule);
        $this->assertTrue($this->validator->run());
    }

    /**
     * This test should invalidate a simple string
     */
    public function testShouldInvalidateString() {
        $data = ['name_1' => 'just a name%^***'];
        $rule = ['/name_([0-9]+)/i' => 'string'];

        $this->validator->setRequest($data)->setRules($rule);
        $this->assertFalse($this->validator->run());
    }

    /**
     * This test should validate the email addresses in the array
     */
    public function testShouldValidateEmailArray() {
        $data = [
            'email_1' => 'user@domain.com',
            'email_2' => 'user@domain.co.uk',
            'email_3' => 'user@domain.me',
            'email_4' => 'user@domain.info'
        ];

        $rule = ['/email_([0-9]+)/i' => 'email'];
        $this->validator->setRequest($data)->setRules($rule);
        $this->assertTrue($this->validator->run());
    }

    /**
     * This test should invalidate emails
     * containing illegal characters
     */
    public function testShouldInvalidateEmailWithIllegalCharacters() {
        $data = ['email_1' => 'user**@domain.com'];
        $rule = ['/email_([0-9]+)/i' => 'email'];
        $this->validator->setRequest($data)->setRules($rule);
        $this->assertFalse($this->validator->run());
    }

    /**
     * This test should invalidate emails
     * containing spaces
     */
    public function testShouldInvalidateEmailWithSpaces() {
        $data = ['email_1' => 'user @domain.com'];
        $rule = ['/email_([0-9]+)/i' => 'email'];
        $this->validator->setRequest($data)->setRules($rule);
        $this->assertFalse($this->validator->run());
    }

    /**
     * This test should invalidate emails
     * with wrong tld's
     */
    public function testShouldInvalidateEmailWithWrongTld() {
        $data = ['email_1' => 'user@localhost.localdomain'];
        $rule = ['/email_([0-9]+)/i' => 'email'];
        $this->validator->setRequest($data)->setRules($rule);
        $this->assertFalse($this->validator->run());
    }

    /**
     * This test should invalidate emails
     * without tld's
     */
    public function testShouldInvalidateEmailWithoutTld() {
        $data = ['email_1' => 'user@localhost'];
        $rule = ['/email_([0-9]+)/i' => 'email'];
        $this->validator->setRequest($data)->setRules($rule);
        $this->assertFalse($this->validator->run());
    }

    /**
     * This test should validate dates
     */
    public function testShouldValidateDate() {
        $data = [
            'date_1' => '29/07/2016',
            'date_2' => '07/29/2016',
            'date_3' => '7/29/2016',
            'date_4' => '7/1/2016',
            'date_5' => '7/1/16',
        ];

        $rule = ['/date_([0-9]+)/i' => 'date'];
        $this->validator->setRequest($data)->setRules($rule);
        $this->assertTrue($this->validator->run());
    }

    /**
     * This test should invalidate dates
     */
    public function testShouldInvalidateDate() {
        $data = ['date_1' => '2016/07/29'];
        $rule = ['/date_([0-9]+)/i' => 'date'];

        $this->validator->setRequest($data)->setRules($rule);
        $this->assertFalse($this->validator->run());
    }

    /**
     * This test should validate numerical values
     * such as integers and floats
     */
    public function testShouldValidateNumericalValues() {
        $data = [
            'number_1' => '10',
            'number_2' => '3.5',
        ];

        $rule = ['/number_([0-9]+)/i' => 'numerical'];
        $this->validator->setRequest($data)->setRules($rule);
        $this->assertTrue($this->validator->run());
    }

    /**
     * This test should invalidate non-numerical values
     */
    public function testShouldInvalidateNonNumericalValues() {
        $data = ['number_1' => 'test'];

        $rule = ['/number_([0-9]+)/i' => 'numerical'];
        $this->validator->setRequest($data)->setRules($rule);
        $this->assertFalse($this->validator->run());
    }

    /**
     * This test should validate passwords
     * containing :
     * At least one uppercase letter
     * At least one number
     * At least one special character
     * Is at least 8 characters long
     */
    public function testShouldValidatePassword() {
        $data = [
            'password_1' => 'SomeCrazyPass0rd@123',
            'password_2' => 'anoth3rCrazyPassw0rd#321'
        ];

        $rule = ['/password_([0-9]+)/i' => 'password'];
        $this->validator->setRequest($data)->setRules($rule);
        $this->assertTrue($this->validator->run());
    }

    /**
     * This test should invalidate any password
     * that doesn't comply with the requirements
     * mentioned above
     */
    public function testShouldInvalidatePassword() {
        $data = [
            'password_1' => 'password',
        ];

        $rule = ['/password_([0-9]+)/i' => 'password'];
        $this->validator->setRequest($data)->setRules($rule);
        $this->assertFalse($this->validator->run());
    }

}
