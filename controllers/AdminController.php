<?php
require_once 'core/Controller.php';

class AdminController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Accès refusé. Administrateurs uniquement.'];
            header('Location: index.php');
            exit;
        }
    }

    public function dashboard() {
        $userModel = $this->model('User');
        $vehicleModel = $this->model('Vehicle');
        $reservationModel = $this->model('Reservation');

        $users = $userModel->getAllUsers();
        $vehicles = $vehicleModel->getAll();
        $reservations = $reservationModel->getAll();

        $stats = [
            'total_users' => count($users),
            'total_vehicles' => count($vehicles),
            'total_reservations' => count($reservations),
            'revenue' => array_sum(array_column($reservations, 'montant')) + array_sum(array_column($reservations, 'frais_sup'))
        ];

        $this->view('admin/dashboard', [
            'stats' => $stats,
            'recent_reservations' => array_slice($reservations, 0, 8)
        ]);
    }

    public function vehicles() {
        $vehicleModel = $this->model('Vehicle');
        $vehicles = $vehicleModel->getAll();
        $this->view('admin/vehicles', ['vehicles' => $vehicles]);
    }

    public function users() {
        $userModel = $this->model('User');
        $users = $userModel->getAllUsers();
        $this->view('admin/users', ['users' => $users]);
    }

    public function addVehicle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = [
                'marque' => $_POST['marque'],
                'modele' => $_POST['modele'],
                'annee' => $_POST['annee'],
                'carburant' => $_POST['carburant'],
                'boite_vitesse' => $_POST['boite_vitesse'],
                'description' => $_POST['description'],
                'image_url' => $_POST['image_url'] ?: 'default.jpg',
                'tarif_jour' => $_POST['tarif_jour'],
                'statut' => $_POST['statut']
            ];

            $vehicleModel = $this->model('Vehicle');
            if ($vehicleModel->create($data)) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Véhicule ajouté avec succès.'];
            } else {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Erreur lors de l\'ajout du véhicule.'];
            }
            header('Location: index.php?c=Admin&a=vehicles');
            exit;
        }
    }

    public function deleteVehicle() {
        if (isset($_GET['id'])) {
            $vehicleModel = $this->model('Vehicle');
            $vehicleModel->delete($_GET['id']);
            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Véhicule supprimé.'];
        }
        header('Location: index.php?c=Admin&a=vehicles');
        exit;
    }

    public function updateVehicle() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $data = [
                'marque' => $_POST['marque'],
                'modele' => $_POST['modele'],
                'annee' => $_POST['annee'],
                'carburant' => $_POST['carburant'],
                'boite_vitesse' => $_POST['boite_vitesse'],
                'description' => $_POST['description'],
                'image_url' => $_POST['image_url'],
                'tarif_jour' => $_POST['tarif_jour'],
                'statut' => $_POST['statut']
            ];

            $vehicleModel = $this->model('Vehicle');
            if ($vehicleModel->update($id, $data)) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Véhicule mis à jour avec succès.'];
            } else {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Erreur lors de la mise à jour.'];
            }
            header('Location: index.php?c=Admin&a=vehicles');
            exit;
        }
    }

    public function deleteUser() {
        if (isset($_GET['id'])) {
            // Empêcher la suppression de soi-même
            if ($_GET['id'] == $_SESSION['user']['id']) {
                $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Vous ne pouvez pas supprimer votre propre compte.'];
            } else {
                $userModel = $this->model('User');
                $userModel->delete($_GET['id']);
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Client supprimé avec succès.'];
            }
        }
        header('Location: index.php?c=Admin&a=users');
        exit;
    }

    public function updateReservation() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = $_POST['id'];
            $statut = $_POST['statut'];
            $frais_sup = floatval($_POST['frais_sup']);

            $reservationModel = $this->model('Reservation');
            $reservationModel->updateStatus($id, $statut);
            $reservationModel->updateFraisSup($id, $frais_sup);

            $_SESSION['flash'] = ['type' => 'success', 'message' => 'Réservation mise à jour.'];
            header('Location: index.php?c=Admin&a=dashboard');
            exit;
        }
    }
}
?>
