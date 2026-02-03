<?php
// Incluimos el encabezado unificado
include '../app/views/includes/header.php'; 
?>

<main class="flex-admin-container">
    <div class="card-formulario">
        <img src="img/logo3.png" alt="Logo" style="width: 80px; margin-bottom: 10px;">
        
        <h2>Acceso al Sistema</h2>
        <p style="margin-bottom: 20px; font-size: 0.9em; color: #666;">
            Ingresa tus credenciales para gestionar la cafetería.
        </p>
        
        <form action="index.php?action=procesar_login" method="POST">
            <div style="text-align: left; margin-bottom: 5px;">
                <label style="font-size: 0.8em; color: #6f4e37; font-weight: bold;">Correo Electrónico</label>
            </div>
            <input type="email" name="email" class="input-admin" placeholder="ejemplo@correo.com" required>
            
            <div style="text-align: left; margin-bottom: 5px;">
                <label style="font-size: 0.8em; color: #6f4e37; font-weight: bold;">Contraseña</label>
            </div>
            
            <div style="position: relative; width: 100%;">
                <input type="password" 
                       id="login-password" 
                       name="password" 
                       class="input-admin" 
                       placeholder="••••••••" 
                       required>
                <button type="button" 
                        onclick="togglePassword('login-password')" 
                        style="position: absolute; right: 10px; top: 12px; background: none; border: none; cursor: pointer; font-size: 1.2rem;">
                    👁️
                </button>
            </div>

            <button type="submit" class="btn-guardar-admin">Entrar</button>

            <div style="margin-top: 20px; padding-top: 15px; border-top: 1px solid #ddd;">
                <p style="font-size: 0.85em; color: #666; margin-bottom: 10px;">¿No tienes una cuenta?</p>
                <a href="index.php?action=registro" class="volver-link">
                    Regístrate aquí como Cliente
                </a>
            </div>

            <a href="index.php?action=menu" class="volver-link" style="display:block; margin-top:15px;">Volver al Menú</a>
        </form>
    </div>
</main>

<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        if (input.type === "password") {
            input.type = "text";
        } else {
            input.type = "password";
        }
    }
</script>

<?php 
// Incluimos el pie de página unificado
include '../app/views/includes/footer.php'; 
?>