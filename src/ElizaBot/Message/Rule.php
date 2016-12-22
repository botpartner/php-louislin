<?php
namespace JYYAN\ElizaBot\Message;

use JYYAN\ElizaBot\Charactor\Element;
use JYYAN\ElizaBot\Message\Image;
use JYYAN\ElizaBot\Message\Text;
use JYYAN\ElizaBot\Adapter\SimpleNLP\Result;

class Rule extends \ArrayObject
{
    /*
     * @array for store Key words
     * */
    public $keys = array();

    /*
     * @array for store messages
     * */
    public $messages = array();
    /*
     * @array as image ID
     * */
    public $images   = array();

    public $checkList = array();

    public function __construct()
    {
        $this->checkList = [];
    }

    public function __set($name, $value)
    {
        $name = strtolower($name);
        switch ($name) {
            case "msg":
                $this->messages[] = (string) $value;
                break;
            case "img":
                $this->images[] = (string) $value;
                break;
            case "key":
                $this->keys[]   = (string) $value;
                break;
            default:
                if (!isset($this->{$name})) {
                    array_push($this->checkList, $name);
                }
                $this->{$name} = new Element($name);
                $this->{$name}->set($value);
                break;
        }
    }

    public function think(Result $result)
    {
        $status = false;

        foreach ($this->keys as $keyword) {
            if (array_search($keyword, $result->keys) !== false) {
                //echo "pick up keyword = $keyword \n";
                $status = true;
            }
        }

        //var_dump( implode( ',' , $this->checkList) );
        foreach ($this->checkList as $elementName) {
            //var_dump($this->{$elementName} );
            switch ($this->{$elementName}->rule) {
                case 'eq':
                    if ($result->{$elementName}->value == $this->{$elementName}->value) {
                        $status = true;
                    } else {
                        $status = false;
                    }
                    break;
                case 'gt':
                    if ($result->{$elementName}->value >= $this->{$elementName}->value) {
                        $status = true;
                    } else {
                        $status = false;
                    }
                    break;
                case 'lt':
                    if ($result->{$elementName}->value <= $this->{$elementName}->value) {
                        $status = true;
                    } else {
                        $status = false;
                    }
                    break;
            }
        }
        //var_dump($status);
        if ($status) {
            return new Image($this->randImg());
        }
        return false;
    }

    public function randImg()
    {
        $imageID = "";
        $totalImg = sizeof($this->images)-1;

        if ($totalImg>0) {
            $randID = rand(0, $totalImg);
            $imageID = $this->images[$randID];
        }

        return $imageID;
    }
}
