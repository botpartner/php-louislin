<?php
namespace JYYAN\ElizaBot\Adapter\SimpleNLP;

interface NaturalInterface
{

    /*
     *
     * @param $message the str which want to join into NLP
     * */
    public function push($message);

    /*
     * @return JYYAN\ElizaBot\Adapter\SimpleNLP\Result
     * */
    public function valid();
}
