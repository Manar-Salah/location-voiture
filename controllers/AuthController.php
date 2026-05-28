<?php
require_once 'core/Controller.php';

class AuthController extends Controller {

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $userModel = $this->model('User');
            $user = $userModel->findByEmail($email);

            if ($user && (password_verify($password, $user['mot_de_passe']) || $password === $user['mot_de_passe'])) {
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'nom' => $user['nom'],
                    'prenom' => $user['prenom'],
                    'email' => $user['email'],
                    'role' => $user['role']
                ];
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Connexion réussie. Bienvenue ' . $user['prenom'] . ' !'];
                
                if ($user['role'] === 'admin') {
                    header('Location: index.php?c=Admin&a=dashboard');
                } else {
                    header('Location: index.php');
                }
                exit;
            } else {
                $error = "Email ou mot de passe incorrect.";
                $this->view('auth/login', ['error' => $error]);
                return;
            }
        }
        $this->view('auth/login');
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nom = trim($_POST['nom'] ?? '');
            $prenom = trim($_POST['prenom'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';
            $password_confirm = $_POST['password_confirm'] ?? '';

            if (empty($nom) || empty($prenom) || empty($email) || empty($password)) {
                $error = "Tous les champs sont obligatoires.";
                $this->view('auth/register', ['error' => $error]);
                return;
            }

            if ($password !== $password_confirm) {
                $error = "Les mots de passe ne correspondent pas.";
                $this->view('auth/register', ['error' => $error]);
                return;
            }

            $userModel = $this->model('User');
            if ($userModel->findByEmail($email)) {
                $error = "Cet email est déjà utilisé.";
                $this->view('auth/register', ['error' => $error]);
                return;
            }

            if ($userModel->create($nom, $prenom, $email, $password)) {
                $_SESSION['flash'] = ['type' => 'success', 'message' => 'Inscription réussie. Vous pouvez maintenant vous connecter.'];
                header('Location: index.php?c=Auth&a=login');
                exit;
            } else {
                $error = "Erreur lors de l'inscription.";
                $this->view('auth/register', ['error' => $error]);
                return;
            }
        }
        $this->view('auth/register');
    }

    public function logout() {
        session_destroy();
        session_start();
        $_SESSION['flash'] = ['type' => 'success', 'message' => 'Vous avez été déconnecté.'];
        header('Location: index.php');
        exit;
    }
}
?>
