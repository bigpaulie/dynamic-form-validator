<?php

use bigpaulie\form\factories\RuleFactory;
use bigpaulie\form\rules\Rule;
use bigpaulie\form\exceptions\InvalidRuleException;

class RuleFactoryTest extends \PHPUnit_Framework_TestCase
{

    public $factory;

    public function setUp()
    {
        $this->factory = new RuleFactory();
    }

    /**
     * This test should pass
     * factory should return an instance on Rule
     */
    public function testShouldReturnInstanceOfRule() {
        $this->assertInstanceOf(Rule::class, $this->factory->make('string'));
    }

    /**
     * This test should fail
     * it should throw an InvalidRuleException
     * @expectedException \bigpaulie\form\exceptions\InvalidRuleException
     */
    public function testShouldThrowInvalidRuleException() {
        $this->factory->make('unknown_rule');
    }

}