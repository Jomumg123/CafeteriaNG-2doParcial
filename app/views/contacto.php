<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contacto y Pedidos | Coffee Bliss</title>
    <link rel="stylesheet" href="css/style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../app/views/includes/header.php'; ?>
    <main>
        
        <section class="contact-section">
            
            <h2>Haz tu Pedido o Consulta</h2>
            
            <form action="#" method="POST" class="contact-form">
                
                <div>
                    <label for="nombre">Nombre Completo:</label>
                    <input type="text" id="nombre" name="nombre" placeholder="(Ej: Joel Mullo Guapi)">
                </div>
                
                <div>
                    <label for="email">Correo Electrónico:</label>
                    <input type="email" id="email" name="email" placeholder="(Ej: correo@hotmail.com)">
                </div>
                
                <div>
                    <label for="celular">Número Celular:</label>
                    <input type="text" id="celular" name="celular" placeholder="(Ej: 0999999999)">
                </div>
                
                <div>
                    <label for="mensaje">Tu Pedido / Mensaje:</label>
                    <textarea id="mensaje" name="mensaje"></textarea>
                </div>
                
                <button type="submit" class="form-button">Enviar Pedido / Consulta</button>
                
                <div class="feedback-section">
                    <h3>Dinos qué Piensas</h3>
                    
                    <div>
                        <label for="calificacion">Calificación de Servicio (1 a 5 Estrellas)</label>
                        <select id="calificacion" name="calificacion">
                            <option value="">-- Selecciona una Opción --</option>
                            <option value="5">⭐⭐⭐⭐⭐ Excelente</option>
                            <option value="4">⭐⭐⭐⭐ Muy Bueno</option>
                            <option value="3">⭐⭐⭐ Bueno</option>
                            <option value="2">⭐⭐ Regular</option>
                            <option value="1">⭐ Pobre</option>
                        </select>
                    </div>

                    <div id="sugerencias-container" style="display:none; margin-top: 15px;">
                        <label for="sugerencias">Por favor, escribe tus sugerencias o motivos:</label>
                        <textarea id="sugerencias" name="sugerencias"></textarea>
                    </div>
                    
                    <button type="submit" class="form-button">Enviar Calificación</button>
                </div>
                
            </form>
            
        </section>
        
    </main>

    <?php include '../app/views/includes/footer.php'; ?>

    <script src="js/script.js"></script>
</body>
</html>