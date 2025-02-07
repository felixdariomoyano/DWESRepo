<?php
/**
 * Importa el archivo 'functions.php' que contiene la función para obtener datos del clima.
 */
require 'functions.php';

/**
 * Verifica si se ha enviado una ciudad desde el formulario mediante el método GET.
 * Si no se proporciona una ciudad, finaliza la ejecución con un mensaje de error.
 */
if (isset($_GET['ciudad']) && !empty($_GET['ciudad'])) {
    // Sanitiza la entrada para evitar ataques XSS
    $ciudad = htmlspecialchars($_GET['ciudad']); 
} else {
    die("Error: No se ha especificado una ciudad.");
}

// Obtener datos del clima
if (!isset($error)) {
    /**
     * Llama a la función datosClima para obtener la información del clima de la ciudad ingresada.
     * @var array|string $datos Contiene los datos del clima en caso de éxito o un mensaje de error.
     */
    $datos = datosClima($ciudad);

    /**
     * Verifica si la función datosClima devolvió un mensaje de error o los datos del clima.
     */
    if (is_string($datos)) {
        // Almacena el mensaje de error
        $error = $datos;
    } else {
        // Extrae la información relevante del array de datos del clima
        /** @var string $nombreCiudad Nombre de la ciudad obtenida de la API */
        $nombreCiudad = $datos['name'];
        /** @var float $temperatura Temperatura actual en grados Celsius */
        $temperatura = $datos['main']['temp'];
        /** @var string $tiempo Descripción del clima actual */
        $tiempo = $datos['weather'][0]['description'];
        /** @var int $humedad Porcentaje de humedad relativa */
        $humedad = $datos['main']['humidity'];
        /** @var float $viento Velocidad del viento en metros por segundo */
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
        <!-- Muestra un mensaje de error si ocurrió un problema al obtener los datos -->
        <div class="error-message">
            <h2>Error</h2>
            <p><?php echo $error; ?></p>
        </div>
    <?php else: ?>
        <!-- Muestra la información del clima si no hubo errores -->
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
        <!-- Enlace para volver a la página principal -->
        <h3>FÉLIX DARÍO MOYANO ROMERO</h3>
        <h3>DNI: 51000993-B</h3>
    </footer>
</body>
</html>