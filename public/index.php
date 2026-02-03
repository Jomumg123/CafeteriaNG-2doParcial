<?php
// public/index.php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require_once "../app/config/db.php";
require_once "../app/models/Producto.php";
require_once "../app/controllers/ProductoController.php";
require_once "../app/controllers/AuthController.php";

require_once "../app/controllers/PedidoController.php"; 
$auth = new AuthController();

$controller = new ProductoController();
$pedidoCtrl = new PedidoController(); 
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

switch ($action) {
    case 'entregar_pedido':
    $pedidoCtrl->entregarPedido();
    break;
    case 'realizar_pedido':
        $pedidoCtrl->realizarPedido();
        break;
    case 'ver_pedidos':
        $pedidoCtrl->verPedidos();
        break;
    case 'registro':
        $auth->mostrarRegistro();
        break;
    case 'guardar_usuario':
        $auth->procesarRegistro();
        break;
    case 'login':
        $auth->mostrarLogin();
        break;
    case 'procesar_login':
        $auth->procesarLogin();
        break;
    case 'logout':
        $auth->logout();
        break;
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