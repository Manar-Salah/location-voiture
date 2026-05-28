
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renti - Location Premium</title>
    <link rel="icon" type="image/svg+xml" href="favicon.svg">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<header>
    <nav>
        <div class="logo">
            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color: var(--primary-color);"><path d="M19 17h2c.6 0 1-.4 1-1v-3c0-.9-.7-1.7-1.5-1.9C18.7 10.6 16 10 16 10s-1.3-1.4-2.2-2.3c-.5-.4-1.1-.7-1.8-.7H5c-.6 0-1.1.4-1.4.9l-1.4 2.9A3.7 3.7 0 0 0 2 12v4c0 .6.4 1 1 1h2"/><circle cx="7" cy="17" r="2"/><path d="M9 17h6"/><circle cx="17" cy="17" r="2"/></svg>
            <a href="index.php">Renti</a>
        </div>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="index.php?c=Vehicle&a=catalogue">Catalogue</a></li>
            <?php if (isset($_SESSION['user'])): ?>
                <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                    <li><a href="index.php?c=Admin&a=dashboard">Dashboard</a></li>
                <?php else: ?>
                    <li><a href="index.php?c=Reservation&a=mes_reservations">Réservations</a></li>
                <?php endif; ?>
                <li><a href="index.php?c=Auth&a=logout" class="btn btn-outline" style="padding: 0.5rem 1.5rem; font-size: 0.85rem;">Déconnexion</a></li>
            <?php else: ?>
                <li><a href="index.php?c=Auth&a=login">Connexion</a></li>
                <li><a href="index.php?c=Auth&a=register" class="btn btn-primary" style="padding: 0.5rem 1.5rem; font-size: 0.85rem;">S'inscrire</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
<main class="fade-in">
    <?php if (isset($_SESSION['flash'])): ?>
        <div class="container">
            <div class="card" style="padding: 1rem; margin-bottom: 1rem; border-left: 4px solid <?= $_SESSION['flash']['type'] === 'success' ? 'var(--success-color)' : 'var(--danger-color)' ?>;">
                <?= $_SESSION['flash']['message'] ?>
            </div>
        </div>
        <?php unset($_SESSION['flash']); ?>
    <?php endif; ?>
