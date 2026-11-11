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

    <div class="productos-grid">
        <?php while ($prod = mysqli_fetch_assoc($resultado)): ?>
            <div class="producto-card">
                <img 
                    src="<?= htmlspecialchars($prod['imagen']); ?>" 
                    alt="<?= htmlspecialchars($prod['nombre']); ?>" 
                    class="producto-imagen" 
                    onerror="this.onerror=null; this.src='https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=500';"
                >
                <div class="producto-info">
                    <h3><?= htmlspecialchars($prod['nombre']); ?></h3>
                    <p><strong>Categoría:</strong> <?= htmlspecialchars($prod['categoria']); ?></p>
                    <p><strong>Precio:</strong> $<?= number_format($prod['precio'], 2, ',', '.'); ?></p>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php include("includes/footer.php"); ?>