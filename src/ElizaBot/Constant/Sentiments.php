<?php
namespace JYYAN\ElizaBot\Constant;

class Sentiments
{

    public static function get()
    {
        return [
            'normal',
            'unknow',
            'anger',
            'disqust',
            'fear',
            'happiness',
            'sadness',
            'surprise',
            'command'
        ];
    }

    public static function mapping()
    {
        return [
            'normal' => "普通",
            'unknow' => "未知",
            'anger'  => "忿怒",
            'disqust'=> "厭惡",
            'fear'   => "恐懼",
            'happiness'=>"開心",
            'sadness'  =>"悲傷",
            'surprise' =>"驚訝",
            'command'  =>"疑惑"
        ];
    }
}
