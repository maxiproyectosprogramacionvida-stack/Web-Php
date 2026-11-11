
<?php
session_start();
require_once "../includes/conexion.php";

$busqueda = "";

if (isset($_GET['busqueda'])) {
    $busqueda = trim($_GET['busqueda']);
    setcookie("ultimo_filtro", $busqueda, time() + 86400, "/");
} elseif (isset($_COOKIE['ultimo_filtro']) && !isset($_GET['limpiar'])) {
    $busqueda = $_COOKIE['ultimo_filtro'];
}

if (isset($_GET['limpiar'])) {
    setcookie("ultimo_filtro", "", time() - 3600, "/");
    $busqueda = "";
}

if ($busqueda !== '') {
    $sql = "SELECT * FROM productos
            WHERE nombre LIKE ?
            OR categoria LIKE ?
            OR descripcion LIKE ?";

    $stmt = mysqli_prepare($conexion, $sql);
    $param = "%" . $busqueda . "%";

    mysqli_stmt_bind_param($stmt, "sss", $param, $param, $param);
    mysqli_stmt_execute($stmt);

    $resultado = mysqli_stmt_get_result($stmt);
} else {
    $sql = "SELECT * FROM productos";
    $resultado = mysqli_query($conexion, $sql);
}

include("../includes/header.php");
include("../includes/nav.php");
?>

<main class="container">

    <h2>Administración de Autopartes</h2>

    <p class="descripcion-admin">
        Gestiona el catálogo de repuestos y accesorios.
    </p>

    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert success">
            <?= htmlspecialchars($_SESSION['mensaje']); ?>
        </div>
        <?php unset($_SESSION['mensaje']); ?>
    <?php endif; ?>

    <form method="GET" action="admin.php" class="search-form">

        <input
            type="text"
            name="busqueda"
            placeholder="Buscar por nombre, categoría o descripción..."
            value="<?= htmlspecialchars($busqueda); ?>"
        >

        <button type="submit" class="btn-primary">
            Buscar
        </button>

        <a href="admin.php?limpiar=1" class="btn-secondary">
            Limpiar Filtro
        </a>

    </form>

    <div class="agregar-producto">
        <a href="crear.php" class="btn-primary">
            + Agregar Nuevo Repuesto
        </a>
    </div>

    <div class="productos-grid">

        <?php if ($resultado && mysqli_num_rows($resultado) > 0): ?>

            <?php while ($fila = mysqli_fetch_assoc($resultado)): ?>

                <div class="producto-card">

                    <img
                        src="<?= htmlspecialchars($fila['imagen']); ?>"
                        alt="<?= htmlspecialchars($fila['nombre']); ?>"
                        class="producto-imagen"
                        onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=500';"
                    >

                    <div class="producto-info">

                        <h3>
                            <?= htmlspecialchars($fila['nombre']); ?>
                        </h3>

                        <p>
                            <strong>Categoría:</strong>
                            <?= htmlspecialchars($fila['categoria']); ?>
                        </p>

                        <p>
                            <strong>Precio:</strong>
                            $<?= number_format($fila['precio'], 2, ',', '.'); ?>
                        </p>

                        <p>
                            <strong>Stock:</strong>
                            <?= htmlspecialchars($fila['stock']); ?> unidades
                        </p>

                        <div class="producto-acciones">

                            <a
                                href="editar.php?id=<?= (int) $fila['id']; ?>"
                                class="btn-edit"
                            >
                                Editar
                            </a>

                            <form
                                action="eliminar.php"
                                method="POST"
                                onsubmit="return confirm('¿Seguro que deseas eliminar este producto?');"
                            >
                                <input
                                    type="hidden"
                                    name="id"
                                    value="<?= (int) $fila['id']; ?>"
                                >

                                <button type="submit" class="btn-delete">
                                    Eliminar
                                </button>
                            </form>

                        </div>

                    </div>

                </div>

            <?php endwhile; ?>

        <?php else: ?>

            <p class="sin-productos">
                No se encontraron repuestos registrados.
            </p>

        <?php endif; ?>

    </div>

</main>

<?php include("../includes/footer.php"); ?>
