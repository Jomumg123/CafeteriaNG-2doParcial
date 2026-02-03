<?php 
// 1. Iniciamos la sesión al principio para verificar los privilegios
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
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
    <?php include '../app/views/includes/header.php'; ?>

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
                    
                    <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
                        <a href="index.php?action=nuevo" style="text-decoration: none; display: block;">
                            <div class="menu-item" style="border: 2px dashed #C39977; background-color: #fdf5e6; height: 100%; display: flex; flex-direction: column; justify-content: center; align-items: center; min-height: 250px; cursor: pointer;">
                                <span style="font-size: 4rem; color: #6F4E37; line-height: 1;">+</span>
                                <h5 style="margin-top: 10px; color: #6F4E37;">Agregar Nuevo</h5>
                            </div>
                        </a>
                    <?php endif; ?>

                    <?php 
                    // Ciclo para mostrar los productos de la base de datos
                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): 
                    ?>
                        <div class="menu-item">
                            <img src="img/uploads/<?php echo $row['imagen']; ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
                            
                            <h5><?php echo htmlspecialchars($row['nombre']); ?></h5>
                            <p><?php echo htmlspecialchars($row['descripcion']); ?></p>
                            <span class="price">$<?php echo number_format($row['precio'], 2); ?></span>
                            
                            <?php if (isset($_SESSION['user_rol']) && $_SESSION['user_rol'] === 'admin'): ?>
                                <div style="margin-top: 15px; display: flex; justify-content: center; gap: 10px;">
                                    <a href="index.php?action=editar&id=<?php echo $row['id']; ?>" class="btn-admin-edit">Editar</a> 
                                    <a href="index.php?action=eliminar&id=<?php echo $row['id']; ?>" class="btn-admin-delete" onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
                                </div>
                            <?php endif; ?>
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15947.63236316279!2d-79.896621!3d-2.190161!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x902d13c17102409f%3A0x7d0696a40a833543!2sGuayaquil!5e0!3m2!1ses!2sec!4v1640000000000!5m2!1ses!2sec" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>
    </main>

    <?php include '../app/views/includes/footer.php'; ?>

    <script src="js/script.js"></script>
</body>
</html>