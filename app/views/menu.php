<?php 
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
    <style>
        /* Estilos rápidos para el Modal */
        .modal-pedido {
            display: none; 
            position: fixed; 
            z-index: 1000; 
            left: 0; top: 0; 
            width: 100%; height: 100%; 
            background-color: rgba(0,0,0,0.5);
            backdrop-filter: blur(3px);
        }
        .modal-content {
            background-color: #fff;
            margin: 10% auto;
            padding: 30px;
            border-radius: 20px;
            width: 90%;
            max-width: 450px;
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
            font-family: 'Montserrat', sans-serif;
        }
    </style>
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

                    <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)): ?>
                        <div class="menu-item">
                            <img src="img/uploads/<?php echo $row['imagen']; ?>" alt="<?php echo htmlspecialchars($row['nombre']); ?>">
                            <h5><?php echo htmlspecialchars($row['nombre']); ?></h5>
                            <p><?php echo htmlspecialchars($row['descripcion']); ?></p>
                            <span class="price">$<?php echo number_format($row['precio'], 2); ?></span>
                            
                            <div style="margin-top: 15px; display: flex; justify-content: center; gap: 10px;">
                                <?php if (isset($_SESSION['user_rol'])): ?>
                                    <?php if ($_SESSION['user_rol'] === 'admin'): ?>
                                        <a href="index.php?action=editar&id=<?php echo $row['id']; ?>" class="btn-admin-edit">Editar</a> 
                                        <a href="index.php?action=eliminar&id=<?php echo $row['id']; ?>" class="btn-admin-delete" onclick="return confirm('¿Eliminar este producto?')">Eliminar</a>
                                    
                                    <?php elseif ($_SESSION['user_rol'] === 'cliente'): ?>
                                        <button onclick="abrirModal('<?php echo $row['id']; ?>', '<?php echo htmlspecialchars($row['nombre']); ?>')" 
                                                style="background-color: #6F4E37; color: white; border: none; padding: 8px 20px; border-radius: 25px; font-weight: bold; cursor: pointer;">
                                           ☕ Pedir ahora
                                        </button>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <a href="index.php?action=login" style="font-size: 0.8rem; color: #A0522D; text-decoration: none; font-weight: bold; border: 1px solid #A0522D; padding: 5px 10px; border-radius: 15px;">
                                        Inicia sesión para pedir
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </article>
        </section>

        <div id="modalPedido" class="modal-pedido">
            <div class="modal-content">
                <h3 id="modalTitulo" style="color: #6F4E37; margin-top: 0;">Confirmar Pedido</h3>
                <form action="index.php?action=realizar_pedido" method="POST">
                    <input type="hidden" id="modal_id_producto" name="id_producto">
                    
                    <div style="margin-bottom: 15px;">
                        <label style="display: block; font-size: 0.9rem; margin-bottom: 5px;">¿Cuántos deseas?</label>
                        <input type="number" name="cantidad" value="1" min="1" max="10" class="input-admin" style="width: 100%;" required>
                    </div>

                    <div style="margin-bottom: 20px;">
                        <label style="display: block; font-size: 0.9rem; margin-bottom: 5px;">Notas (ej: Sin azúcar, leche de almendras...)</label>
                        <textarea name="notas" class="input-admin" style="width: 100%; height: 80px;" placeholder="Opcional"></textarea>
                    </div>

                    <div style="display: flex; gap: 10px;">
                        <button type="submit" class="btn-guardar-admin" style="margin: 0; flex: 2;">Confirmar Pedido</button>
                        <button type="button" onclick="cerrarModal()" style="flex: 1; background: #eee; border: none; border-radius: 8px; cursor: pointer;">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
        
        <hr>
        <section class="location-section">
            <h4>Visítanos 📍</h4>
            <p>Estamos ubicados en: Av. Principal 123, Ciudad de Guayaquil.</p>
            <div class="map-placeholder">
                <iframe src="https://maps.google.com/maps?q=Guayaquil&t=&z=13&ie=UTF8&iwloc=&output=embed" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </section>
    </main>

    <?php include '../app/views/includes/footer.php'; ?>

    <script>
        function abrirModal(id, nombre) {
            document.getElementById('modal_id_producto').value = id;
            document.getElementById('modalTitulo').innerText = 'Pedir ' + nombre;
            document.getElementById('modalPedido').style.display = 'block';
        }

        function cerrarModal() {
            document.getElementById('modalPedido').style.display = 'none';
        }

        // Cerrar si hace clic fuera del modal
        window.onclick = function(event) {
            let modal = document.getElementById('modalPedido');
            if (event.target == modal) { cerrarModal(); }
        }
    </script>
</body>
</html>