<?php
// app/controllers/ProductoController.php
class ProductoController {
    private $db;
    private $producto;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->producto = new Producto($this->db);
    }

    public function index() {
        require_once "../app/views/home.php";
    }

    // ESTA ES LA FUNCIÓN QUE TE FALTA Y CAUSA EL ERROR
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
            // Validación Backend (Punto 3.4) [cite: 32]
            if(empty($_POST['nombre']) || empty($_POST['precio'])) {
                header("Location: index.php?action=nuevo&msj=vacio");
                return;
            }
            $this->producto->nombre = $_POST['nombre'];
            $this->producto->descripcion = $_POST['descripcion'];
            $this->producto->precio = $_POST['precio'];
            $this->producto->categoria = $_POST['categoria'];
            if ($this->producto->crear()) header("Location: index.php?action=menu");
        }
    }

    public function editar() {
        if (isset($_GET['id'])) {
            $this->producto->id = $_GET['id'];
            
            // CORRECCIÓN: Guardamos el resultado en la variable $producto
            // Esta es la variable que busca tu archivo editar.php
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
            if ($this->producto->actualizar()) header("Location: index.php?action=menu");
        }
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $this->producto->id = $_GET['id'];
            if ($this->producto->eliminar()) header("Location: index.php?action=menu");
        }
    }
}