<?php

  require_once "RestServer.php";

  class Hello {
     // example: http://path/to/examples/InstanceExample.php?method=sayHello&name=World
     public function sayHello($name) {
        return array("Response" => "Hello, " . $name);
     }

     // It doesn't matter if the methods are instance or static
     // example: http://path/to/examples/InstanceExample.php?method=addInts&n1=3&n2=5
     public static function addInts($n1, $n2) {
        if (is_numeric($n1) && is_numeric($n2)) {
          return array("Result" => "$n1 + $n2 = " . (string)($n1 + $n2));
        }
        else {
          return array("Error" => "Parameters must be numeric.");
        }
     }
  }

  class Goodbye {
     // example: http://path/to/examples/InstanceExample.php?method=sayGoodbye&name=World
     public function sayGoodbye($name) {
        return array("Response" => "Goodbye, " . $name);
     }
  }

  $rest = new RestServer();
  $rest->addServiceClass(Hello);
  $rest->addServiceClass(Goodbye);
  $rest->handle();

?>
