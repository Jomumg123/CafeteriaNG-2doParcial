<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee NG | El Refugio Perfecto</title>
    <link rel="stylesheet" href="css/style.css"> 
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <?php include '../app/views/includes/header.php'; ?>
    
    <main>
        <section class="hero-homepage">
            <div class="hero-content">
                <h2>Bienvenido a tu Refugio de Café</h2>
                <p>En Coffee NG, cada taza es una obra de arte. Utilizamos granos seleccionados para ofrecerte una experiencia única de sabor y tranquilidad.</p>
                <a href="index.php?action=menu" class="cta-button">Ver Nuestro Menú Completo</a>
            </div>
        </section>

        <section class="info-section" style="display: flex; align-items: center; gap: 50px; padding: 80px 10%; background-color: #fff;">
            <div style="flex: 1;">
                <img src="img/historia.jpg" alt="Nuestra Historia" style="width: 100%; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); object-fit: cover;">
            </div>
            <div style="flex: 1;">
                <h3 style="font-family: 'Playfair Display'; color: #6F4E37; font-size: 2.5rem; margin-bottom: 20px;">Nuestra Herencia</h3>
                <p style="line-height: 1.8; color: #555; font-size: 1.1rem;">
                    Coffee NG nació en el corazón de Guayaquil con un propósito simple: devolverle al café su lugar como ritual de paz. Lo que comenzó como un pequeño carrito de granos seleccionados, hoy es el refugio favorito de quienes buscan calidad y un respiro del caos diario.
                </p>
            </div>
        </section>

        <section class="info-section" style="display: flex; align-items: center; gap: 50px; padding: 80px 10%; background-color: #F5F5DC; flex-direction: row-reverse;">
            <div style="flex: 1;">
                <img src="img/vision.png" alt="Misión y Visión" style="width: 100%; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.1); object-fit: cover;">
            </div>
            <div style="flex: 1;">
                <div style="margin-bottom: 40px;">
                    <h4 style="font-family: 'Playfair Display'; color: #6F4E37; font-size: 2rem; margin-bottom: 10px;">Misión</h4>
                    <p style="line-height: 1.6; color: #555;">Proporcionar una experiencia sensorial inigualable a través de café artesanal de especialidad, fomentando momentos de conexión y tranquilidad en un ambiente acogedor.</p>
                </div>
                <div>
                    <h4 style="font-family: 'Playfair Display'; color: #6F4E37; font-size: 2rem; margin-bottom: 10px;">Visión</h4>
                    <p style="line-height: 1.6; color: #555;">Para el 2027, ser reconocidos como la cafetería líder en innovación y calidad artesanal en la región, expandiendo nuestro refugio a cada rincón de la ciudad.</p>
                </div>
            </div>
        </section>

        <section style="padding: 60px 10%; text-align: center; background-color: #fff;">
            <h3 style="font-family: 'Playfair Display'; color: #6F4E37; margin-bottom: 40px;">Lo que nos define</h3>
            <div style="display: flex; justify-content: space-around; gap: 20px;">
                <div>
                    <span style="font-size: 3rem;">🌱</span>
                    <h5 style="margin-top:10px;">Sostenibilidad</h5>
                </div>
                <div>
                    <span style="font-size: 3rem;">☕</span>
                    <h5 style="margin-top:10px;">Calidad Premium</h5>
                </div>
                <div>
                    <span style="font-size: 3rem;">🤝</span>
                    <h5 style="margin-top:10px;">Comunidad</h5>
                </div>
            </div>
        </section>
    </main>

    <?php include '../app/views/includes/footer.php'; ?>
    <script src="js/script.js"></script>
</body>
</html>