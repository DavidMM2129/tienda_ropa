<?php
require_once '../config/database.php';

class RopaModel {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function obtenerVentasPorFecha() {
        $query = "SELECT fecha, SUM(cantidad) AS total_ventas FROM ventas GROUP BY fecha";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerMarcasMasVendidas() {
        $query = "SELECT m.nombre, SUM(v.cantidad) AS total_vendido 
                  FROM ventas v 
                  JOIN prendas p ON v.id_prenda = p.id_prenda 
                  JOIN marcas m ON p.id_marca = m.id_marca 
                  GROUP BY m.nombre 
                  ORDER BY total_vendido DESC";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerInventarioRestante() {
        $query = "SELECT nombre, stock FROM prendas WHERE stock > 0";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
