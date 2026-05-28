<?php include 'views/header.php'; ?>

<div class="container fade-in">
    <div class="reveal fade-bottom" style="text-align: center; margin-bottom: 5rem; display: flex; flex-direction: column; align-items: center; gap: 1rem;">
        <span style="color: var(--primary-color); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 0.9rem;">Découvrez notre sélection</span>
        <h1 style="font-size: clamp(2.2rem, 4vw, 3.5rem); margin: 0; color: #fff;">Choisissez Votre Prochaine Voiture</h1>
        <p style="color: var(--text-muted); font-size: 1.1rem; max-width: 600px; margin: 0; line-height: 1.6;">Une flotte moderne, confortable et adaptée à tous vos besoins de déplacement.</p>
    </div>
    
    <div class="grid">
        <?php if (!empty($vehicules)): ?>
            <?php foreach($vehicules as $index => $v): ?>
                <div class="card reveal fade-bottom" style="transition-delay: <?= $index * 0.1 ?>s;">
                    <div class="card-img-container" style="position: relative;">
                        <img src="<?= htmlspecialchars($v['image_url']) ?>" alt="<?= htmlspecialchars($v['marque'] . ' ' . $v['modele']) ?>" class="card-img" onerror="this.src='https://images.unsplash.com/photo-1503376762362-7a2c6c9966b6?w=600'">

                    </div>
                    <div class="card-body">
                        <div style="margin-bottom: 1rem;">
                            <h3 style="margin-bottom: 0; font-size: 1.4rem;"><?= htmlspecialchars($v['marque'] . ' ' . $v['modele']) ?></h3>
                            <p style="color: var(--text-muted); font-size: 0.9rem;"><?= htmlspecialchars($v['annee']) ?></p>
                        </div>
                        <p style="color: var(--primary-color); font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.8rem; margin-bottom: 1.5rem;">
                            <?= number_format($v['tarif_jour'], 0, ',', ' ') ?> DT <span style="font-size: 1rem; font-weight: 400; color: var(--text-muted);">/ j</span>
                        </p>
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 0.5rem; margin-bottom: 1.5rem; font-size: 0.85rem; color: var(--text-muted); background: rgba(0,0,0,0.2); padding: 1rem; border-radius: var(--border-radius-sm);">
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><path d="M12 6v6l4 2"/></svg>
                                <?= htmlspecialchars($v['boite_vitesse']) ?>
                            </div>
                            <div style="display: flex; align-items: center; gap: 0.5rem;">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18M5 21V7l8-4v18M13 11h8v10M9 7v14M17 11v10"/></svg>
                                <?= htmlspecialchars($v['carburant']) ?>
                            </div>
                        </div>
                        <a href="index.php?c=Vehicle&a=details&id=<?= $v['id'] ?>" class="btn btn-outline" style="width: 100%; border-color: var(--surface-border); color: #fff;">Plus de détails</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div style="grid-column: 1 / -1; text-align: center; padding: 4rem;">
                <p style="color: var(--text-muted); font-size: 1.2rem;">Aucun véhicule n'est disponible dans le catalogue pour le moment.</p>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include 'views/footer.php'; ?>
