<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú | Coffee NG</title>
    <link rel="stylesheet" href="css/style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    
    <header class="main-header">
        <div class="header-logo-container">
            <img src="img/logo3.png" alt="Logo Coffee NG" class="logo-img">
            <h1>Coffee NG</h1> 
        </div>
        <nav class="main-nav-bar">
            <ul class="nav-list">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="index.php?action=menu" class="active">Menú</a></li>
                <li><a href="index.php?action=contacto">Contacto y Pedidos</a></li>
                <li><a href="index.php?action=nuevo" style="color: #d4a373;">+ Admin Productos</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="hero-menu-banner">
            <h2>✨ Deliciosos Sabores para Compartir ✨</h2>
            <p>Descubre nuestra selección de cafés y postres artesanales, hechos con pasión.</p>
        </section>

        <section class="menu-catalogo">
            <h3>Nuestra Carta</h3>
            
            <article class="menu-category">
                <h4>Productos en Nuestra Cafetería</h4>
                <div class="menu-item-list">
                    
                    <?php 
                    // Este bloque PHP recorre los datos de MySQL
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): 
                    ?>
                        <div class="menu-item">
                            <img src="img/latte.png" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
                            <h5><?php echo htmlspecialchars($row['nombre']); ?></h5>
                            <p><?php echo htmlspecialchars($row['descripcion']); ?></p>
                            <span class="price">$<?php echo number_format($row['precio'], 2); ?></span>
                            
                            <div style="margin-top: 15px; display: flex; justify-content: center; gap: 10px;">
                                <a href="index.php?action=editar&id=<?php echo $row['id']; ?>" class="btn-admin-edit">
                                    Editar
                                </a> 
                                <a href="index.php?action=eliminar&id=<?php echo $row['id']; ?>" class="btn-admin-delete" onclick="return confirm('¿Eliminar este producto?')">
                                    Eliminar
                                </a>
                            </div>
                        </div>
                    <?php endwhile; ?>

                </div>
            </article>
        </section>
        
        <hr>

        <section class="location-section">
            <h4>Visítanos 📍</h4>
            <p>Estamos ubicados en: Av. Principal 123, Ciudad de Guayaquil.</p>
            <div class="map-placeholder">
                <iframe src="https://www.google.com/maps/embed?pb=..." width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>
    </main>

    <footer class="main-footer">
        <img src="img/logo3.png" alt="Logo Coffee NG" class="footer-logo">
        <p>© 2025 Coffee NG. Todos los derechos reservados.</p>
        <div class="social-links">
            <a href="#"><img src="img/facebook.svg" alt="Facebook" width="24" height="24"></a>
            <a href="#"><img src="img/instagram.svg" alt="Instagram" width="24" height="24"></a>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>