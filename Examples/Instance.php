<?php

  // example request: http://path/to/Examples/Instance.php?method=sayHello&name=World

  require_once "RestServer.php";

  class Hello
  {
     public function __construct()
     {

     }

     public function sayHello($name)
     {
        return array("Response" => "Hello, " . $name);
     }

     public function test()
     {
      
     }
  }

  $hello = new Hello();
  $rest = new RestServer($hello);
  $rest->handle();

?>