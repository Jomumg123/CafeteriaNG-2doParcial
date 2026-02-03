<?php
// app/controllers/ProductoController.php
class ProductoController {
    private $db;
    private $producto;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->producto = new Producto($this->db);
        
        // Aseguramos que la sesión esté iniciada para los mensajes
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function index() {
        require_once "../app/views/home.php";
    }

    public function mostrarMenu() {
        $stmt = $this->producto->leer(); 
        require_once "../app/views/menu.php";
    }

    public function mostrarContacto() {
        require_once "../app/views/contacto.php";
    }

    public function crear() {
        require_once "../app/views/productos/crear.php";
    }

    public function guardar() {
        if ($_POST) {
            if(empty($_POST['nombre']) || empty($_POST['precio'])) {
                $_SESSION['mensaje'] = "El nombre y el precio son obligatorios.";
                $_SESSION['tipo_mensaje'] = "error";
                header("Location: index.php?action=nuevo");
                return;
            }

            $this->producto->nombre = $_POST['nombre'];
            $this->producto->descripcion = $_POST['descripcion'];
            $this->producto->precio = $_POST['precio'];
            $this->producto->categoria = $_POST['categoria'];

            $nombreImagen = "default_cafe.png"; 

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $nombreImagen = time() . "_" . str_replace(' ', '_', $this->producto->nombre) . "." . $extension;
                $rutaDestino = "../public/img/uploads/" . $nombreImagen;
                move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
            }

            $this->producto->imagen = $nombreImagen;

            if ($this->producto->crear()) {
                // Mensaje de éxito al agregar
                $_SESSION['mensaje'] = "¡Producto agregado con éxito al menú!";
                $_SESSION['tipo_mensaje'] = "success";
                header("Location: index.php?action=menu");
                exit();
            }
        }
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $this->producto->id = $_GET['id'];
            $producto = $this->producto->leerUno();
            
            if ($producto) {
                require_once "../app/views/productos/editar.php";
            } else {
                header("Location: index.php?action=menu");
            }
        }
    }

    public function actualizar() {
        if ($_POST) {
            $this->producto->id = $_POST['id'];
            $this->producto->nombre = $_POST['nombre'];
            $this->producto->descripcion = $_POST['descripcion'];
            $this->producto->precio = $_POST['precio'];
            $this->producto->categoria = $_POST['categoria'];

            $datosActuales = $this->producto->leerUno();
            $nombreImagen = $datosActuales['imagen'];

            if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] == 0) {
                $extension = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
                $nombreImagen = time() . "_" . str_replace(' ', '_', $this->producto->nombre) . "." . $extension;
                $rutaDestino = "../public/img/uploads/" . $nombreImagen;
                move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino);
            }

            $this->producto->imagen = $nombreImagen;

            if ($this->producto->actualizar()) {
                // Mensaje de éxito al actualizar
                $_SESSION['mensaje'] = "El producto se ha actualizado correctamente.";
                $_SESSION['tipo_mensaje'] = "success";
                header("Location: index.php?action=menu");
                exit();
            }
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->producto->id = $_GET['id'];
            if ($this->producto->eliminar()) {
                // Mensaje de éxito al eliminar
                $_SESSION['mensaje'] = "Producto eliminado del inventario.";
                $_SESSION['tipo_mensaje'] = "info";
                header("Location: index.php?action=menu");
                exit();
            }
        }
    }
}