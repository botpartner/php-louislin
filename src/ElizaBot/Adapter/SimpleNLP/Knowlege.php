<?php
namespace JYYAN\ElizaBot\Adapter\SimpleNLP;

class Knowlege extends \JYYAN\ElizaBot\Message\Rule
{

    public function check($message)
    {
        $message = (string) $message;
        $result = new Result();

        if (isset($this->keys)) {
            foreach ($this->keys as $key) {
                if (strrpos($message, $key) !== false) {
                    $result->keys = array_merge($result->keys, [$key]);
                    $elementNames = $this->checkList;
                    foreach ($elementNames as $elementName) {
                        $result->addElement($elementName, $this->{$elementName}->value);
                    }
                }
            }
        }

        return $result;
    }
}
