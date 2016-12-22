<?php
/**
 */
namespace JYYAN\Tests;

use JYYAN\ElizaBot;
use JYYAN\ElizaBot\Charactor\Humen;
use JYYAN\ElizaBot\Message\Rule;
use JYYAN\ElizaBot\Message\Fact;
use JYYAN\ElizaBot\Message\StdMessage;
use JYYAN\ElizaBot\Message\Manager;

class RuleManagerTest extends \PHPUnit_Framework_TestCase
{

    public function setUp()
    {
    }
    public function tearDown()
    {
    }

    public function testRule()
    {
        $rule = new Rule();

        $rule->key = "Google";
        $rule->key = "great";
        $rule->key = "great";
        $rule->key = "great";

        $rule->msg = "hello world!";
        $rule->msg = "world!";
        $rule->msg = "hello !";
        $rule->msg = "foo bar !";

        $rule->img = "IMG_15425";
        $rule->img = "IMG_15888";
        $rule->img = "IMG_15444";
        $rule->img = "IMG_15555";

        $rule->happiness = 15;
        $rule->happiness->setRule('lt');

        $rule->sadness= 10;
        $rule->sadness->setRule('eq');

        $this->assertEquals("Google", $rule->keys[0]);
        $this->assertEquals("great", $rule->keys[2]);

        $this->assertEquals("hello world!", $rule->messages[0]);
        $this->assertEquals("foo bar !", $rule->messages[3]);

        $this->assertObjectHasAttribute('happiness', $rule);
        $this->assertObjectHasAttribute('sadness', $rule);
        $this->assertObjectHasAttribute('rule', $rule->sadness);
        $this->assertEquals('eq', $rule->sadness->rule);
    }


    public function testFact()
    {
        $facts = new Fact();
    }

    public function testRuleWithFact()
    {
    }

    public function testManager()
    {
        $manager = new Manager();
    }

    public function testStdMessage()
    {
        $message = new StdMessage();
    }
}
