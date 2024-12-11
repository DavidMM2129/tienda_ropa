<?php
header("Content-Type: application/json");

$conn = new mysqli("localhost", "root", "", "tienda_ropa");

if ($conn->connect_error) {
    die(json_encode(["error" => "Conexión fallida: " . $conn->connect_error]));
}

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
        // Reporte 1: Marcas con al menos 1 venta
        if (isset($_GET['reporte']) && $_GET['reporte'] === 'marcas_con_ventas') {
            $query = "SELECT m.nombre, COUNT(v.id_venta) AS total_ventas 
                      FROM marcas m
                      JOIN prendas p ON m.id_marca = p.id_marca
                      JOIN ventas v ON p.id_prenda = v.id_prenda
                      GROUP BY m.id_marca
                      HAVING total_ventas > 0";
            $result = $conn->query($query);
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
            break;
        }

        // Reporte 2: Prendas vendidas y stock restante
        if (isset($_GET['reporte']) && $_GET['reporte'] === 'prendas_vendidas_stock') {
            $query = "SELECT p.nombre AS prenda, SUM(v.cantidad) AS total_vendido, p.stock 
                      FROM prendas p
                      JOIN ventas v ON p.id_prenda = v.id_prenda
                      GROUP BY p.id_prenda
                      HAVING total_vendido > 0";
            $result = $conn->query($query);
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
            break;
        }

        // Reporte 3: Top 5 marcas más vendidas
        if (isset($_GET['reporte']) && $_GET['reporte'] === 'top_marcas_vendidas') {
            $query = "SELECT m.nombre AS marca, COUNT(v.id_venta) AS total_ventas 
                      FROM marcas m
                      JOIN prendas p ON m.id_marca = p.id_marca
                      JOIN ventas v ON p.id_prenda = v.id_prenda
                      GROUP BY m.id_marca
                      ORDER BY total_ventas DESC
                      LIMIT 5";
            $result = $conn->query($query);
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
            break;
        }

        // Si no hay reporte, devuelve las prendas como en CRUD
        if (!isset($_GET['reporte'])) {
            if (isset($_GET['id'])) {
                $id = intval($_GET['id']);
                $query = "SELECT * FROM prendas WHERE id_prenda = $id";
            } else {
                $query = "SELECT * FROM prendas";
            }
            $result = $conn->query($query);
            $data = [];
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        }
        break;

    case 'POST':
        // CRUD: Crear nueva prenda
        $input = json_decode(file_get_contents('php://input'), true);
        $nombre = $input['nombre'];
        $talla = $input['talla'];
        $precio = $input['precio'];
        $stock = $input['stock'];
        $id_marca = $input['id_marca'];

        $query = "INSERT INTO prendas (nombre, talla, precio, stock, id_marca) VALUES ('$nombre', '$talla', '$precio', '$stock', '$id_marca')";
        if ($conn->query($query)) {
            echo json_encode(["message" => "Prenda creada exitosamente"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'PUT':
        // CRUD: Actualizar prenda
        $input = json_decode(file_get_contents('php://input'), true);
        $id = intval($input['id']);
        $nombre = $input['nombre'];
        $talla = $input['talla'];
        $precio = $input['precio'];
        $stock = $input['stock'];
        $id_marca = $input['id_marca'];

        $query = "UPDATE prendas SET nombre = '$nombre', talla = '$talla', precio = '$precio', stock = '$stock', id_marca = '$id_marca' WHERE id_prenda = $id";
        if ($conn->query($query)) {
            echo json_encode(["message" => "Prenda actualizada exitosamente"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    case 'DELETE':
        // CRUD: Eliminar prenda
        $id = intval($_GET['id']);
        $query = "DELETE FROM prendas WHERE id_prenda = $id";
        if ($conn->query($query)) {
            echo json_encode(["message" => "Prenda eliminada exitosamente"]);
        } else {
            echo json_encode(["error" => $conn->error]);
        }
        break;

    default:
        echo json_encode(["message" => "Método no soportado"]);
        break;
}

$conn->close();
?>


