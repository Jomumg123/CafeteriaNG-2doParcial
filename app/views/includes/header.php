<?php
$current_action = isset($_GET['action']) ? $_GET['action'] : 'index';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
<header class="main-header" style="display: flex; align-items: center; justify-content: space-between; padding: 25px 5%; background-color: #F5F5DC; box-shadow: 0 4px 10px rgba(0,0,0,0.05);">
    
    <div style="flex: 1; display: flex; align-items: center; gap: 20px;">
        <img src="img/logo3.png" alt="Logo" style="width: 85px; border-radius: 50%; box-shadow: 0 4px 8px rgba(0,0,0,0.15);">
        <div style="display: flex; flex-direction: column; line-height: 1.1;">
            <h1 style="margin: 0; font-size: 2.1rem; color: #6F4E37; letter-spacing: 1px; font-family: 'Playfair Display', serif;">Coffee NG</h1>
            <span style="font-size: 0.95rem; color: #A0522D; font-style: italic; font-family: 'Montserrat', sans-serif; font-weight: 400; margin-top: 2px;">
                El Refugio Perfecto
            </span>
        </div>
    </div>

    <nav style="flex: 2; display: flex; justify-content: center;">
        <ul class="nav-list" style="display: flex; gap: 45px; list-style: none; margin: 0; padding: 0;">
            <li><a href="index.php" class="<?php echo ($current_action == 'index') ? 'active' : ''; ?>" style="text-decoration: none; font-weight: 700; color: #333; font-size: 1.1rem;">Inicio</a></li>
            <li><a href="index.php?action=menu" class="<?php echo ($current_action == 'menu') ? 'active' : ''; ?>" style="text-decoration: none; font-weight: 700; color: #333; font-size: 1.1rem;">Menú</a></li>

            <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
                <li><a href="index.php?action=gestionar_productos" class="<?php echo ($current_action == 'gestionar_productos') ? 'active' : ''; ?>" style="text-decoration: none; font-weight: 700; color: #333; font-size: 1.1rem;">Gestionar</a></li>
                <li><a href="index.php?action=ver_pedidos" class="<?php echo ($current_action == 'ver_pedidos') ? 'active' : ''; ?>" style="text-decoration: none; font-weight: 700; color: #333; font-size: 1.1rem;">Pedidos</a></li>
            <?php else: ?>
                <li><a href="index.php?action=contacto" class="<?php echo ($current_action == 'contacto') ? 'active' : ''; ?>" style="text-decoration: none; font-weight: 700; color: #333; font-size: 1.1rem;">Contacto y Pedidos</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div style="flex: 1; display: flex; justify-content: flex-end;">
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="user-logged-box" style="display: flex; align-items: center; gap: 12px; background: #fdf5e6; padding: 8px 18px; border-radius: 35px; border: 1px solid #C39977; box-shadow: 0 2px 5px rgba(0,0,0,0.05);">
                <div style="display: flex; flex-direction: column; text-align: right; line-height: 1.2;">
                    <span style="font-size: 0.9em; font-weight: bold; color: #6f4e37;">
                        <?php echo explode(' ', $_SESSION['user_nombre'])[0]; ?>
                    </span>
                    <a href="index.php?action=logout" style="font-size: 0.75em; color: #a0522d; text-decoration: none; font-weight: 700;">
                        Cerrar Sesión
                    </a>
                </div>
                <img src="img/profiles/<?php echo $_SESSION['user_foto']; ?>" style="width: 42px; height: 42px; border-radius: 50%; object-fit: cover; border: 2px solid #C39977;">
            </div>
        <?php else: ?>
            <a href="index.php?action=login" class="btn-acceder">Acceder</a>
        <?php endif; ?>
    </div>
</header>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div id="alert-box" style="padding: 15px; text-align: center; font-weight: bold; font-family: 'Montserrat', sans-serif; transition: all 0.5s ease;
        background-color: <?php echo ($_SESSION['tipo_mensaje'] == 'success') ? '#d4edda' : (($_SESSION['tipo_mensaje'] == 'error') ? '#f8d7da' : '#d1ecf1'); ?>; 
        color: <?php echo ($_SESSION['tipo_mensaje'] == 'success') ? '#155724' : (($_SESSION['tipo_mensaje'] == 'error') ? '#721c24' : '#0c5460'); ?>;
        border-bottom: 2px solid rgba(0,0,0,0.1);">
        
        <?php 
            echo $_SESSION['mensaje']; 
            unset($_SESSION['mensaje']); // Limpiamos el mensaje para que no se repita
            unset($_SESSION['tipo_mensaje']);
        ?>
    </div>

    <script>
        setTimeout(function() {
            var alert = document.getElementById('alert-box');
            if(alert) {
                alert.style.opacity = '0';
                setTimeout(function() { alert.style.display = 'none'; }, 500);
            }
        }, 4000);
    </script>
<?php endif; ?>