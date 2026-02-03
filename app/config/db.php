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

        // Leemos variables de entorno para Render o valores por defecto para Localhost [cite: 19, 20]
        $this->host = getenv('DB_HOST') ?: "localhost";
        $this->db_name = getenv('DB_NAME') ?: "tu_base_local"; 
        $this->username = getenv('DB_USER') ?: "root";
        $this->password = getenv('DB_PASS') ?: "";
        $this->port = getenv('DB_PORT') ?: "3306";

        try {
            $dsn = "mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name;
            
            // CONFIGURACIÓN PARA CONEXIÓN SEGURA (SSL) [cite: 20, 61]
            $options = [
                PDO::MYSQL_ATTR_SSL_CA => true,
                // Esta línea soluciona el error "Cannot connect to MySQL using SSL" 
                PDO::MYSQL_ATTR_SSL_VERIFY_SERVER_CERT => false, 
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            // Mostramos un error detallado si falla la conexión [cite: 7, 73]
            die("Error crítico de conexión: " . $exception->getMessage());
        }

        return $this->conn;
    }
}