<?php

  require_once "RestServer.php";

  class Hello
  {
     // example: http://path/to/Examples/Instance.php?method=sayHello&name=World
     public function sayHello($name)
     {
        return array("Response" => "Hello, " . $name);
     }

     // example: http://path/to/Examples/Instance.php?method=addInts&n1=3&n2=5
     public function addInts($n1, $n2)
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

  $hello = new Hello();
  $rest = new RestServer($hello);
  $rest->handle();

?>