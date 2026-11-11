<?php
$tema_preferido = isset($_COOKIE['tema_preferido']) ? $_COOKIE['tema_preferido'] : 'oscuro';
?>
<nav class="main-nav">
    <ul>
        <li><a href="/index.php">Inicio / Catálogo</a></li>
        <li><a href="/paneladmin/admin.php">Panel de Administración</a></li>
        <li><a href="/paneladmin/crear.php">Agregar Producto</a></li>
    </ul>
</nav>