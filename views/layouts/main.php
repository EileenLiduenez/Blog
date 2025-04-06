<?php  

if (isset($_GET['view'])) {
    $view = $_GET['view'];
    // Categorías con entradas dinámicas
    $categorias_con_entradas = ['musica', 'reflexiones', 'love'];

    if (in_array($view, $categorias_con_entradas)) {
        include "views/categorias/categoria.php";
    } elseif ($view == 'sobreemos' || $view == 'about') {
        include "views/categorias/" . basename($view) . ".php";
    } else {
        switch ($view) {
            case 'buscar':
                include 'views/categorias/buscar.php';
                break;
            case 'usuarios/login':
                include 'views/usuarios/login.php';
                break;
            case 'usuarios/registro':
                include 'views/usuarios/registro.php';
                break;
            case 'usuarios/mis-datos':
                include 'views/usuarios/mis-datos.php';
                break;
            case 'usuarios/logout':
                include 'views/usuarios/logout.php';
                break;
            default:
                include 'views/home.php';
                break;
        }
    }
} else {
    include 'views/home.php';
}
?>
