<?php
session_start();
require_once "../includes/conexion.php";

$error = "";

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: admin.php");
    exit();
}

$id = (int) $_GET['id'];

$sql = "SELECT * FROM productos WHERE id = ?";
$stmt = mysqli_prepare($conexion, $sql);

if (!$stmt) {
    die("Error al preparar la consulta.");
}

mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$res = mysqli_stmt_get_result($stmt);
$producto = mysqli_fetch_assoc($res);

mysqli_stmt_close($stmt);

if (!$producto) {
    header("Location: admin.php");
    exit();
}

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

    $producto['nombre'] = $nombre;
    $producto['categoria'] = $categoria;
    $producto['descripcion'] = $descripcion;
    $producto['precio'] = $precio;
    $producto['stock'] = $stock;
    $producto['imagen'] = $imagen;

    if (
        empty($nombre) ||
        empty($categoria) ||
        empty($descripcion) ||
        $precio === '' ||
        $stock === ''
    ) {
        $error = "Todos los campos obligatorios deben completarse.";
    } elseif (!is_numeric($precio) || $precio < 0) {
        $error = "Ingresa un precio válido.";
    } elseif (filter_var($stock, FILTER_VALIDATE_INT) === false || $stock < 0) {
        $error = "Ingresa una cantidad de stock válida.";
    } else {
        $sql = "UPDATE productos
                SET nombre = ?, categoria = ?, descripcion = ?,
                    precio = ?, stock = ?, imagen = ?
                WHERE id = ?";

        $stmt = mysqli_prepare($conexion, $sql);

        if ($stmt) {
            mysqli_stmt_bind_param(
                $stmt,
                "sssdisi",
                $nombre,
                $categoria,
                $descripcion,
                $precio,
                $stock,
                $imagen,
                $id
            );

            if (mysqli_stmt_execute($stmt)) {
                $_SESSION['mensaje'] = "Repuesto actualizado correctamente.";
                mysqli_stmt_close($stmt);
                header("Location: admin.php");
                exit();
            } else {
                $error = "Error al actualizar en la base de datos.";
            }

            mysqli_stmt_close($stmt);
        } else {
            $error = "No se pudo preparar la consulta.";
        }
    }
}

include("../includes/header.php");
include("../includes/nav.php");
?>

<main class="container">
    <h2>Editar Repuesto #<?= htmlspecialchars($producto['id']); ?></h2>

    <?php if (!empty($error)): ?>
        <div class="alert error">
            <?= htmlspecialchars($error); ?>
        </div>
    <?php endif; ?>

    <form action="editar.php?id=<?= $id; ?>" method="POST" class="form-crud">

        <label>Nombre del Repuesto:</label>
        <input
            type="text"
            name="nombre"
            value="<?= htmlspecialchars($producto['nombre']); ?>"
            required
        >

        <label>Categoría:</label>
        <input
            type="text"
            name="categoria"
            placeholder="Ej. Motor, Frenos, Accesorios"
            value="<?= htmlspecialchars($producto['categoria']); ?>"
            required
        >

        <label>Descripción:</label>
        <textarea name="descripcion" rows="4" required><?= htmlspecialchars($producto['descripcion']); ?></textarea>

        <label>Precio ($):</label>
        <input
            type="number"
            step="0.01"
            min="0"
            name="precio"
            value="<?= htmlspecialchars($producto['precio']); ?>"
            required
        >

        <label>Stock:</label>
        <input
            type="number"
            min="0"
            name="stock"
            value="<?= htmlspecialchars($producto['stock']); ?>"
            required
        >

        <label>URL de la Imagen:</label>
        <input
            type="url"
            name="imagen"
            value="<?= htmlspecialchars($producto['imagen']); ?>"
        >

        <div>
            <button type="submit" class="btn-primary">
                Actualizar Cambios
            </button>

            <a href="admin.php" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</main>

<?php include("../includes/footer.php"); ?>
