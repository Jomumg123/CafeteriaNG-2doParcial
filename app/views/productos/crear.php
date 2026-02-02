<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo Producto | Coffee NG</title>
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
            <h2>Agregar Nuevo Café o Postre</h2>
            
            <form action="index.php?action=guardar" method="POST">
                <input type="text" name="nombre" class="input-admin" placeholder="Nombre del producto" required>
                
                <textarea name="descripcion" class="input-admin" rows="3" placeholder="Descripción"></textarea>
                
                <input type="number" step="0.01" name="precio" class="input-admin" placeholder="Precio (Ej: 3.50)" required>
                
                <select name="categoria" class="input-admin">
                    <option value="" disabled selected>Seleccionar Categoría</option>
                    <option value="Bebidas">Bebidas</option>
                    <option value="Postres">Postres</option>
                </select>

                <button type="submit" class="btn-guardar-admin">Guardar Producto</button>
                <a href="index.php?action=menu" class="volver-link">Volver al Menú</a>
            </form>
        </div>
    </main>

    <footer class="main-footer">
        <img src="img/logo3.png" alt="Logo Coffee NG" class="footer-logo">
        <p>© 2025 Coffee NG. Todos los derechos reservados.</p>
    </footer>

</body>
</html>