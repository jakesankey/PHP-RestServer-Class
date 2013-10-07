PHP-RestServer-Class
====================

The REST equivalent to PHP's native SoapServer class.

PHP natively supports the SoapServer class, allowing you to expose a PHP class as a SOAP API 
for client applications to consume.

SOAP is not always the right option. RESTful services are likely to be easier and faster. That is why I developed
the RestServer class.


<b>Example:</b>

    class Hello
    {
      public static function sayHello($name)
      {
        // RestServer will json_encode this array before returning it to the client.
        return array("Response" => "Hello, " . $name);
      }
    }

    $rest = new RestServer(Hello);
    $rest->handle();


Then simply make calls by GET or POST.

<b>GET example:</b>
(The method and parameter names are case-insensitive.)

    http://server.com/file.php?method=sayHello&name=World
    
Try the live examples of <a href='http://jakesankey.com/projects/php/RestServer/example.php?method=sayHello&name=World' target='_blank'>`sayHello`</a> and <a href='http://jakesankey.com/projects/php/RestServer/example.php?method=addInts&n1=15&n2=10' target='_blank'>`addInts`</a>.

The class is smart enough to detect if the requested method exists and if you have provided 
the correct parameters for the given method. If the method does not exist, the response will let you know.
If the parameters are wrong or certain parameters are missing, the reponse will tell you which parameters are
required for the method.

<b>NOTE:</b>
RestServer automatically encodes your return objects as JSON. No need to pre-encode objects before returning them.
