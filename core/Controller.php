<?php

class Controller {
    // charger un modèle
    public function model($model) {
        require_once 'models/' . $model . '.php';
        return new $model();
    }

    // charger une vue
    public function view($view, $data = []) {
        if (file_exists('views/' . $view . '.php')) {
            // Extraire les données pour les rendre accessibles dans la vue
            extract($data);
            require_once 'views/' . $view . '.php';
        } else {
            die("La vue $view n'existe pas.");
        }
    }
}
?>
