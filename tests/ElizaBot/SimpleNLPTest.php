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
use JYYAN\ElizaBot\Adapter\SimpleNLP;
use JYYAN\ElizaBot\Adapter\SimpleNLP\Knowlege;
use JYYAN\ElizaBot\Adapter\SimpleNLP\Result;

class SimpleNLPTest extends \PHPUnit_Framework_TestCase
{
    public $api;

    public function setUp()
    {
        $this->api = new SimpleNLP();
        $this->api->knowlegeBase = $this->getSnlpKnowlege();
    }

    public function tearDown()
    {
    }

    public function testAPI()
    {
        $api = $this->api;
        $result = new Result();

        $result->join = $api->push("why the sky is blue?");
        $result->join = $api->push("im so happy now");
        $result->join = $api->push("you r so great");
        $result->join = $api->push("i hate u");

        $this->assertObjectHasAttribute('happiness', $result);
        $this->assertObjectHasAttribute('command', $result);
        $this->assertEquals(200, $result->happiness->value);
    }

    public function testRule()
    {
        $rule = new Knowlege();

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

    public function getSnlpKnowlege()
    {
        $result = array();

        $rule = new Knowlege();
        $rule->key = "happy";
        $rule->key = "great";
        $rule->happiness = 100;
        $result[]=$rule;

        $rule = new Knowlege();
        $rule->key = "wtf";
        $rule->anger = 100;
        $result[]=$rule;

        $rule = new Knowlege();
        $rule->key = "hate";
        $rule->disqust= 100;
        $result[]=$rule;


        $rule = new Knowlege();
        $rule->key = "sad";
        $rule->sadness= 100;
        $result[]=$rule;


        $rule = new Knowlege();
        $rule->key = "surprise";
        $rule->surprise= 100;
        $result[]=$rule;

        $rule = new Knowlege();
        $rule->key = "why";
        $rule->key = "?";
        $rule->command = 100;
        $result[]=$rule;

        return $result;
    }
}
