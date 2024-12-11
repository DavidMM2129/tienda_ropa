<?php
require_once '../models/ropaModel.php';

class RopaController {
    private $model;

    public function __construct($pdo) {
        $this->model = new RopaModel($pdo);
    }

    public function mostrarVentasPorFecha() {
        return $this->model->obtenerVentasPorFecha();
    }

    public function mostrarMarcasMasVendidas() {
        return $this->model->obtenerMarcasMasVendidas();
    }

    public function mostrarInventarioRestante() {
        return $this->model->obtenerInventarioRestante();
    }
}
?>
