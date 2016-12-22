<?php
namespace JYYAN\ElizaBot\Message;

class Text extends StdMessage
{

    public function __construct($str)
    {
        $this->message = $str;
    }
}
