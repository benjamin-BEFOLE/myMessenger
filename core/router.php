<?php  
	function createRequest(){
		if(isset($_GET['url'])){
			$url = trim($_GET['url'], '/');
			$parameters = explode('/', $url);
			$request = array(
				'controller' => $parameters[0],
				'action' => isset($parameters[1]) ? $parameters[1] : 'index', 
				'parameters' => array_slice($parameters, 2));
			
			return $request;
		}

		return array(
			'controller' => 'Accueil', 
			'action' => 'index',
			'parameters' => array());
	}

	function includeController($request) {
		$controller = $request['controller'];

		$controllerName = ROOT . DS . "controller" . DS . "controller" . $controller . ".php";
		
		if(!file_exists($controllerName)) {
			$controllerName = ROOT . DS . "controller" . DS . "controllerAccueil.php";
			$request['controller'] = "Accueil";
		}
		require_once $controllerName;
	}

	function createAction($request) {
		$action = $request['action'];

		if(!function_exists($action))
			$action = 'index';
		
		$action();
	}
