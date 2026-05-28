<?php
require_once 'core/Controller.php';

class HomeController extends Controller {
    public function index() {
        // Optionnel : récupérer les derniers véhicules ajoutés pour les afficher sur la page d'accueil
        $vehicleModel = $this->model('Vehicle');
        $vehicules = $vehicleModel->getAvailable();
        // On ne prend que les 3 premiers pour l'accueil
        $vehicules = array_slice($vehicules, 0, 3);
        
        $this->view('home', ['vehicules' => $vehicules]);
    }
}
?>
