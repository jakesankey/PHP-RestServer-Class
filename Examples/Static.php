<?php

  require_once "RestServer.php";

  class Hello
  {
     // example: http://path/to/Examples/Static.php?method=sayHello&name=World
     public static function sayHello($name)
     {
        return array("Response" => "Hello, " . $name);
     }

     // example: http://path/to/Examples/Static.php?method=addInts&n1=3&n2=5
     public static function addInts($n1, $n2)
     {
        if (is_numeric($n1) && is_numeric($n2))
        {
          return array("Result" => "$n1 + $n2 = " . (string)($n1 + $n2));
        }
        else
        {
          return array("Error" => "Parameters must be numeric.");
        }
     }
  }

  $rest = new RestServer(Hello);
  $rest->handle();

?>