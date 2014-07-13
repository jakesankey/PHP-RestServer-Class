<?php

	class RestServer {
		private $serviceClasses = array();

		public function addServiceClass($serviceClass) {
			$this->serviceClasses[] = $serviceClass;
		}
	
		public function handle() {
			$requestAttributes = $this->getRequestAttributeArray();

			if ($this->methodIsDefinedInRequest()) {
				$method = $requestAttributes["method"];

				$serviceClass = $this->getClassContainingMethod($method);
					
				if ($serviceClass != null) {
					$ref = new ReflectionMethod($serviceClass, $method);
					if (!$ref->isPublic()) {
						echo json_encode(array('error' => 'API call is invalid.'));
					        return ;
					}
					$params = $ref->getParameters();
					$paramCount = count($params);
					$pArray = array();
					$paramStr = "";
					
					$iterator = 0;
					
					foreach ($params as $param) {
						$pArray[strtolower($param->getName())] = null;
						$paramStr .= $param->getName();
						if ($iterator != $paramCount-1) {
							$paramStr .= ", ";
						}
						
						$iterator++;
					}

					foreach ($pArray as $key => $val) {
						$pArray[strtolower($key)] = $requestAttributes[strtolower($key)];
					}
	
					if (count($pArray) == $paramCount && !in_array(null, $pArray)) {
						$result = call_user_func_array(array($serviceClass, $method), $pArray);

						if ($result != null) {
							echo json_encode($result);
						}
					}
					else {
						echo json_encode(array('error' => "Required parameter(s) for ". $method .": ". $paramStr));
					}
				}
				else {
					echo json_encode(array('error' => "The method " . $method . " does not exist."));
				}
			}
			else {
				echo json_encode(array('error' => 'No method was requested.'));
			}
		}

		private function getClassContainingMethod($method) {
			$serviceClass = null;
			foreach ($this->serviceClasses as $class) {
				if ($this->methodExistsInClass($method, $class)) {
					$serviceClass = $class;
				}
			}
			return $serviceClass;
		}

		private function methodExistsInClass($method, $class) {
			return method_exists($class, $method);
		}

		private function methodIsDefinedInRequest() {
			return array_key_exists("method", $this->getRequestAttributeArray());
		}

		private function getRequestAttributeArray() {
			return array_change_key_case($_REQUEST, CASE_LOWER);;
		}
	}

?>
