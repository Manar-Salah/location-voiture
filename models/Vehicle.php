
<?php
require_once 'core/Model.php';

class Vehicle extends Model {
    
    public function getAll() {
        $stmt = $this->db->query("SELECT * FROM vehicules ORDER BY id DESC");
        return $stmt->fetchAll();
    }

    public function getAvailable() {
        $stmt = $this->db->query("SELECT * FROM vehicules WHERE statut != 'maintenance' ORDER BY marque, modele");
        return $stmt->fetchAll();
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT * FROM vehicules WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function create($data) {
        $stmt = $this->db->prepare("INSERT INTO vehicules (marque, modele, annee, carburant, boite_vitesse, description, image_url, tarif_jour, statut) 
            VALUES (:marque, :modele, :annee, :carburant, :boite_vitesse, :description, :image_url, :tarif_jour, :statut)");
        return $stmt->execute($data);
    }

    public function update($id, $data) {
        $params = [
            'id' => $id,
            'marque' => $data['marque'],
            'modele' => $data['modele'],
            'annee' => $data['annee'],
            'carburant' => $data['carburant'],
            'boite_vitesse' => $data['boite_vitesse'],
            'description' => $data['description'],
            'image_url' => $data['image_url'],
            'tarif_jour' => $data['tarif_jour'],
            'statut' => $data['statut']
        ];
        $stmt = $this->db->prepare("UPDATE vehicules SET marque=:marque, modele=:modele, annee=:annee, 
            carburant=:carburant, boite_vitesse=:boite_vitesse, description=:description, 
            image_url=:image_url, tarif_jour=:tarif_jour, statut=:statut WHERE id=:id");
        return $stmt->execute($params);
    }

    public function updateStatus($id, $statut) {
        $stmt = $this->db->prepare("UPDATE vehicules SET statut = :statut WHERE id = :id");
        return $stmt->execute(['statut' => $statut, 'id' => $id]);
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM vehicules WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
