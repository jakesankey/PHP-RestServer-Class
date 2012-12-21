PHP-RestServer-Class
====================

The REST equivalent to PHP's native SoapServer class.

PHP natively supports the SoapServer class, allowing you to expose a PHP class as a SOAP API 
for client applications to consume.

SOAP is not always the right option. RESTful services are likely to be easier and faster. That is why I developed
the RestServer class.


Example:

    class Hello
    {
      public static function sayHello($name)
      {
        return json_encode(array("Response" => "Hello, " . $name));
      }
    }

    $rest = new RestServer(Hello);
    $rest->handle();


Then simply make calls by GET or POST.

GET example:

http://server.com/file.php?method=sayHello&name=World


The class is smart enough to detect if the requested method exists and if you have provided 
the correct parameters for the given method. If the method does not exist, the response will let you know.
If the parameters are wrong or certain parameters are missing, the reponse will tell you which parameters are
required for the method.

NOTE:
The class will respond with JSON messages if an incorrect method or parameter are supplied. If the method and parameters
are correct, it will respond with whatever message format your class provides (note the example above returns a 
JSON encoded object, thus the RestServer class will return a JSON message to the client).

LICENSE:

Do whatever you want with it :)
