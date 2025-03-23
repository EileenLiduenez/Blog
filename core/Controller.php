<?php
class Controller {
    public function loadModel($model) {
        require_once "models/" . $model . ".php";
        return new $model();
    }


    public function loadView($view, $data = []) {
        extract($data);
        $viewFile = "views/" . $view;
        
        if (!str_ends_with($viewFile, ".php")) {
            $viewFile .= ".php";
        }
    
        require_once $viewFile;
    }
    
}
?>