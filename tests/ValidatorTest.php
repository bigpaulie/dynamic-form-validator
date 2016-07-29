<?php

use bigpaulie\form\Validator;

class ValidatorTest extends \PHPUnit_Framework_TestCase {

    public $validator;

    public function setUp() {
        $this->validator = new Validator();
    }

    /**
     * Throw an exception on an invalid validator
     * @expectedException \bigpaulie\form\exceptions\InvalidRuleException
     */
    public function testShouldThrowInvalidRuleException() {
        $data = ['name_1' => 'just a name'];
        $rule = ['/name_([0-9]+)/i' => 'invalid_validator'];

        $this->validator->setRequest($data)->setRules($rule);
        $this->validator->run();
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

}
