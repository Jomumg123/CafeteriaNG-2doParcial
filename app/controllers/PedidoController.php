<?php
class PedidoController {
    private $db;
    private $pedido;

    public function __construct() {
        $database = new Database();
        $db = $database->getConnection();
        require_once "../app/models/Pedido.php";
        $this->pedido = new Pedido($db);

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Acción para el cliente
    public function realizarPedido() {
        // 1. Verificación de seguridad
        if (!isset($_SESSION['user_id']) || $_SESSION['user_rol'] !== 'cliente') {
            header("Location: index.php?action=login");
            exit();
        }

        // 2. Capturamos los datos del formulario POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_SESSION['user_id'];
            $id_producto = $_POST['id_producto'];
            $cantidad = $_POST['cantidad'];
            $notas = $_POST['notas'];

            // 3. Intentamos registrar el pedido con los nuevos detalles
            if ($this->pedido->registrar($id_usuario, $id_producto, $cantidad, $notas)) {
                $_SESSION['mensaje'] = "¡Pedido de ($cantidad) unidades recibido! ☕";
                $_SESSION['tipo_mensaje'] = "success";
            } else {
                $_SESSION['mensaje'] = "Error técnico al procesar el pedido.";
                $_SESSION['tipo_mensaje'] = "error";
            }
        }
        
        header("Location: index.php?action=menu");
        exit();
    }

    // Acción para el administrador
    public function verPedidos() {
        if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
            header("Location: index.php");
            exit();
        }
        $stmt = $this->pedido->obtenerTodos();
        require_once "../app/views/admin/pedidos.php";
    }
    public function entregarPedido() {
    // Seguridad: Solo el administrador puede marcar como entregado
    if (!isset($_SESSION['user_rol']) || $_SESSION['user_rol'] !== 'admin') {
        header("Location: index.php");
        exit();
    }

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        if ($this->pedido->marcarComoEntregado($id)) {
            $_SESSION['mensaje'] = "Pedido #" . $id . " marcado como entregado correctamente.";
            $_SESSION['tipo_mensaje'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al actualizar el estado del pedido.";
            $_SESSION['tipo_mensaje'] = "error";
        }
    }
    header("Location: index.php?action=ver_pedidos");
    exit();
}
}