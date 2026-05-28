<?php include 'views/header.php'; ?>

<div class="container fade-in">
    <div style="display: flex; flex-direction: column; gap: 2rem;">
        
        <!-- Header du détail -->
        <div style="display: flex; justify-content: space-between; align-items: flex-end; border-bottom: 1px solid var(--surface-border); padding-bottom: 1.5rem;">
            <div>
                <span style="color: var(--primary-color); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 0.9rem;">Détails du véhicule</span>
                <h1 style="margin-bottom: 0; font-size: 3rem;"><?= htmlspecialchars($vehicule['marque'] . ' ' . $vehicule['modele']) ?></h1>
            </div>
            <div style="text-align: right;">
                <p style="color: var(--primary-color); font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 2.5rem; margin-bottom: 0;">
                    <?= number_format($vehicule['tarif_jour'], 0, ',', ' ') ?> DT <span style="font-size: 1rem; font-weight: 400; color: var(--text-muted);">/ jour</span>
                </p>
                <span class="badge <?= $vehicule['statut'] === 'disponible' ? 'disponible' : 'reserve' ?>"><?= ucfirst($vehicule['statut']) ?></span>
            </div>
        </div>

        <div style="display: flex; gap: 3rem; flex-wrap: wrap;">
            <!-- Image Section -->
            <div style="flex: 1.5; min-width: 350px;">
                <div class="card" style="padding: 0; border: none;">
                    <img src="<?= htmlspecialchars($vehicule['image_url']) ?>" alt="<?= htmlspecialchars($vehicule['marque'] . ' ' . $vehicule['modele']) ?>" style="width: 100%; height: auto; border-radius: var(--border-radius-lg); box-shadow: var(--shadow-glow);" onerror="this.src='https://images.unsplash.com/photo-1503376762362-7a2c6c9966b6?w=800'">
                </div>
            </div>

            <!-- Infos Section -->
            <div style="flex: 1; min-width: 300px; display: flex; flex-direction: column; gap: 2rem;">
                
                <div class="card" style="background: rgba(255,255,255,0.02);">
                    <div class="card-body">
                        <h3 style="margin-bottom: 1rem; font-size: 1.2rem; color: var(--text-muted);">Spécifications Techniques</h3>
                        <div style="display: grid; grid-template-columns: 1fr; gap: 1rem;">
                            <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--surface-border); padding-bottom: 0.5rem;">
                                <span style="color: var(--text-muted);">Année</span>
                                <strong><?= htmlspecialchars($vehicule['annee']) ?></strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--surface-border); padding-bottom: 0.5rem;">
                                <span style="color: var(--text-muted);">Motorisation</span>
                                <strong><?= htmlspecialchars($vehicule['carburant']) ?></strong>
                            </div>
                            <div style="display: flex; justify-content: space-between; border-bottom: 1px solid var(--surface-border); padding-bottom: 0.5rem;">
                                <span style="color: var(--text-muted);">Transmission</span>
                                <strong><?= htmlspecialchars($vehicule['boite_vitesse']) ?></strong>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 style="margin-bottom: 0.5rem;">À propos de ce véhicule</h3>
                    <p style="color: var(--text-muted); line-height: 1.8;"><?= nl2br(htmlspecialchars($vehicule['description'] ?? 'Ce véhicule premium offre un confort et des performances exceptionnelles, idéal pour vos déplacements les plus exigeants.')) ?></p>
                </div>

                <div style="margin-top: auto;">
                    <?php if ($vehicule['statut'] === 'disponible'): ?>
                        <a href="index.php?c=Reservation&a=create&id_vehicule=<?= $vehicule['id'] ?>" class="btn btn-primary" style="width: 100%; font-size: 1.1rem; padding: 1.2rem;">Réserver ce véhicule</a>
                    <?php else: ?>
                        <button class="btn" style="width: 100%; background: rgba(255,255,255,0.1); color: var(--text-muted); cursor: not-allowed; padding: 1.2rem;" disabled>Indisponible pour le moment</button>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>
</div>

<?php include 'views/footer.php'; ?>
