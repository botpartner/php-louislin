<?php
namespace JYYAN\ElizaBot\Charactor;

use JYYAN\ElizaBot\Adapter\SimpleNLP;
use JYYAN\ElizaBot\Message\StdMessage;

class Eliza extends \JYYAN\ElizaBot\Adapter\SimpleNLP\Result
{

    /*
     * @var name
     * */
    public $name = "Eliza";

    /*
     * @var array
     * */
    public $knowlegeBase;

    public $nlp;

    public function setName($val)
    {
        $this->name = $val;
    }

    public function __construct($elements = array())
    {

        $this->nlp = new SimpleNLP();


        foreach ($elements as $element) {
            $element = strtolower($element);
            $this->addElement($element, 0);
        }
    }

    public function toJson()
    {
        //return json_encode($this->pool);
        return json_encode($this);
    }

    public function apply($elements)
    {
        foreach ($elements as $element => $val) {
            if (isset($this->{$element})) {
                $this->{ $element }->set($val);
            }
        }
    }

    public function add($elements)
    {
        foreach ($elements as $element => $val) {
            if (isset($this->{$element})) {
                $this->{ $element }->add(intval($val));
            }
        }
    }

    /*
     * @return ElizaBot
     * */
    public function receive($msg)
    {

        $result = $this->nlp->push($msg);

        // for unknow msg
        if (sizeof($result->checkList) < 1) {
            $result->addElement("unknow", 100);
        }

        $this->joinOnce($result);

        //return msg box
        return $this;
    }

    /*
     * return msgbox
     * */
    public function think()
    {
        foreach ($this->knowlegeBase as $knowlege) {
            $msgBox = $knowlege->think($this);
            //var_dump( implode( ',' , $knowlege->keys) );
            if ($msgBox !== false) {
                return $msgBox;
            }
        }
        return new StdMessage();
    }
}
