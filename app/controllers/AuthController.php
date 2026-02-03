<?php
// app/controllers/AuthController.php

class AuthController {
    private $db;
    private $usuario;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        require_once "../app/models/Usuario.php";
        $this->usuario = new Usuario($this->db);
        
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function mostrarLogin() {
        require_once "../app/views/auth/login.php";
    }

    public function procesarLogin() {
        if ($_POST) {
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $user = $this->usuario->buscarPorEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_rol'] = $user['rol']; 
                $_SESSION['user_nombre'] = $user['nombre'];
                $_SESSION['user_foto'] = $user['foto_perfil']; 
                $_SESSION['user_telefono'] = $user['telefono'];

                // Mensaje de bienvenida personalizado
                $_SESSION['mensaje'] = "¡Bienvenido de nuevo, " . explode(' ', $user['nombre'])[0] . "!";
                $_SESSION['tipo_mensaje'] = "success";

                if ($user['rol'] === 'admin') {
                    header("Location: index.php?action=menu&view=admin"); 
                } else {
                    header("Location: index.php?action=menu&view=cliente");
                }
                exit();
            } else {
                // MENSAJE DE ERROR: Credenciales incorrectas
                $_SESSION['mensaje'] = "Correo o contraseña incorrectos. Por favor, intenta de nuevo.";
                $_SESSION['tipo_mensaje'] = "error";
                header("Location: index.php?action=login");
                exit();
            }
        }
    }

    public function logout() {
        session_destroy();
        session_start(); // Iniciamos una nueva para mostrar el mensaje de despedida
        $_SESSION['mensaje'] = "Has cerrado sesión correctamente.";
        $_SESSION['tipo_mensaje'] = "info";
        header("Location: index.php");
        exit();
    }

    public function mostrarRegistro() {
        require_once "../app/views/auth/registro.php";
    }

    public function procesarRegistro() {
        if ($_POST) {
            $nombre   = $_POST['nombre'];
            $email    = $_POST['email'];
            $telefono = $_POST['telefono']; 
            $passRaw  = $_POST['password'];

            $passwordHasheada = password_hash($passRaw, PASSWORD_DEFAULT);

            if ($this->usuario->registrar($nombre, $email, $telefono, $passwordHasheada)) {
                // MENSAJE DE ÉXITO: Registro completado
                $_SESSION['mensaje'] = "¡Cuenta creada con éxito! Ahora puedes iniciar sesión.";
                $_SESSION['tipo_mensaje'] = "success";
                header("Location: index.php?action=login");
                exit();
            } else {
                $_SESSION['mensaje'] = "Hubo un error al crear la cuenta. Inténtalo más tarde.";
                $_SESSION['tipo_mensaje'] = "error";
                header("Location: index.php?action=registro");
                exit();
            }
        }
    }
}