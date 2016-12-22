<?php
namespace JYYAN\ElizaBot\Message;

class Image extends StdMessage
{

    /*
     * @var text message
     * */
    public $message = "";

    /*
     * @var image ID
     * */
    public $imageID = "";

    public function __construct($imageID)
    {
        $this->imageID = $imageID;
    }
}
