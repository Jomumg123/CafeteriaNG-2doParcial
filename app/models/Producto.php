<?php
class Producto {
    private $conn;
    private $table_name = "productos";

    public $id;
    public $nombre;
    public $descripcion;
    public $precio;
    public $categoria;
    // CAMBIO 1: Nueva propiedad para el nombre del archivo de imagen
    public $imagen; 

    public function __construct($db) {
        $this->conn = $db;
    }

    // LEER TODOS
    public function leer() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY creado_en DESC";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }

    // CREAR (Modificado para incluir imagen)
    public function crear() {
        // CAMBIO 2: Se agregó el campo imagen a la consulta SQL
        $query = "INSERT INTO " . $this->table_name . " 
                  SET nombre=:nombre, descripcion=:descripcion, precio=:precio, categoria=:categoria, imagen=:imagen";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":categoria", $this->categoria);
        // CAMBIO 3: Vincular el valor de la imagen
        $stmt->bindParam(":imagen", $this->imagen); 

        return $stmt->execute();
    }

    // LEER UNO
    public function leerUno() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ACTUALIZAR (Modificado para incluir imagen)
    public function actualizar() {
        // CAMBIO 4: Se agregó imagen=:imagen a la actualización
        $query = "UPDATE " . $this->table_name . " 
                  SET nombre=:nombre, descripcion=:descripcion, precio=:precio, categoria=:categoria, imagen=:imagen 
                  WHERE id=:id";
        
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nombre", $this->nombre);
        $stmt->bindParam(":descripcion", $this->descripcion);
        $stmt->bindParam(":precio", $this->precio);
        $stmt->bindParam(":categoria", $this->categoria);
        $stmt->bindParam(":imagen", $this->imagen); // Se actualiza la ruta de la imagen
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