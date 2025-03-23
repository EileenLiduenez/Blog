<?php
require_once "config/database.php"; // Para acceso a la base de datos

class Controller {
    protected $db;

    public function __construct() {
        $this->db = Database::connect(); // Conectar la base de datos automáticamente
    }

    public function loadModel($model) {
        $modelPath = "models/" . $model . ".php";
        if (file_exists($modelPath)) {
            require_once $modelPath;
            return new $model();
        } else {
            die("Error: El modelo '$model' no existe.");
        }
    }

    public function loadView($view, $data = []) {
        extract($data);
        $viewFile = __DIR__ . "/../views/" . $view . ".php";

        if (file_exists($viewFile)) {
            require_once $viewFile;
        } else {
            die("Error: La vista '$view' no existe.");
        }
    }

    public function redirect($url) {
        header("Location: $url");
        exit();
    }
}
?>
