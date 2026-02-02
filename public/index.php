<?php
// public/index.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../app/config/db.php";
require_once "../app/models/Producto.php";
require_once "../app/controllers/ProductoController.php";

$controller = new ProductoController();
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// DEBUG: Descomenta la siguiente línea si quieres ver qué acción está llegando
// echo "Acción actual: " . $action; 

switch ($action) {
    case 'menu':
        $controller->mostrarMenu();
        break;
    case 'contacto':
        $controller->mostrarContacto();
        break;
    case 'nuevo':
        $controller->crear();
        break;
    case 'guardar':
        $controller->guardar();
        break;
    case 'editar':
        $controller->editar();
        break;
    case 'actualizar':
        $controller->actualizar();
        break;
    case 'eliminar':
        $controller->eliminar();
        break;
    default:
        $controller->index();
        break;
}