<?php
require_once 'core/Model.php';

class Reservation extends Model {
    
    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO reservations (id_client, id_vehicule, date_debut, date_fin, montant) 
            VALUES (:id_client, :id_vehicule, :date_debut, :date_fin, :montant)");
        return $stmt->execute($data);
    }

    public function checkAvailability($id_vehicule, $date_debut, $date_fin) {
        $stmt = $this->db->prepare("
            SELECT COUNT(*) FROM reservations 
            WHERE id_vehicule = :id_vehicule 
            AND statut IN ('en_attente', 'confirmee')
            AND (date_debut <= :date_fin AND date_fin >= :date_debut)
        ");
        $stmt->execute([
            'id_vehicule' => $id_vehicule,
            'date_debut' => $date_debut,
            'date_fin' => $date_fin
        ]);
        return $stmt->fetchColumn() == 0; // Return true if no overlapping reservations
    }

    public function getByUserId($id_client) {
        $stmt = $this->db->prepare("
            SELECT r.*, v.marque, v.modele, v.image_url 
            FROM reservations r 
            JOIN vehicules v ON r.id_vehicule = v.id 
            WHERE r.id_client = :id_client 
            ORDER BY r.date_creation DESC
        ");
        $stmt->execute(['id_client' => $id_client]);
        return $stmt->fetchAll();
    }

    public function getAll() {
        $stmt = $this->db->query("
            SELECT r.*, c.nom, c.prenom, v.marque, v.modele 
            FROM reservations r 
            JOIN clients c ON r.id_client = c.id
            JOIN vehicules v ON r.id_vehicule = v.id 
            ORDER BY r.date_creation DESC
        ");
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("
            SELECT r.*, c.nom, c.prenom, c.email, v.marque, v.modele, v.tarif_jour 
            FROM reservations r 
            JOIN clients c ON r.id_client = c.id
            JOIN vehicules v ON r.id_vehicule = v.id 
            WHERE r.id = :id
        ");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function updateStatus($id, $statut) {
        $stmt = $this->db->prepare("UPDATE reservations SET statut = :statut WHERE id = :id");
        return $stmt->execute(['statut' => $statut, 'id' => $id]);
    }

    public function updateFraisSup($id, $frais_sup) {
        $stmt = $this->db->prepare("UPDATE reservations SET frais_sup = :frais_sup WHERE id = :id");
        return $stmt->execute(['frais_sup' => $frais_sup, 'id' => $id]);
    }
}
?>
