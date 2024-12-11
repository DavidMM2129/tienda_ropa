<?php
require_once '../controllers/ropaController.php';

$controller = new RopaController($pdo);
$marcas = $controller->mostrarMarcasMasVendidas();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Marcas Más Vendidas</title>
</head>
<body>
    <h1>Marcas Más Vendidas</h1>
    <table>
        <tr>
            <th>Marca</th>
            <th>Total Vendido</th>
        </tr>
        <?php foreach ($marcas as $marca): ?>
        <tr>
            <td><?= $marca['nombre'] ?></td>
            <td><?= $marca['total_vendido'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php">Volver al inicio</a>
</body>
</html>
