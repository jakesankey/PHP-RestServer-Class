PHP-RestServer-Class
====================

The REST equivalent to PHP's native SoapServer class.

PHP natively supports the SoapServer class, allowing you to expose a PHP class as a SOAP API 
for client applications to consume.

SOAP is not always the right option. RESTful services are likely to be easier and faster. That is why I developed
the RestServer class.

<b>Version 2:</b>
It no longer matters if you pass in an instance or simply the class names. RestServer will invoke the methods in the given class despite being instance or static or whether the object or class itself is passed into RestServer.

Also, new in this version, instead of passing in the class to expose via the RestServer constructor, you will now use the addServiceClass method. This allows you to expose as many service classes as you'd like.

<b>Example:</b>

	class Hello {
		// example: http://path/to/example.php?method=sayHello&name=World
		public function sayHello($name) {
			return array("Response" => "Hello, " . $name);
		}

		// It doesn't matter if the methods are instance or static
		// example: http://path/to/example.php?method=addInts&n1=3&n2=5
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
		// example: http://path/to/example.php?method=sayGoodbye&name=World
		public function sayGoodbye($name) {
			return array("Response" => "Goodbye, " . $name);
		}
	}

    $rest = new RestServer();
    $rest->addServiceClass(Hello);
    $rest->addServiceClass(Goodbye);
    $rest->handle();


Then simply make calls by GET or POST.

<b>GET example:</b>
(The method and parameter names are case-insensitive.)

    http://server.com/file.php?method=sayHello&name=World
    
Try the live examples of <a href='http://jakesankey.com/projects/php/RestServer/example.php?method=sayHello&name=World' target='_blank'>`sayHello`</a>, <a href='http://jakesankey.com/projects/php/RestServer/example.php?method=sayGoodbye&name=World' target='_blank'>`sayGoodbye`</a> and <a href='http://jakesankey.com/projects/php/RestServer/example.php?method=addInts&n1=15&n2=10' target='_blank'>`addInts`</a>.

The class is smart enough to detect if the requested method exists and if you have provided 
the correct parameters for the given method. If the method does not exist, the response will let you know.
If the parameters are wrong or certain parameters are missing, the reponse will tell you which parameters are
required for the method.

<b>NOTE:</b>
RestServer automatically encodes your return objects as JSON. No need to pre-encode objects before returning them.
