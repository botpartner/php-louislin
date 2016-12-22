<?php
/**
 */
namespace JYYAN\Tests;

use JYYAN\ElizaBot;
use JYYAN\ElizaBot\Message\Rule;
use JYYAN\ElizaBot\Adapter\SimpleNLP\Knowlege;
use JYYAN\Config;
use Google\Cloud\Translate\TranslateClient;

class ElizaBotTest extends \PHPUnit_Framework_TestCase
{
    /*
     * @ElizaBot
     * */
    public $bot;


    public function setUp()
    {
        $opts = array(
            'elizaKnowlegeBase'=>$this->getCharKnowlege(),
            'humanKnowlegeBase'=> $this->getCharKnowlege(),
            'snlpKnowlegeBase'=> $this->getSnlpKnowlege()
        );

        $this->bot = new ElizaBot($opts);
    }

    public function tearDown()
    {
        unset($this->bot);
    }

    /**
     */
    public function testElizaBotSentimantAPI()
    {
        $bot =& $this->bot;


        $this->assertEquals('Eliza', $bot->eliza->name);
        $this->assertEquals('Human', $bot->human->name);

        $bot->setHumanName('Lily');
        $this->assertEquals('Lily', $bot->human->name);

        $bot->setElizaName('Luke');
        $this->assertEquals('Luke', $bot->eliza->name);
    }

    public function testNLPapi()
    {
        $bot =& $this->bot;

        $api = $bot->eliza->nlp;
        $result = new \JYYAN\ElizaBot\Adapter\SimpleNLP\Result();

        $result->join = $api->push("why the sky is blue?");
        $result->join = $api->push("im so happy now");
        $result->join = $api->push("you r so great");
        $result->join = $api->push("i hate u");

        $this->assertObjectHasAttribute('happiness', $result);
        $this->assertObjectHasAttribute('command', $result);
        $this->assertEquals(200, $result->happiness->value);


        $bot->eliza->receive("why the sky is blue?");
        $bot->eliza->receive("im so happy now");
        $bot->eliza->receive("you r so great");
        $bot->eliza->receive("i hate u");

        $this->assertObjectHasAttribute('happiness', $result);
        $this->assertObjectHasAttribute('command', $result);
        $this->assertEquals(180, $bot->eliza->happiness->value);

        $bot->eliza->receive("why the sky is blue?");
        $bot->eliza->receive("im so happy now");
        $bot->eliza->receive("you r so great");
        $this->assertEquals(100, $bot->eliza->disqust->value);

        $bot->eliza->receive("you are so powerful")->think();
    }

    public function testConfig()
    {
        $config = new Config([
            'a'=>'aa',
            'b'=>'bb',
            'c'=>'cc',
            'd'=>'dd',
            'e'=>[
                'aa'=>'aaa',
                'bb'=>'bbb'
            ]
        ]);

        //var_dump($config);
        $this->assertEquals('aa', $config->a);
        $this->assertEquals('bb', $config->b);
        $this->assertEquals('cc', $config->c);
        $this->assertEquals('dd', $config->d);

        $this->assertEquals('aaa', $config->e->aa);
        $this->assertEquals('bbb', $config->e->bb);

        $config->set('f', 'ff');
        $this->assertEquals('ff', $config->f);

        $config->set('f', ['aa'=>'aaa']);
        $this->assertEquals('aaa', $config->f->aa);
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

    public function getCharKnowlege()
    {
        $result = array();

        $rule = new Rule();
        $rule->key = "happy";
        $rule->key = "great";
        $rule->img = "001.PNG"; // pic id , pic name
        $rule->happiness = 100;
        $rule->happiness->setRule("gt");
        $result[]=$rule;

        $rule = new Rule();
        $rule->key = "wtf";
        $rule->img = "001.PNG"; // pic id , pic name
        $rule->anger = 100;
        $rule->anger->setRule('gt');
        $result[]=$rule;

        $rule = new Rule();
        $rule->key = "hate";
        $rule->img = "001.PNG"; // pic id , pic name
        $rule->disqust= 100;
        $rule->disqust->setRule('gt');
        $result[]=$rule;


        $rule = new Rule();
        $rule->key = "sad";
        $rule->img = "001.PNG"; // pic id , pic name
        $rule->sadness= 100;
        $rule->sadness->setRule('gt');
        $result[]=$rule;


        $rule = new Rule();
        $rule->key = "surprise";
        $rule->img = "001.PNG"; // pic id , pic name
        $rule->surprise= 100;
        $rule->surprise->setRule('gt');
        $result[]=$rule;


        $rule = new Rule();
        $rule->key = "why";
        $rule->key = "?";
        $rule->img = "001.PNG"; // pic id , pic name
        $rule->command = 100;
        $rule->command->setRule('gt');
        $result[]=$rule;

        $rule = new Rule();
        $rule->img = "001.PNG"; // pic id , pic name
        $rule->unknow = 90 ;
        $rule->unknow->setRule("gt");
        $result[]=$rule;

        return $result;
    }
}
