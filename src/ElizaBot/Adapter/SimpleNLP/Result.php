<?php
namespace JYYAN\ElizaBot\Adapter\SimpleNLP;

use JYYAN\ElizaBot\Charactor\Element;

class Result extends \ArrayObject
{
    public $keys = array();

    public $checkList = array();

    public function __set($name, $value)
    {
        $name = strtolower($name);
        switch ($name) {
            case "join":
                $this->joinIt($value);
                break;
            case "check":
                $this->checkList = array_merge($this->checkList, [$value]);
                break;
            default:
                $this->{$name} = new Element($name);
                $this->{$name}->set($value);
                //$this->addElement( $name , $value);
                break;
        }
    }

    public function addElement($elementName, $value)
    {
        if (isset($this->{$elementName})) {
            $this->{$elementName}->add($value);
        } else {
            $this->{$elementName} =$value;  // will goto __set : default
            $this->checkList = array_merge($this->checkList, [$elementName]);
        }
    }

    public function joinIt(Result $resultNew)
    {
        // keyword
        if (isset($resultNew->keys)) {
            $this->keys = array_merge($this->keys, $resultNew->keys);
        }

        foreach ($resultNew->checkList as $elementName) {
            if (array_search($elementName, $this->checkList) === false) {
                $this->checkList = array_merge($this->checkList, [$elementName]);
                $this->{$elementName} = $resultNew->{$elementName}->value;
            } else {
                $this->{$elementName}->add($resultNew->{$elementName}->value);
            }
        }
        return $this;
    }

    public function joinOnce(Result $resultNew)
    {
        // process for merge half of the exist keywords into new keywords
        $this->keys = array_splice($this->keys, round(count($this->keys)/2), 4);
        foreach ($resultNew->keys as $key) {
            if (array_search($key, $this->keys) === false) {
                $this->keys = array_merge($this->keys, [$key]);
            }
        }

        foreach ($resultNew->checkList as $elementName) {
            if (array_search($elementName, $this->checkList) === false) {
                $this->checkList = array_merge($this->checkList, [$elementName]);
                $this->{$elementName} = $resultNew->{$elementName}->value;
            } else {
                $this->{$elementName}->addOnce($resultNew->{$elementName}->value);
            }
        }
        return $this;
    }
}
