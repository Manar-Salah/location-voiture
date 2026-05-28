# 🚗 Système de Gestion d'une Agence de Location de Voiture

> Application web complète pour la gestion d'une agence de location de voitures : parc automobile, clients, réservations et facturation — avec interface client et back-office administrateur.

![PHP](https://img.shields.io/badge/PHP-8.x-777BB4?style=flat&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=flat&logo=mysql&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-ES6+-F7DF1E?style=flat&logo=javascript&logoColor=black)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=flat&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=flat&logo=css3&logoColor=white)
![MVC](https://img.shields.io/badge/Architecture-MVC-28A745?style=flat)

---

## 📌 Description

Application web de gestion complète pour une agence de location de voitures. Elle permet à trois types d'acteurs (visiteur, client, administrateur) d'interagir avec le système : consultation du catalogue, réservation en ligne, gestion du parc et facturation automatique.

---

## 👥 Acteurs du système

| Acteur | Rôle |
|--------|------|
| Visiteur | Consulte le catalogue de véhicules sans être connecté |
| Client | Crée un compte, effectue des réservations, consulte son historique |
| Administrateur | Gère les véhicules, clients, réservations et facturation |

---

## ✨ Fonctionnalités principales

**Côté Client**
- Inscription et connexion sécurisée (validation JS + PHP)
- Consultation du catalogue avec filtres (catégorie, prix, dates)
- Réservation en ligne avec calcul automatique du montant
- Historique des locations et réservations en cours
- Annulation de réservation (sous conditions)

**Côté Administrateur**
- Gestion complète du parc (ajout, modification, suppression)
- Suivi des statuts : disponible / loué / en maintenance
- Validation ou annulation des réservations
- Enregistrement des retours et calcul des frais supplémentaires
- Génération de factures

---

## 🛠️ Technologies utilisées

| Composant | Technologie |
|-----------|-------------|
| Front-end | HTML5, CSS3, JavaScript ES6+ |
| Back-end | PHP 8.x |
| Base de données | MySQL |
| Architecture | MVC (Modèle-Vue-Contrôleur) |
| Échanges de données | AJAX / JSON |

---

## 📂 Structure du projet (MVC)

```
location-voiture/
├── app/
│   ├── controllers/     # Logique métier (VehiculeController, ReservationController...)
│   ├── models/          # Accès base de données (Vehicule, Client, Reservation, Contrat)
│   └── views/           # Templates HTML des pages
├── public/
│   ├── css/             # Feuilles de style
│   ├── js/              # Scripts JavaScript (validation, AJAX)
│   └── images/          # Photos des véhicules
├── config/
│   └── database.php     # Configuration MySQL
└── index.php            # Point d'entrée
```

---

## 🚀 Installation

```bash
# 1. Cloner le dépôt
git clone https://github.com/Manar-Salah/location-voiture.git
cd location-voiture

# 2. Importer la base de données
mysql -u root -p < database/location_voiture.sql

# 3. Configurer la connexion MySQL
# Modifier config/database.php avec vos identifiants

# 4. Lancer avec un serveur local (XAMPP, WAMP ou PHP built-in)
php -S localhost:8000 -t public/
```

---

## 🗄️ Modèle de données

| Entité | Attributs principaux |
|--------|---------------------|
| Véhicule | id, marque, modele, immatriculation, km, tarif_jour, statut, photo |
| Client | id, nom, prenom, email, mot_de_passe, telephone, adresse |
| Réservation | id, id_client, id_vehicule, date_debut, date_fin, montant, statut |
| Contrat | id, id_reservation, date_retour_reelle, etat_retour, frais_supp, montant_final |

---

## 👩‍💻 Auteure

**Manar Salah** — Étudiante ingénieure, spécialisation IA & Data Science  
📍 Tunisie | [GitHub](https://github.com/Manar-Salah) | [LinkedIn](https://www.linkedin.com/in/manar-salah-3a977b1a1/) | [Email](mailto:manarsalaah2@gmail.com)
