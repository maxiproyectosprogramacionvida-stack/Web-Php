<?php
session_start();
require_once "../includes/conexion.php";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['mensaje'] = "Repuesto eliminado del sistema.";
    } else {
        $_SESSION['mensaje'] = "Error al intentar eliminar el registro.";
    }
}

header("Location: index.php");
exit();
?>