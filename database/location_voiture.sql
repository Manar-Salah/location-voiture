
CREATE DATABASE IF NOT EXISTS location_voiture;
USE location_voiture;

CREATE TABLE clients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    mot_de_passe VARCHAR(255) NOT NULL,
    role ENUM('admin', 'user') DEFAULT 'user',
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE vehicules (
    id INT AUTO_INCREMENT PRIMARY KEY,
    marque VARCHAR(100) NOT NULL,
    modele VARCHAR(100) NOT NULL,
    annee INT NOT NULL,
    carburant VARCHAR(50) NOT NULL,
    boite_vitesse VARCHAR(50) NOT NULL,
    description TEXT,
    image_url VARCHAR(255) DEFAULT 'default.jpg',
    tarif_jour DECIMAL(10,2) NOT NULL,
    statut ENUM('disponible', 'reserve', 'maintenance') DEFAULT 'disponible',
    date_ajout DATETIME DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_client INT NOT NULL,
    id_vehicule INT NOT NULL,
    date_debut DATE NOT NULL,
    date_fin DATE NOT NULL,
    montant DECIMAL(10,2) NOT NULL,
    frais_sup DECIMAL(10,2) DEFAULT 0.00,
    statut ENUM('en_attente', 'confirmee', 'terminee', 'annulee') DEFAULT 'en_attente',
    date_creation DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_client) REFERENCES clients(id) ON DELETE CASCADE,
    FOREIGN KEY (id_vehicule) REFERENCES vehicules(id) ON DELETE CASCADE
);

-- Insertion de données de test
INSERT INTO clients (nom, prenom, email, mot_de_passe, role) VALUES 
('Admin', 'Super', 'admin@rentcar.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin'),
('Doe', 'John', 'john@example.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user');

INSERT INTO vehicules (marque, modele, annee, carburant, boite_vitesse, tarif_jour, image_url, description) VALUES 
('Mercedes-Benz', 'Classe S AMG', 2023, 'Hybride', 'Automatique', 250.00, 'https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'Berline de luxe par excellence, la Classe S offre un confort inégalé et des performances époustouflantes.'),
('BMW', 'M4 Competition', 2023, 'Essence', 'Automatique', 195.00, 'https://images.unsplash.com/photo-1607853202273-797f1c22a38e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'Coupé sportif radical, offrant une expérience de conduite pure et agressive.'),
('Porsche', '911 Carrera S', 2023, 'Essence', 'Automatique', 320.00, 'https://images.unsplash.com/photo-1503376762362-7a2c6c9966b6?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'L\'icône intemporelle des voitures de sport. Design légendaire et dynamique exceptionnelle.'),
('Tesla', 'Model S Plaid', 2023, 'Électrique', 'Automatique', 210.00, 'https://images.unsplash.com/photo-1560958089-b8a1929cea89?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'L\'accélération la plus foudroyante du marché dans une berline technologique 100% électrique.'),
('Range Rover', 'Sport', 2023, 'Hybride', 'Automatique', 180.00, 'https://images.unsplash.com/photo-1606016159991-d8532fb36592?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'Le SUV de luxe britannique combinant élégance, espace et capacités tout-terrain.'),
('Audi', 'RS e-tron GT', 2022, 'Électrique', 'Automatique', 240.00, 'https://images.unsplash.com/photo-1614200187524-dc4b892acf16?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80', 'La vision du Grand Tourisme par Audi. Puissance 100% électrique et lignes sculpturales.');
