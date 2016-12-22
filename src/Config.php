<?php
namespace JYYAN;

class Config extends \stdClass
{

    public function __construct($data)
    {
        if (is_array($data)) {
            foreach ($data as $configName => $configValue) {
                $this->{$configName} = $configValue;
            }
        }
    }

    public function __set($name, $value)
    {
        if (is_array($value)) {
            $this->{$name} = new Config($value);
        } else {
            $this->{$name} = $value;
        }
    }

    public function set($name, $value)
    {
        if (isset($this->{$name}) && is_array($value)) {
            $this->{$name} = new Config($value);
        } else {
            $this->{$name} = $value;
        }
    }
}
