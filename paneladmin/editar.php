
<?php
session_start();
require_once "../includes/conexion.php";

$error = "";

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $sql = "SELECT * FROM productos WHERE id = ?";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $res = mysqli_stmt_get_result($stmt);
    $producto = mysqli_fetch_assoc($res);

    if (!$producto) {
        header("Location: admin.php");
        exit();
    }
} else {
    header("Location: admin.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_post = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $categoria = trim($_POST['categoria']);
    $descripcion = trim($_POST['descripcion']);
    $precio = trim($_POST['precio']);
    $stock = trim($_POST['stock']);
    $imagen = trim($_POST['imagen']);

    if (empty($imagen)) {
        $imagen = "https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=500";
    }

    if (empty($nombre) || empty($categoria) || empty($descripcion) || empty($precio) || empty($stock)) {
        $error = "Todos los campos obligatorios deben completarse.";
    } else {
        $sql = "UPDATE productos SET nombre = ?, categoria = ?, descripcion = ?, precio = ?, stock = ?, imagen = ? WHERE id = ?";
        $stmt = mysqli_prepare($conexion, $sql);
        mysqli_stmt_bind_param($stmt, "sssdisi", $nombre, $categoria, $descripcion, $precio, $stock, $imagen, $id_post);

        if (mysqli_stmt_execute($stmt)) {
            header("Location: admin.php");
            exit();
        } else {
            $error = "Error al actualizar en la base de datos.";
        }
    }
}

include("../includes/header.php");
include("../includes/nav.php");
?>

<main class="container">
    <h2>Editar Repuesto #<?= $producto['id']; ?></h2>

    <?php if (!empty($error)): ?>
        <div class="alert error"><?= htmlspecialchars($error); ?></div>
    <?php endif; ?>

    <form action="editar.php?id=<?= $producto['id']; ?>" method="POST" class="form-crud">
        <input type="hidden" name="id" value="<?= $producto['id']; ?>">

        <label>Nombre del Repuesto:</label>
        <input type="text" name="nombre" value="<?= htmlspecialchars($producto['nombre']); ?>" required>

        <label>Categoría:</label>
        <select name="categoria" required>
            <?php
            $cats = ["Ruedas", "Motor", "Iluminación", "Lubricantes", "Frenos", "Accesorios"];
            foreach ($cats as $cat):
            ?>
                <option value="<?= htmlspecialchars($cat); ?>" <?= ($producto['categoria'] === $cat) ? 'selected' : ''; ?>>
                    <?= htmlspecialchars($cat); ?>
                </option>
            <?php endforeach; ?>
        </select>

        <label>Descripción:</label>
        <textarea name="descripcion" rows="4" required><?= htmlspecialchars($producto['descripcion']); ?></textarea>

        <label>Precio ($):</label>
        <input type="number" step="0.01" name="precio" value="<?= htmlspecialchars($producto['precio']); ?>" required>

        <label>Stock:</label>
        <input type="number" name="stock" value="<?= htmlspecialchars($producto['stock']); ?>" required>

        <label>URL de la Imagen:</label>
        <input type="url" name="imagen" value="<?= htmlspecialchars($producto['imagen']); ?>">

        <div>
            <button type="submit" class="btn-primary">Actualizar Cambios</button>
            <a href="admin.php" class="btn-secondary">Cancelar</a>
        </div>
    </form>
</main>

<?php include("../includes/footer.php"); ?>
