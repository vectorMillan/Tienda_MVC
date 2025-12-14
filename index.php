<?php
session_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'config/parameters.php';
require_once 'helpers/utils.php'; // Cargamos la clase Utils
require_once 'views/layout/header.php';

// FUNCIÓN DE AYUDA PARA MOSTRAR ERRORES
function show_error()
{
    $error = new ErrorController();
    $error->index();
}

// 1. COMPROBAR CONTROLADOR
if (isset($_GET['controller'])) {
    $nombre_controlador = $_GET['controller'] . 'Controller';
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    // Si NO hay controlador Y NO hay acción, usamos el por defecto (Home)
    $nombre_controlador = controller_default;
} else {
    show_error();
    exit();
}

// 2. COMPROBAR SI LA CLASE EXISTE
if (class_exists($nombre_controlador)) {
    $controlador = new $nombre_controlador();

    // 3. COMPROBAR ACCIÓN (MÉTODO)
    if (isset($_GET['action']) && method_exists($controlador, $_GET['action'])) {
        $action = $_GET['action'];
        $controlador->$action();
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        // Si no hay parámetros, ejecutamos la acción por defecto (index)
        $action_default = action_default;
        $controlador->$action_default();
    } else {
        show_error();
    }
} else {
    show_error();
}

require_once 'views/layout/footer.php';
