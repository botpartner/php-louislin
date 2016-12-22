<?php
/**
 */
namespace JYYAN\Tests;

use JYYAN\ElizaBot;
use JYYAN\ElizaBot\Charactor\Human;

class SentimentTest extends \PHPUnit_Framework_TestCase
{
  /*
   * @ElizaBot
   * */
    public $bot;


    public function setUp()
    {
        $this->bot = new ElizaBot();
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

    public function testSentimantElement()
    {
        //var_dump($this->bot->eliza);
        $unknow =& $this->bot->eliza->unknow;
        $unknow->add(1)->set(5);
        $this->assertEquals('5', $unknow);
        $unknow->add(-1);
        $this->assertEquals('4', $unknow);
        $unknow->add(-1);
        $this->assertEquals('3', $unknow);
    }

    public function testSentimantManger()
    {
        $unknow  =& $this->bot->eliza->unknow;
        $manager =& $this->bot->eliza;

        $manager->apply([
        'normal'=>10,
        'unknow'=>11,
        'anger' =>12,
        'disqust'=>13,
        'fear'   =>14,
        'happiness'=>15,
        'sadness'=>16,
        'surprise'=>17
        ]);

        $this->assertEquals('10', $manager->normal);
        $this->assertEquals('11', $manager->unknow);
        $this->assertEquals('12', $manager->anger);
        $this->assertEquals('13', $manager->disqust);
        $this->assertEquals('14', $manager->fear);
        $this->assertEquals('15', $manager->happiness);
        $this->assertEquals('16', $manager->sadness);
        $this->assertEquals('17', $manager->surprise);

        $manager->add([
        'normal'=>-10,
        'unknow'=>-11,
        'anger' =>-12,
        'disqust'=>-13,
        'fear'   =>-14,
        'happiness'=>-15,
        'sadness'=>-16,
        'surprise'=>-17
        ]);

        $this->assertEquals('0', $manager->normal);
        $this->assertEquals('0', $manager->unknow);
        $this->assertEquals('0', $manager->anger);
        $this->assertEquals('0', $manager->disqust);
        $this->assertEquals('0', $manager->fear);
        $this->assertEquals('0', $manager->happiness);
        $this->assertEquals('0', $manager->sadness);
        $this->assertEquals('0', $manager->surprise);
    }


    public function testSentimantDi()
    {
        $bot = $this->bot;

        $sentiments = ['HappyDog' , 'HappyDog1'];
        $bot->set('human', new Human($sentiments));

        $this->assertObjectHasAttribute('happydog', $bot->human);
        $this->assertObjectHasAttribute('happydog1', $bot->human);
        $this->assertObjectNotHasAttribute('happydog', $bot->eliza);

        $bot->addSenti('HappyDog')->update();
        $this->assertObjectHasAttribute('happydog', $bot->human);
        $this->assertObjectNotHasAttribute('happydog1', $bot->human);
        $this->assertObjectHasAttribute('happydog', $bot->eliza);
    }
}
