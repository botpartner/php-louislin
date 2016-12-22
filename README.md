# BotPartner Louis Agent

A Eliza-like chat agent

## Requires

 * php: >=5.6.4
 * guzzlehttp/guzzle: ^5.3
 * google/cloud: ^0.11.1

## Installation with composer

 * on your composer.json add :
```
     "repositories": [
     {
     "type": "git",
     "url": "https://github.com/botpartner/php-louis"
     }
     ]
```
 * install:
```sh
     composer require jyyan/eliza
```
 * enjoy




## Useage

```php
    use JYYAN\ElizaBot;
    use JYYAN\ElizaBot\Message\Rule;
    use JYYAN\ElizaBot\Adapter\SimpleNLP\Knowlege;

     public function getSnlpKnowlege()
     {
     $result = array();

     $rule = new Knowlege();
     $rule->key = "happy";
     $rule->key = "great";
     $rule->happiness = 100;
     $result[]=$rule;

     $rule = new Knowlege();
     $rule->key = "wtf";
     $rule->anger = 100;
     $result[]=$rule;

     $rule = new Knowlege();
     $rule->key = "hate";
     $rule->disqust= 100;
     $result[]=$rule;


     $rule = new Knowlege();
     $rule->key = "sad";
     $rule->sadness= 100;
     $result[]=$rule;


     $rule = new Knowlege();
     $rule->key = "surprise";
     $rule->surprise= 100;
     $result[]=$rule;

     $rule = new Knowlege();
     $rule->key = "why";
     $rule->key = "?";
     $rule->command = 100;
     $result[]=$rule;

     return $result;
     }

     public function getCharKnowlege()
     {
     $result = array();

     $rule = new Rule();
     $rule->key = "happy";
     $rule->key = "great";
     $rule->img = "001.PNG"; // pic id , pic name
     $rule->happiness = 100;
     $rule->happiness->setRule("gt");
     $result[]=$rule;

     $rule = new Rule();
     $rule->key = "wtf";
     $rule->img = "001.PNG"; // pic id , pic name
     $rule->anger = 100;
     $rule->anger->setRule('gt');
     $result[]=$rule;

     $rule = new Rule();
     $rule->key = "hate";
     $rule->img = "001.PNG"; // pic id , pic name
     $rule->disqust= 100;
     $rule->disqust->setRule('gt');
     $result[]=$rule;


     $rule = new Rule();
     $rule->key = "sad";
     $rule->img = "001.PNG"; // pic id , pic name
     $rule->sadness= 100;
     $rule->sadness->setRule('gt');
     $result[]=$rule;


     $rule = new Rule();
     $rule->key = "surprise";
     $rule->img = "001.PNG"; // pic id , pic name
     $rule->surprise= 100;
     $rule->surprise->setRule('gt');
     $result[]=$rule;


     $rule = new Rule();
     $rule->key = "why";
     $rule->key = "?";
     $rule->img = "001.PNG"; // pic id , pic name
     $rule->command = 100;
     $rule->command->setRule('gt');
     $result[]=$rule;

     $rule = new Rule();
     $rule->img = "001.PNG"; // pic id , pic name
     $rule->unknow = 90 ;
     $rule->unknow->setRule("gt");
     $result[]=$rule;

     return $result;
     }
     $opts = array(
     'elizaKnowlegeBase'=> getCharKnowlege(),
     'humanKnowlegeBase'=> getCharKnowlege(),
     'snlpKnowlegeBase'=> getSnlpKnowlege()
     );

     $this->bot = new ElizaBot($opts);

```

## Source Code License

(The MIT License)

Copyright (c) 2016 Jun-Yuan Yan (bot@botpartner.me) , BotPartner Inc.

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the 'Software'), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED 'AS IS', WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
