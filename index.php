
<?php
session_start();

require_once 'core/Controller.php';

// Routeur basique
$controllerName = isset($_GET['c']) ? ucfirst($_GET['c']) . 'Controller' : 'HomeController';
$action = isset($_GET['a']) ? $_GET['a'] : 'index';

$controllerPath = 'controllers/' . $controllerName . '.php';

if (file_exists($controllerPath)) {
    require_once $controllerPath;
    if (class_exists($controllerName)) {
        $controller = new $controllerName();
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            die("L'action $action n'existe pas dans le contrôleur $controllerName.");
        }
    } else {
        die("La classe $controllerName est introuvable.");
    }
} else {
    // Controller introuvable -> fallback vers HomeController ou 404
    die("Page introuvable (404).");
}
?>
