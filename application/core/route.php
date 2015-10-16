<?php
/**
 * Маршрутизатор
 */
class Route{
	static function start(){
		$controller_name = 'Main'; // Контроллер по умолчанию
		$action_name = 'index'; // Действие по умолчанию
		
		$routes = explode('/', $_SERVER['REQUEST_URI']);
		
		// получаем имя контроллера
		if(!empty($routes[1])){
			$controller_name = $routes[1];
		}
		
		// получаем имя действия
		if(!empty($routes[2])){
			$action_name = $routes[2];
		}
		
		// добавляем префиксы
		$model_name = 'Model_'.$controller_name;
		$controller_name = 'Controller_'.$controller_name;
		$action_name = 'action_'.$action_name;
		
		// подключаем файл с классом модели (файла модели может и не быть)
		$model_file = strtolower($model_name).'.php';
		$model_path = 'application/models/'.$model_file;
		if(file_exists($model_path)){
			include $model_path;	
		}
		
		// Подключение файла с классом контроллера
		$controller_file = strtolower($controller_name).'.php';
		$controller_path = 'application/controllers/'.$controller_file;
		if(file_exists($controller_path)){
			include $controller_path;
		}else{
			Route::ErrorPage404();
		}
		
		//Создаём контроллер
		$controller = new $controller_name;
		$action = $action_name;
		
		if(method_exists($controller, $action)){
			$controller->$action();
		}else{
			Roure::ErrorPage404();
		}
	}
	
	function ErrorPage404(){
		$host = 'http://'.$_SERVER['HTTP_HOST'].'/';
		header('HTTP/1.1 404 Not Found');
		header ('Status: 404 Not Found');
		header ('Location: '.$host.'404');
	}
}
  
?>
<?="router ready!<br>"?>
