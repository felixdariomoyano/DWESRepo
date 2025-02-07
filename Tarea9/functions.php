<?php

function datosClima ($ciudad) {

    // API key de OpenWeatherMap
    $apiKey = "d3a14dd90f0896e982a8169b5a82a0c6";
    $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$ciudad}&appid={$apiKey}&units=metric&lang=es";

    // Obtener datos de la API usando file_get_contents
    $respuesta = @file_get_contents($apiUrl);

    // Manejar error de conexión
    if ($respuesta === FALSE) {
        return "La ciudad " . $ciudad . " no se encuentra en la base de datos";
    }

    // Decodificar la respuesta JSON
    $datos = json_decode($respuesta, true);

    // Verificar si la API devolvió otros errores
    if (isset($datos['cod']) && $datos['cod'] !== 200) {
        return "Error en la API: " . $datos['message'];
    }

    // Devolver los datos del clima si todo está bien
    return $datos;
}

?>