<?php
require_once '../controllers/ropaController.php';

$controller = new RopaController($pdo);
$ventas = $controller->mostrarVentasPorFecha();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Ventas por Fecha</title>
</head>
<body>
    <h1>Ventas por Fecha</h1>
    <table>
        <tr>
            <th>Fecha</th>
            <th>Total Ventas</th>
        </tr>
        <?php foreach ($ventas as $venta): ?>
        <tr>
            <td><?= $venta['fecha'] ?></td>
            <td><?= $venta['total_ventas'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php">Volver al inicio</a>
</body>
</html>
