<?php
namespace Root\App\Services\Error;

class Error
{
    public static $instance = null;
    private $statusCode;
    private $messages = [];
    private $view  =  __DIR__ ."/../../error.php";


    private function __construct(){}
    private function __clone(){}
    private function __wakeup(){}

    public static function getInstance()
    {
        if(self::$instance === null)
        {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }

    public function setMessages($messages)
    {
        foreach($messages as $message){
            array_push($this->messages, $message);
        }
        return $this;

    }

    public function setview($view)
    {
        $this->view = __DIR__ ."/../../../" . $view . ".php";
        return $this;
    }

    public function execute()
    {
        $errorMessages = $this->messages;
        $status = $this->statusCode;
        $view = $this->view;
        include_once($this->view);
    }
  
}