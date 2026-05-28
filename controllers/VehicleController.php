<?php
require_once 'core/Controller.php';

class VehicleController extends Controller {
    
    public function catalogue() {
        $vehicleModel = $this->model('Vehicle');
        $vehicules = $vehicleModel->getAvailable();
        
        $this->view('vehicles/catalogue', ['vehicules' => $vehicules]);
    }

    public function details() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=Vehicle&a=catalogue');
            exit;
        }

        $id = $_GET['id'];
        $vehicleModel = $this->model('Vehicle');
        $vehicule = $vehicleModel->findById($id);

        if (!$vehicule) {
            die("Véhicule introuvable.");
        }

        $this->view('vehicles/details', ['vehicule' => $vehicule]);
    }
}
?>
