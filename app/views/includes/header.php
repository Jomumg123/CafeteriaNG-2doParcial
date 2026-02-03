<?php
$current_action = isset($_GET['action']) ? $_GET['action'] : 'index';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
<header class="main-header">
    
    <div class="header-left">
        <img src="img/logo3.png" alt="Logo" class="logo-img">
        <div class="brand-text">
            <h1>Coffee NG</h1>
            <span class="slogan">El Refugio Perfecto</span>
        </div>
    </div>

    <button class="menu-toggle" id="mobile-menu">
        <span class="bar"></span>
        <span class="bar"></span>
        <span class="bar"></span>
    </button>

    <nav class="nav-container">
        <ul class="nav-list">
            <li><a href="index.php" class="<?php echo ($current_action == 'index') ? 'active' : ''; ?>">Inicio</a></li>
            <li><a href="index.php?action=menu" class="<?php echo ($current_action == 'menu') ? 'active' : ''; ?>">Menú</a></li>

            <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
                <li><a href="index.php?action=ver_pedidos" class="<?php echo ($current_action == 'ver_pedidos') ? 'active' : ''; ?>">Pedidos</a></li>
            <?php else: ?>
                <li><a href="index.php?action=contacto" class="<?php echo ($current_action == 'contacto') ? 'active' : ''; ?>">Contacto y Pedidos</a></li>
            <?php endif; ?>
        </ul>
    </nav>

    <div class="header-right">
        <?php if (isset($_SESSION['user_id'])): ?>
            <div class="user-logged-box">
                <div class="user-info">
                    <span class="user-name">
                        <?php echo explode(' ', $_SESSION['user_nombre'])[0]; ?>
                    </span>
                    <a href="index.php?action=logout" class="logout-link">Cerrar Sesión</a>
                </div>
                <img src="img/profiles/<?php echo $_SESSION['user_foto']; ?>" class="user-avatar">
            </div>
        <?php else: ?>
            <a href="index.php?action=login" class="btn-acceder">Acceder</a>
        <?php endif; ?>
    </div>
</header>

<?php if (isset($_SESSION['mensaje'])): ?>
    <div id="alert-box" class="alert-msg <?php echo $_SESSION['tipo_mensaje']; ?>">
        <?php 
            echo $_SESSION['mensaje']; 
            unset($_SESSION['mensaje']); 
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