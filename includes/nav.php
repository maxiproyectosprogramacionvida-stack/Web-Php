<?php
$tema_preferido = isset($_COOKIE['tema_preferido']) ? $_COOKIE['tema_preferido'] : 'oscuro';
?>
<nav class="main-nav">
    <ul>
        <li><a href="/segundoparcialVegliaMaximiliano/index.php">Inicio / Catálogo</a></li>
        <li><a href="/segundoparcialVegliaMaximiliano/paneladmin/admin.php">Panel de Administración (CRUD)</a></li>
        <li><a href="/segundoparcialVegliaMaximiliano/paneladmin/crear.php">+ Nuevo Producto</a></li>
    </ul>
</nav>