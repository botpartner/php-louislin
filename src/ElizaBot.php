<?php
namespace JYYAN;

use JYYAN\ElizaBot\Charactor\Eliza;
use JYYAN\ElizaBot\Charactor\Human;
use JYYAN\ElizaBot\Constant\Sentiments;
use JYYAN\Config;

// Imports the Google Cloud client library
use Google\Cloud\Translate\TranslateClient;
use Google\Cloud\Speech\SpeechClient;
use Google\Cloud\ServiceBuilder;
use GuzzleHttp\Client;

class ElizaBot
{
    const VERSION = '1.0.0';


    /*
     * The default instance is below
     * */
    /**
 * @Eliza Eliza charactor
*/
    public $eliza;
    /**
 * @Humen Humen charactor
*/
    public $human;

    /**
 * @Sentiments array , the default Sentiments as defined
*/
    public $sentiments;

    /**
 * @Receive set receive message
*/
    public $receive;

    /**
 * @Response get response message
*/
    public $response;

    /**
 * @Messages pool of all message could be response
*/
    public $messages;

    /**
 * @string
*/
    public $language;


    public $elizaKnowlegeBase;
    public $humanKnowlegeBase;
    public $snlpKnowlegeBase;

    /**
     * ElizaBot constructor.
       $opts = array(
         'elizaKnowlegeBase'=>array(),
         'humanKnowlegeBase'=>array(),
         'snlpKnowlegeBase'=>array(),
       );
     */
    public function __construct($opts = array())
    {
        if (!empty($opts['elizaKnowlegeBase'])) {
            $this->elizaKnowlegeBase = $opts['elizaKnowlegeBase'];
        }
        if (!empty($opts['humanKnowlegeBase'])) {
            $this->humanKnowlegeBase = $opts['humanKnowlegeBase'];
        }
        if (!empty($opts['snlpKnowlegeBase'])) {
            $this->snlpKnowlegeBase= $opts['snlpKnowlegeBase'];
        }
        // get default Sentiments defind
        $this->language="zh_TW";
        $this->set('sentiments', Sentiments::get());
        $this->update();
        // if you have to setup new sentiments Elements , add it here
    }

    public function addSenti($element)
    {
        $element = strtolower($element);
        $this->sentiments[] = $element;

        return $this;
    }

    public function update()
    {
        $this->set('eliza', new Eliza($this->sentiments));
        $this->set('human', new Human($this->sentiments));
        $this->eliza->knowlegeBase =& $this->elizaKnowlegeBase;
        $this->eliza->nlp->knowlegeBase =& $this->snlpKnowlegeBase;
        $this->human->knowlegeBase =& $this->humanknowlegeBase;
        $this->human->nlp->knowlegeBase =& $this->snlpKnowlegeBase;
    }

    public function setHumanName($val)
    {
        $this->human->setName($val);
    }

    public function setElizaName($val)
    {
        $this->eliza->setName($val);
    }

    public function set($name, $callback)
    {
        $name = (string) $name;
        $this->{ $name } = $callback ;
    }
    //$msgBox = $elizabot->eliza->receive( $command )->think() ;

    public function receive($msg)
    {

        // TODO:
        // 1. valid the receive message language
        // ( zh-TW / en-US / others )
        //
        // 2. setup the input language
        // The target language
        //
        $target = 'en-US';

        if (isset($this->translate)) {
            $translation = $this->translate->translate(
                $msg,
                [
                'target' => $target
                ]
            );
            $msg = $translation['text'];
            //$srcLang = $translation['source'];
        }

        return $this->eliza->receive($msg);
    }
}
