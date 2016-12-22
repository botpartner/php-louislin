<?php
namespace JYYAN\ElizaBot\Message;

use JYYAN\ElizaBot\Charactor\Element;

class Fact extends \ArrayObject
{

    public $keys = array();

    public function __set($name, $value)
    {
        $name = strtolower($name);
        switch ($name) {
            case "keys":
                break;

            default:
                $this->{$name} = new Element($name);
                $this->{$name}->set($value);
                break;
        }
    }
}
