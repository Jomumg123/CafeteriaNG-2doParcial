<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Producto | Coffee NG</title>
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
                <li><a href="index.php?action=menu">Menú</a></li>
                <li><a href="index.php?action=contacto">Contacto y Pedidos</a></li>
            </ul>
        </nav>
    </header>

    <main class="flex-admin-container">
        <div class="card-formulario">
            <h2>Editar Café o Postre</h2>
            
            <form action="index.php?action=actualizar" method="POST">
                
                <input type="hidden" name="id" value="<?php echo $producto['id']; ?>">

                <div style="text-align: left; margin-bottom: 5px;">
                    <label style="font-size: 0.8em; color: #6f4e37; font-weight: bold;">Nombre del producto</label>
                </div>
                <input type="text" name="nombre" class="input-admin" 
                       value="<?php echo htmlspecialchars($producto['nombre']); ?>" required>
                
                <div style="text-align: left; margin-bottom: 5px;">
                    <label style="font-size: 0.8em; color: #6f4e37; font-weight: bold;">Descripción</label>
                </div>
                <textarea name="descripcion" class="input-admin" rows="3"><?php echo htmlspecialchars($producto['descripcion']); ?></textarea>
                
                <div style="text-align: left; margin-bottom: 5px;">
                    <label style="font-size: 0.8em; color: #6f4e37; font-weight: bold;">Precio ($)</label>
                </div>
                <input type="number" step="0.01" name="precio" class="input-admin" 
                       value="<?php echo $producto['precio']; ?>" required>
                
                <div style="text-align: left; margin-bottom: 5px;">
                    <label style="font-size: 0.8em; color: #6f4e37; font-weight: bold;">Categoría</label>
                </div>
                <select name="categoria" class="input-admin">
                    <option value="Bebidas" <?php echo ($producto['categoria'] == 'Bebidas') ? 'selected' : ''; ?>>Bebidas</option>
                    <option value="Postres" <?php echo ($producto['categoria'] == 'Postres') ? 'selected' : ''; ?>>Postres</option>
                </select>

                <button type="submit" class="btn-guardar-admin">Actualizar Cambios</button>
                <a href="index.php?action=menu" class="volver-link">Cancelar y Volver</a>
            </form>
        </div>
    </main>

    <footer class="main-footer">
        <img src="img/logo3.png" alt="Logo Coffee NG" class="footer-logo">
        <p>© 2025 Coffee NG. Todos los derechos reservados.</p>
    </footer>

</body>
</html>