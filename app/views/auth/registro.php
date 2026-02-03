<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Únete a Coffee NG | Registro</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../app/views/includes/header.php'; ?>
    <main class="flex-admin-container">
        <div class="card-formulario">
            <img src="img/logo3.png" alt="Logo" style="width: 80px; margin-bottom: 10px;">
            <h2>Crear Cuenta de Cliente</h2>
            <p style="font-size: 0.8em; color: #666; margin-bottom: 20px;">¡Únete para recibir promociones y hacer pedidos rápidos!</p>

            <form action="index.php?action=guardar_usuario" method="POST">
                <input type="text" name="nombre" class="input-admin" placeholder="Nombre Completo" required>
                
                <input type="email" name="email" class="input-admin" placeholder="Correo Electrónico" required>
                
                <input type="tel" 
                       name="telefono" 
                       class="input-admin" 
                       placeholder="Teléfono (10 dígitos)" 
                       pattern="[0-9]{10}" 
                       maxlength="10" 
                       title="Debe ingresar exactamente 10 números" 
                       required>
                
                <div style="position: relative; width: 100%;">
                    <input type="password" 
                           id="reg-password" 
                           name="password" 
                           class="input-admin" 
                           placeholder="Contraseña Segura" 
                           required>
                    <button type="button" 
                            onclick="togglePassword('reg-password')" 
                            style="position: absolute; right: 10px; top: 12px; background: none; border: none; cursor: pointer; font-size: 1.2rem;">
                        👁️
                    </button>
                </div>
                
                <button type="submit" class="btn-guardar-admin">Crear mi Cuenta</button>
                
                <div style="margin-top: 15px;">
                    <a href="index.php?action=login" class="volver-link">¿Ya eres parte? Inicia Sesión</a>
                </div>
            </form>
        </div>
    </main>
    
    <?php include '../app/views/includes/footer.php'; ?>

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
</body>
</html>