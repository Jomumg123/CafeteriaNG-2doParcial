<?php
class Usuario {
    private $conn;
    private $table_name = "usuarios";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function buscarPorEmail($email) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE email = :email LIMIT 0,1";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function registrar($nombre, $email, $telefono, $password, $rol = 'cliente') {
        $query = "INSERT INTO " . $this->table_name . " 
                SET nombre=:nombre, email=:email, telefono=:telefono, password=:password, rol=:rol, foto_perfil='default_user.png'";
        
        $stmt = $this->conn->prepare($query);

        // Limpieza de seguridad
        $nombre = htmlspecialchars(strip_tags($nombre));
        $email = htmlspecialchars(strip_tags($email));
        $telefono = htmlspecialchars(strip_tags($telefono));

        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefono', $telefono);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':rol', $rol);

        return $stmt->execute();
    }
}