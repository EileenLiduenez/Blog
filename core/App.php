<?php 

class App {
    public function __construct() {
        session_start(); // Iniciar sesión en toda la aplicación

        $controller = $_GET['controller'] ?? 'entrada';
        $action = $_GET['action'] ?? 'index';

        $controller = ucfirst($controller) . "Controller";
        $controllerPath = "controllers/" . $controller . ".php";

        if (file_exists($controllerPath)) {
            require_once $controllerPath;
            $controllerObject = new $controller();

            if (method_exists($controllerObject, $action)) {
                $controllerObject->$action();
            } else {
                $this->error404("El método '$action' no existe en el controlador '$controller'");
            }
        } else {
            $this->error404("El controlador '$controller' no existe");
        }
    }

    private function error404($message) {
        echo "<h1>Error 404</h1><p>$message</p>";
        exit();
    }
}

?>
