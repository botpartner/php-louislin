<?php
namespace JYYAN\ElizaBot\Adapter;

use JYYAN\ElizaBot\Adapter\SimpleNLP\Result;

class SimpleNLP implements \JYYAN\ElizaBot\Adapter\SimpleNLP\NaturalInterface
{

    public $knowlegeBase = array();
    public $language = "";

    public function __construct()
    {
        // by default the Language = zh_TW
    }

    /*
     * @param $message the str which want to join into NLP
     * */
    public function push($message)
    {
        // 0. check the Language set
        // 1. repared the KeywordRule stack
        // 2. sort it

        $result = new Result();
        foreach ($this->knowlegeBase as $knowlege) {
            $tmpResult= $knowlege->check($message);
            $result->join = $tmpResult;
        }
        //var_dump($tmpResult);
        return $result;
        // foreach loop for try to take the Result
    }

    /*
     * 翻譯翻譯
     * @return string
     * */
    public function fanyifanyi(Result $result)
    {
        $str = "";
        $str .="關鍵字 = ".implode(',', $result->keys)."\n";
        $eleMap = \JYYAN\ElizaBot\Constant\Sentiments::mapping();
        foreach ($result->checkList as $elementName) {
            $str .= "[".$eleMap[$elementName]."] 強度 = ".$result->{$elementName}->value ."\n";
        }
        return $str;
    }

    /*
     * @return JYYAN\ElizaBot\Adapter\SimpleNLP\Result
     * */
    public function valid()
    {
    }
}
