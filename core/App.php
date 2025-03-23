<?php 

class App {
    public function __construct(){
        $controller = $_GET['controller'] ?? 'entrada';
        $action = $_GET['action'] ?? 'index';

        $controller = ucfirst($controller) . "Controller";

        if(file_exists("controllers/" . $controller . ".php")) {
            require_once "controllers/" . $controller . ".php";

            $controllerObject = new $controller();

            if(method_exists($controllerObject, $action)){
                $controllerObject->$action();
            }else {
                echo "Metodo '$action' no encontrado en el controlador '$controller'";
            
            }

        }else {
            echo "Controlador '$controller' no encontrado";
        }
    }
}


?>

