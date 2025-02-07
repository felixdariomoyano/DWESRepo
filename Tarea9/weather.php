<?php
// Importar 'functions.php'
require 'functions.php';

// Verificar si se ha enviado una ciudad desde el formulario
if (isset($_GET['ciudad']) && !empty($_GET['ciudad'])) {
    $ciudad = htmlspecialchars($_GET['ciudad']); // Sanitizar la entrada
} else {
    die("Error: No se ha especificado una ciudad.");
}

// Obtener datos del clima
if (!isset($error)) {
    $datos = datosClima($ciudad);

    // Verificar si hubo un error al obtener los datos del clima
    if (is_string($datos)) {
        $error = $datos;
    } else {
        // Extraer información relevante
        $nombreCiudad = $datos['name'];
        $temperatura = $datos['main']['temp'];
        $tiempo = $datos['weather'][0]['description'];
        $humedad = $datos['main']['humidity'];
        $viento = $datos['wind']['speed'];
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/styles.css"/>
    <title>DWES - Tarea 9</title>
</head>
<body>
    <header>
        <h1>Aplicación del Clima</h1>
    </header>
    <section>
    <?php if (isset($error)): ?>
        <div class="error-message">
            <h2>Error</h2>
            <p><?php echo $error; ?></p>
        </div>
    <?php else: ?>
        <h2>Clima en <?php echo $nombreCiudad; ?></h2>
        <div class="weather-info">
            <p><strong>Temperatura:</strong> <?php echo $temperatura; ?> °C</p>
            <p><strong>Tiempo:</strong> <?php echo ucfirst($tiempo); ?></p>
            <p><strong>Humedad:</strong> <?php echo $humedad; ?>%</p>
            <p><strong>Viento:</strong> <?php echo $viento; ?> m/s</p>
        </div>
    <?php endif; ?>
        <a href="index.html" class="btn-volver">Volver al inicio</a>
    </section>
    <footer>
        <h3>FÉLIX DARÍO MOYANO ROMERO</h3>
        <h3>DNI: 51000993-B</h3>
    </footer>
</body>
</html>