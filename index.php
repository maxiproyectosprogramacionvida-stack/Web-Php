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

    <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 20px; margin-top: 20px;">
        <?php while ($prod = mysqli_fetch_assoc($resultado)): ?>
            <div style="border: 1px solid #ddd; border-radius: 8px; padding: 15px; background: white; text-align: center;">
                <img src="<?= htmlspecialchars($prod['imagen']); ?>" alt="<?= htmlspecialchars($prod['nombre']); ?>" style="width: 100%; height: 160px; object-fit: cover; border-radius: 6px;" onerror="this.src='https://images.unsplash.com/photo-1486006920555-c77dce18193b?w=500';">
                <h3 style="margin: 10px 0 5px; font-size: 18px;"><?= htmlspecialchars($prod['nombre']); ?></h3>
                <p style="color: #666; font-size: 14px; margin-bottom: 8px;"><?= htmlspecialchars($prod['categoria']); ?></p>
                <p style="font-weight: bold; color: #2563eb; font-size: 18px;">$<?= number_format($prod['precio'], 2, ',', '.'); ?></p>
            </div>
        <?php endwhile; ?>
    </div>
</main>

<?php include("includes/footer.php"); ?>