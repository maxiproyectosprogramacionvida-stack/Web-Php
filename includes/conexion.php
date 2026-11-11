<?php
mysqli_report(MYSQLI_REPORT_OFF);

$servidor = "localhost";
$usuario = "root";
$password = "";
$base_datos = "parcial2_db";

$conexion = mysqli_connect($servidor, $usuario, $password, $base_datos);

if (!$conexion) {
    error_log("Error de conexion MySQL: " . mysqli_connect_error());
    http_response_code(500);
    exit("No se pudo conectar con la base de datos.");
}

if (!mysqli_set_charset($conexion, "utf8mb4")) {
    error_log("Error al configurar UTF-8: " . mysqli_error($conexion));
    http_response_code(500);
    exit("No se pudo configurar la conexion con la base de datos.");
}
