<?php
require_once '../controllers/ropaController.php';

$controller = new RopaController($pdo);
$prendas = $controller->mostrarInventarioRestante();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../assets/styles.css">
    <title>Inventario Restante</title>
</head>
<body>
    <h1>Inventario Restante</h1>
    <table>
        <tr>
            <th>Prenda</th>
            <th>Stock</th>
        </tr>
        <?php foreach ($prendas as $prenda): ?>
        <tr>
            <td><?= $prenda['nombre'] ?></td>
            <td><?= $prenda['stock'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="index.php">Volver al inicio</a>
</body>
</html>
