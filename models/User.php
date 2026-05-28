<?php
require_once 'core/Model.php';

class User extends Model {
    
    public function findByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM clients WHERE email = :email");
        $stmt->execute(['email' => $email]);
        return $stmt->fetch();
    }

    public function create($nom, $prenom, $email, $password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO clients (nom, prenom, email, mot_de_passe) VALUES (:nom, :prenom, :email, :mot_de_passe)");
        return $stmt->execute([
            'nom' => $nom,
            'prenom' => $prenom,
            'email' => $email,
            'mot_de_passe' => $hash
        ]);
    }

    public function findById($id) {
        $stmt = $this->db->prepare("SELECT id, nom, prenom, email, role, date_creation FROM clients WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }
    
    public function getAllUsers() {
        $stmt = $this->db->query("SELECT id, nom, prenom, email, role, date_creation FROM clients ORDER BY date_creation DESC");
        return $stmt->fetchAll();
    }

    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM clients WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }
}
?>
