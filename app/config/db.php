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

        $this->host = getenv('DB_HOST') ?: "localhost";
        $this->db_name = getenv('DB_NAME') ?: "tu_base_local";
        $this->username = getenv('DB_USER') ?: "root";
        $this->password = getenv('DB_PASS') ?: "";
        $this->port = getenv('DB_PORT') ?: "3306";

        try {
            $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name;
            
            // CONFIGURACIÓN PARA CONEXIÓN SEGURA (SSL) 
            $options = [
                PDO::MYSQL_ATTR_SSL_CA => true, // Esto habilita el soporte SSL obligatorio de TiDB
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }

        return $this->conn;
    }
}