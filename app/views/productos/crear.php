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
    <?php include '../app/views/includes/header.php'; ?>

    <main class="flex-admin-container">
        <div class="card-formulario">
            <h2>Agregar Nuevo Café o Postre</h2>
            
            <form action="index.php?action=guardar" method="POST" enctype="multipart/form-data">
                
                <input type="text" name="nombre" class="input-admin" placeholder="Nombre del producto" required>
                
                <textarea name="descripcion" class="input-admin" rows="3" placeholder="Descripción"></textarea>
                
                <input type="number" step="0.01" name="precio" class="input-admin" placeholder="Precio (Ej: 3.50)" required>
                
                <select name="categoria" class="input-admin">
                    <option value="" disabled selected>Seleccionar Categoría</option>
                    <option value="Bebidas">Bebidas</option>
                    <option value="Postres">Postres</option>
                </select>

                <div style="text-align: left; margin-bottom: 15px;">
                    <label style="display: block; font-size: 0.8em; color: #4a332d; font-weight: bold; margin-bottom: 5px;">Imagen del Producto</label>
                    <input type="file" name="imagen" class="input-admin" accept="image/*">
                </div>

                <button type="submit" class="btn-guardar-admin">Guardar Producto</button>
                <a href="index.php?action=menu" class="volver-link">Volver al Menú</a>
            </form>
        </div>
    </main>
    <?php include '../app/views/includes/footer.php'; ?>
</body>
</html>