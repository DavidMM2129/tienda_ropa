<?php
require_once '../controllers/ropaController.php';

$controller = new RopaController($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Gestión de Tienda de Ropa</title>
</head>
<body>
    <h1>Gestión de Tienda de Ropa</h1>
    <nav>
        <ul>
            <li><a href="marcas.php">Marcas Más Vendidas</a></li>
            <li><a href="prendas.php">Inventario Restante</a></li>
            <li><a href="ventas.php">Ventas por Fecha</a></li>
        </ul>
    </nav>
</body>
</html>
