<?php
class Producto {
    private $conn;
    private $table_name = "productos";

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $categoria;

    public function __construct($db) {
        $this->conn = $db;
    }

    // LEER TODOS (Para el menú)
    public function leer() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY creado_en DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // CREAR (Para registrar café)
    public function crear() {
        $query = "INSERT INTO " . $this->table_name . " SET nombre=:nombre, descripcion=:descripcion, precio=:precio, categoria=:categoria";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":categoria", $this->categoria);
        return $stmt->execute();
    }

    // LEER UNO (Para cargar datos en el formulario de editar)
    public function leerUno() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ACTUALIZAR (Para guardar cambios)
    public function actualizar() {
        $query = "UPDATE " . $this->table_name . " SET nombre=:nombre, descripcion=:descripcion, precio=:precio, categoria=:categoria WHERE id=:id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":id", $this->id);
        return $stmt->execute();
    }

    // ELIMINAR
    public function eliminar() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        return $stmt->execute();
    }
}