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
    <?php include '../app/views/includes/header.php'; ?>
    <main class="flex-admin-container">
        <div class="card-formulario">
            <h2>Editar Café o Postre</h2>
            
            <form action="index.php?action=actualizar" method="POST" enctype="multipart/form-data">
                
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

                <div style="text-align: left; margin: 15px 0;">
                    <label style="display: block; font-size: 0.8em; color: #4a332d; font-weight: bold; margin-bottom: 10px;">Imagen Actual:</label>
                    <div style="text-align: center; margin-bottom: 10px;">
                        <img src="img/uploads/<?php echo $producto['imagen']; ?>" 
                             alt="Vista previa" 
                             style="width: 100px; height: 100px; object-fit: cover; border-radius: 10px; border: 2px solid #d4a373;">
                    </div>

                    <label style="display: block; font-size: 0.8em; color: #4a332d; font-weight: bold; margin-bottom: 5px;">Cambiar Imagen:</label>
                    <input type="file" name="imagen" class="input-admin" accept="image/*">
                    <small style="display: block; color: #888; font-size: 0.7em;">Deje vacío para mantener la imagen actual.</small>
                </div>

                <button type="submit" class="btn-guardar-admin">Actualizar Cambios</button>
                <a href="index.php?action=menu" class="volver-link" style="display: block; margin-top: 15px; text-decoration: none; color: #6f4e37; font-size: 0.9em;">Cancelar y Volver</a>
            </form>
        </div>
    </main>
    <?php include '../app/views/includes/footer.php'; ?>
</body>
</html>