<?php
require_once 'core/Controller.php';

class ReservationController extends Controller {

    public function __construct() {
        // Sécuriser l'accès
        if (!isset($_SESSION['user'])) {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Vous devez être connecté pour accéder à cette page.'];
            header('Location: index.php?c=Auth&a=login');
            exit;
        }
    }

    public function create() {
        if (!isset($_GET['id_vehicule'])) {
            header('Location: index.php?c=Vehicle&a=catalogue');
            exit;
        }

        $id_vehicule = $_GET['id_vehicule'];
        $vehicleModel = $this->model('Vehicle');
        $vehicule = $vehicleModel->findById($id_vehicule);

        if (!$vehicule || $vehicule['statut'] === 'maintenance') {
            $_SESSION['flash'] = ['type' => 'danger', 'message' => 'Ce véhicule est actuellement en maintenance.'];
            header('Location: index.php?c=Vehicle&a=catalogue');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $date_debut = $_POST['date_debut'];
            $date_fin = $_POST['date_fin'];

            $d1 = new DateTime($date_debut);
            $d2 = new DateTime($date_fin);
            $diff = $d1->diff($d2)->days;
            $jours = $diff > 0 ? $diff : 1; // Au moins 1 jour

            $montant = $jours * $vehicule['tarif_jour'];

            $data = [
                'id_client' => $_SESSION['user']['id'],
                'id_vehicule' => $id_vehicule,
                'date_debut' => $date_debut,
                'date_fin' => $date_fin,
                'montant' => $montant
            ];

            $reservationModel = $this->model('Reservation');
            
            if (!$reservationModel->checkAvailability($id_vehicule, $date_debut, $date_fin)) {
                $error = "Ce véhicule est déjà réservé pour cette période. Veuillez choisir d'autres dates.";
                $this->view('reservations/create', ['vehicule' => $vehicule, 'error' => $error]);
                return;
            }

            if ($reservationModel->create($data)) {
                // Mettre le véhicule en statut 'reserve'
                $vehicleModel->updateStatus($id_vehicule, 'reserve');

                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Réservation effectuée avec succès !'];
                header('Location: index.php?c=Reservation&a=mes_reservations');
                exit;
            } else {
                $error = "Erreur lors de la réservation.";
                $this->view('reservations/create', ['vehicule' => $vehicule, 'error' => $error]);
                return;
            }
        }

        $this->view('reservations/create', ['vehicule' => $vehicule]);
    }

    public function mes_reservations() {
        $reservationModel = $this->model('Reservation');
        $reservations = $reservationModel->getByUserId($_SESSION['user']['id']);
        
        $this->view('reservations/mes_reservations', ['reservations' => $reservations]);
    }

    public function facture() {
        if (!isset($_GET['id'])) {
            header('Location: index.php?c=Reservation&a=mes_reservations');
            exit;
        }

        $id = $_GET['id'];
        $reservationModel = $this->model('Reservation');
        $reservation = $reservationModel->findById($id);

        if (!$reservation) {
            die("Facture introuvable.");
        }

        // Vérification de sécurité (seul le client ou admin peut voir)
        if ($_SESSION['user']['role'] !== 'admin' && $reservation['id_client'] != $_SESSION['user']['id']) {
            die("Accès refusé.");
        }

        $this->view('reservations/facture', ['reservation' => $reservation]);
    }
}
?>
