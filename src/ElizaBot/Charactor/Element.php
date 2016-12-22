<?php
namespace JYYAN\ElizaBot\Charactor;

class Element
{
    /*
     * @var
     * */
    public $name;

    /*
     * @var
     * */
    public $value;

    /*
     * @var = gt | lt | eq
     * */
    public $rule = "";

    public function __construct($element)
    {
        $this->name = $element;
        $this->value= 0;
        $this->setRule('eq');
    }

    /*
     *
     * */
    public function get()
    {
        return $this->value;
    }
    /*
     * @var integer
     * */
    public function set($value)
    {
        $this->value = intval($value);
        return $this;
    }

    public function add($value)
    {
        $this->value += intval($value);
        return $this;
    }

    public function addOnce($value)
    {
        $this->value = ($this->value * 0.8 + intval($value) );
        return $this;
    }

    public function __toString()
    {
        return (string) $this->value;
    }

    public function setRule($value)
    {
        $ruleSet = ['gt','lt','eq'];
        $value = strtolower($value);
        $this->rule = null;
        if (array_search($value, $ruleSet) !== false) {
            $this->rule = $value;
        }
        return $this;
    }

    public function __set($name, $value)
    {
        $name = strtolower($name);

        switch ($name) {
            case 'rule':
                $this->setRule($value);
                break;
            case '':
                break;

            default:
                break;
        }

        return $this;
    }
}
