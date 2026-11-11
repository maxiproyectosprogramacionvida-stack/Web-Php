<?php
    ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
    
mysqli_report(MYSQLI_REPORT_OFF);

$servidor = "sql207.infinityfree.com";
$usuario = "if0_43414317";
$password = "x3XPQhmPike";
$base_datos = "if0_43414317_respuestoscars";

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
