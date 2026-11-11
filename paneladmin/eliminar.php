<?php
session_start();
require_once "../includes/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id']) && is_numeric($_POST['id'])) {
    $id = (int) $_POST['id'];

    $sql = "DELETE FROM productos WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "i", $id);

        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                $_SESSION['mensaje'] = "Repuesto eliminado del sistema.";
            } else {
                $_SESSION['mensaje'] = "No se encontró el repuesto solicitado.";
            }
        } else {
            $_SESSION['mensaje'] = "Error al intentar eliminar el registro.";
        }

        mysqli_stmt_close($stmt);
    } else {
        $_SESSION['mensaje'] = "No se pudo preparar la consulta.";
    }
} else {
    $_SESSION['mensaje'] = "Solicitud de eliminación inválida.";
}

header("Location: admin.php");
exit();
?>
