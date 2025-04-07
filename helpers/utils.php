<?php

class Utils {

    public static function mostrarError($errores, $campo) {
        $alerta = '';

        if (isset($errores[$campo])) {
            $alerta = "<div class='alerta alerta-error'>{$errores[$campo]}</div>";
        }

        return $alerta;
    }

    public static function borrarErrores() {
        if (isset($_SESSION['errores'])) {
            unset($_SESSION['errores']);
        }

        if (isset($_SESSION['completado'])) {
            unset($_SESSION['completado']);
        }

        if (isset($_SESSION['error_login'])) {
            unset($_SESSION['error_login']);
        }

        return null;
    }

    public static function borrarDatosFormulario() {
        if (isset($_SESSION['formulario'])) {
            unset($_SESSION['formulario']);
        }

        return null;
    }
}
