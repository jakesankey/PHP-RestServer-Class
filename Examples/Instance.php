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
        return json_encode(array("Response" => "Hello, " . $name));
     }
  }

  $hello = new Hello();
  $rest = new RestServer($hello);
  $rest->handle();

?>