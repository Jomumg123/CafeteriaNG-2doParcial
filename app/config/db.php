<?php
class Database {
    // Leemos las variables que acabas de poner en Render
    private $host = getenv('DB_HOST') ?: "gateway01.us-east-1.prod.aws.tidbcloud.com";
    private $db_name = getenv('DB_NAME') ?: "test";
    private $username = getenv('DB_USER') ?: "5UVkaYG7qFHDErc.root";
    private $password = getenv('DB_PASS') ?: "GqnKD6xYlIleYKtT";
    private $port = getenv('DB_PORT') ?: "4000";
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            // Añadimos el puerto a la cadena de conexión para TiDB
            $this->conn = new PDO("mysql:host=" . $this->host . ";port=" . $this->port . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->exec("set names utf8");
        } catch(PDOException $exception) {
            echo "Error de conexión: " . $exception->getMessage();
        }
        return $this->conn;
    }
}