<?php
class Pedido {
    private $conn;
    private $table_name = "pedidos";

    public function __construct($db) {
        $this->conn = $db;
    }

    // Registrar un nuevo pedido
    public function registrar($usuario_id, $producto_id, $cantidad, $notas) {
        // La consulta ahora incluye cantidad y notas
        $query = "INSERT INTO " . $this->table_name . " 
                (usuario_id, producto_id, cantidad, notas, estado) 
                VALUES (:u, :p, :c, :n, 'Pendiente')";
        
        $stmt = $this->conn->prepare($query);
        
        // Vinculamos todos los parámetros
        $stmt->bindParam(":u", $usuario_id);
        $stmt->bindParam(":p", $producto_id);
        $stmt->bindParam(":c", $cantidad);
        $stmt->bindParam(":n", $notas);
        
        return $stmt->execute();
    }

        // Leer todos los pedidos (para el administrador)
    public function obtenerTodos() {
        // Agregamos pr.precio, p.cantidad y p.notas a la selección
        $query = "SELECT p.id, u.nombre as cliente, pr.nombre as producto, 
                        pr.precio, p.cantidad, p.notas, p.fecha_pedido, p.estado 
                FROM pedidos p
                JOIN usuarios u ON p.usuario_id = u.id
                JOIN productos pr ON p.producto_id = pr.id
                ORDER BY p.fecha_pedido DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt;
    }
    // Cambiar el estado del pedido a Entregado
    public function marcarComoEntregado($id) {
        $query = "UPDATE " . $this->table_name . " SET estado = 'Entregado' WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        return $stmt->execute();
    }
}