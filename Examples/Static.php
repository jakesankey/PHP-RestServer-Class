<?php

  // example request: http://path/to/Examples/Static.php?method=sayHello&name=World

  require_once "RestServer.php";

  class Hello
  {
     public static function sayHello($name)
     {
        return array("Response" => "Hello, " . $name);
     }
  }

  $rest = new RestServer(Hello);
  $rest->handle();

?>