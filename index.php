<?php
require_once "includes/conexion.php";

$sql = "SELECT * FROM productos ORDER BY id DESC LIMIT 6";
$resultado = mysqli_query($conexion, $sql);

include("includes/header.php");
include("includes/nav.php");
?>

<main class="container">
    <h2>Catálogo Público de Autopartes</h2>
    <p>Bienvenido a nuestra tienda. Estos son algunos de nuestros productos disponibles:</p>

    <div class="productos-grid-publico">
        <?php while ($prod = mysqli_fetch_assoc($resultado)): ?>
            <div class="producto-card-publico">
                <img 
                    src="<?= htmlspecialchars($prod['imagen']); ?>" 
                    alt="<?= htmlspecialchars($prod['nombre']); ?>" 
                    class="producto-imagen-publico" 
                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=500';"
                >
                <h3><?= htmlspecialchars($prod['nombre']); ?></h3>
                <p class="categoria"><?= htmlspecialchars($prod['categoria']); ?></p>
                <p class="precio">$<?= number_format($prod['precio'], 2, ',', '.'); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php include("includes/footer.php"); ?>