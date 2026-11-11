<?php
session_start();
require_once "../includes/conexion.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $descripcion = trim($_POST['descripcion'] ?? '');
    $precio = trim($_POST['precio'] ?? '');
    $stock = trim($_POST['stock'] ?? '');
    $imagen = trim($_POST['imagen'] ?? '');

    if (empty($imagen)) {
        $imagen = "https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=500";
    }

    if (
        empty($nombre) ||
        empty($categoria) ||
        empty($descripcion) ||
        $precio === '' ||
        $stock === ''
    ) {
        $error = "Por favor completa todos los campos obligatorios.";
    } elseif (!is_numeric($precio) || $precio < 0) {
        $error = "Ingresa un precio válido.";
    } elseif (!filter_var($stock, FILTER_VALIDATE_INT) && $stock !== "0") {
        $error = "Ingresa una cantidad de stock válida.";
    } elseif ($stock < 0) {
        $error = "El stock no puede ser negativo.";
    } else {
        $sql = "INSERT INTO productos (nombre, categoria, descripcion, precio, stock, imagen)
                VALUES (?, ?, ?, ?, ?, ?)";

        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "sssdis",
                $nombre,
                $categoria,
                $descripcion,
                $precio,
                $stock,
                $imagen
            );

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = "Repuesto agregado correctamente.";
                mysqli_stmt_close($stmt);
                header("Location: admin.php");
                exit();
            } else {
                $error = "Error al guardar el producto en la base de datos.";
                mysqli_stmt_close($stmt);
            }
        } else {
            $error = "No se pudo preparar la consulta.";
        }
    }
}

include("../includes/header.php");
include("../includes/nav.php");
?>

<link rel="stylesheet" href="../styles/index.css">

<main class="container">
    <h2>Cargar Nuevo Repuesto</h2>

    <?php if (!empty($error)): ?>
        <div class="alert error">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="crear.php" method="POST" class="form-crud">

        <label>Nombre del Repuesto / Accesorio:</label>
        <input type="text" name="nombre" required>

        <label>Categoría:</label>
        <input
            type="text"
            name="categoria"
            placeholder="Ej. Motor, Frenos, Accesorios"
            required
        >

        <label>Descripción:</label>
        <textarea name="descripcion" rows="4" required></textarea>

        <label>Precio:</label>
        <input type="number" step="0.01" min="0" name="precio" required>

        <label>Cantidad en Stock:</label>
        <input type="number" min="0" name="stock" required>

        <label>URL Web de la Imagen (Opcional):</label>
        <input
            type="url"
            name="imagen"
            placeholder="https://ejemplo.com/foto-auto.jpg"
        >

        <div>
            <button type="submit" class="btn-primary">
                Guardar Producto
            </button>

            <a href="admin.php" class="btn-secondary">
                Cancelar
            </a>
        </div>

    </form>
</main>

<?php include("../includes/footer.php"); ?>
