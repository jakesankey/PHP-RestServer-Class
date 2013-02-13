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

The class is smart enough to detect if the requested method exists and if you have provided 
the correct parameters for the given method. If the method does not exist, the response will let you know.
If the parameters are wrong or certain parameters are missing, the reponse will tell you which parameters are
required for the method.

<b>NOTE:</b>
RestServer automatically encodes your return objects as JSON. No need to pre-encode objects returned as JSON.

<b>MIT LICENSE:</b>

Copyright (c) 2013 Jake Sankey

Permission is hereby granted, free of charge, to any person obtaining
a copy of this software and associated documentation files (the
"Software"), to deal in the Software without restriction, including
without limitation the rights to use, copy, modify, merge, publish,
distribute, sublicense, and/or sell copies of the Software, and to
permit persons to whom the Software is furnished to do so, subject to
the following conditions:

The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
