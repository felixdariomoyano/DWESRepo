<?php
/**
 * Obtiene los datos del clima de una ciudad específica desde la API de OpenWeatherMap.
 *
 * @param string $ciudad Nombre de la ciudad ingresada por el usuario.
 * @return array|string Retorna un array con la información del clima si la solicitud es exitosa,
 *  o un mensaje de error en caso de fallo.
 */
function datosClima ($ciudad) {

    // API key de OpenWeatherMap
    $apiKey = "d3a14dd90f0896e982a8169b5a82a0c6";

    // URL de la API con los parámetros de ciudad, API key, unidades en Celsius y lenguaje en español
    $apiUrl = "https://api.openweathermap.org/data/2.5/weather?q={$ciudad}&appid={$apiKey}&units=metric&lang=es";

    /* 
     * Obtener datos de la API usando file_get_contents 
     * Se utiliza @ para suprimir los errores de PHP y manejar la respuesta de manera personalizada.
     */
    $respuesta = @file_get_contents($apiUrl);

    // Si no hay datos o la solicitud falla, retorna un mensaje de error
    if ($respuesta === FALSE) {
        return "La ciudad " . $ciudad . " no se encuentra en la base de datos";
    }

    // Decodificar la respuesta JSON en un array asociativo
    $datos = json_decode($respuesta, true);

    // Verificar si la API devolvió un error y manejarlo adecuadamente
    if (isset($datos['cod']) && $datos['cod'] !== 200) {
        return "Error en la API: " . $datos['message'];
    }

    // Devolver los datos del clima en formato de array si la solicitud fue exitosa
    return $datos;
}

?>