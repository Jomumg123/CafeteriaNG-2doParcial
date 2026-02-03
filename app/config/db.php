<?php
class Database {
    private $host;
    private $db_name;
    private $username;
    private $password;
    private $port;
    public $conn;

    public function getConnection() {
        $this->conn = null;

        // trim() elimina espacios accidentales al copiar y pegar en Render
        $this->host = trim(getenv('DB_HOST')) ?: "localhost";
        $this->db_name = trim(getenv('DB_NAME')) ?: "tu_base_local"; 
        $this->username = trim(getenv('DB_USER')) ?: "root";
        $this->password = getenv('DB_PASS') ?: ""; // La contraseña no lleva trim por seguridad
        $this->port = trim(getenv('DB_PORT')) ?: "3306";

        try {
            $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name . ";charset=utf8mb4";
            
            $options = [
                PDO::MYSQL_ATTR_SSL_CA => true,
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false, 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                // Forzamos el uso de SSL para TiDB
                PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            
        } catch(PDOException $exception) {
            // Esto te dirá exactamente qué dato está fallando en la sustentación
            die("Error de conexión: " . $exception->getMessage());
        }

        return $this->conn;
    }
}