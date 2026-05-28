<?php include 'views/header.php'; ?>

<div class="container fade-in" style="display: flex; justify-content: center; align-items: flex-start; min-height: 70vh; padding-top: 2rem;">
    <div style="display: flex; gap: 3rem; flex-wrap: wrap; width: 100%; max-width: 1000px;">
        
        <div style="flex: 1; min-width: 300px;">
            <div class="card" style="padding: 0; border: none; margin-bottom: 2rem;">
                <img src="<?= htmlspecialchars($vehicule['image_url']) ?>" alt="<?= htmlspecialchars($vehicule['marque'] . ' ' . $vehicule['modele']) ?>" style="width: 100%; height: auto; border-radius: var(--border-radius-lg); box-shadow: var(--shadow-glass);" onerror="this.src='https://images.unsplash.com/photo-1503376762362-7a2c6c9966b6?w=600'">
            </div>
            <div>
                <h3 style="margin-bottom: 0.5rem; font-size: 1.5rem;"><?= htmlspecialchars($vehicule['marque'] . ' ' . $vehicule['modele']) ?></h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;"><?= htmlspecialchars($vehicule['annee']) ?> • <?= htmlspecialchars($vehicule['carburant']) ?> • <?= htmlspecialchars($vehicule['boite_vitesse']) ?></p>
            </div>
        </div>

        <div style="flex: 1.5; min-width: 350px;">
            <div class="card">
                <div class="card-body">
                    <h2 style="margin-bottom: 1.5rem; font-size: 1.8rem;">Détails de la réservation</h2>
                    
                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger" style="background: rgba(255, 75, 75, 0.1); border: 1px solid rgba(255, 75, 75, 0.3); color: var(--danger-color); padding: 1rem; border-radius: var(--border-radius-sm); margin-bottom: 1.5rem;">
                            <?= htmlspecialchars($error) ?>
                        </div>
                    <?php endif; ?>

                    <div style="background: rgba(255,255,255,0.02); padding: 1.5rem; border-radius: var(--border-radius); border: 1px solid var(--surface-border); margin-bottom: 2rem; display: flex; justify-content: space-between; align-items: center;">
                        <span style="color: var(--text-muted); font-size: 1.1rem;">Tarif journalier</span>
                        <span style="color: var(--primary-color); font-family: 'Outfit', sans-serif; font-weight: 700; font-size: 1.5rem;"><?= number_format($vehicule['tarif_jour'], 0, ',', ' ') ?> DT</span>
                    </div>

                    <form method="POST" action="index.php?c=Reservation&a=create&id_vehicule=<?= $vehicule['id'] ?>" data-validate="true">
                        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem; margin-bottom: 2rem;">
                            <div class="form-group" style="margin-bottom: 0;">
                                <label for="date_debut">Date de départ</label>
                                <input type="date" id="date_debut" name="date_debut" required min="<?= date('Y-m-d') ?>">
                                <div class="error-message" style="color: var(--danger-color); font-size: 0.85rem; display: none; margin-top: 0.5rem;"></div>
                            </div>
                            <div class="form-group" style="margin-bottom: 0;">
                                <label for="date_fin">Date de retour</label>
                                <input type="date" id="date_fin" name="date_fin" required min="<?= date('Y-m-d') ?>">
                                <div class="error-message" style="color: var(--danger-color); font-size: 0.85rem; display: none; margin-top: 0.5rem;"></div>
                            </div>
                        </div>
                        
                        <div style="margin-bottom: 2rem; padding-top: 1.5rem; border-top: 1px solid var(--surface-border); display: flex; justify-content: space-between; align-items: center;">
                            <span style="font-size: 1.2rem; font-weight: 500; color: var(--text-muted);">Montant estimé</span>
                            <span id="montant_estime" style="font-family: 'Outfit', sans-serif; font-size: 2rem; font-weight: 700; color: #fff;">0 DT</span>
                        </div>

                        <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1.2rem; font-size: 1.1rem;">Confirmer la réservation</button>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const debut = document.getElementById('date_debut');
    const fin = document.getElementById('date_fin');
    const affichage = document.getElementById('montant_estime');
    const tarif = <?= $vehicule['tarif_jour'] ?>;

    function calculerMontant() {
        if (debut.value && fin.value) {
            const d1 = new Date(debut.value);
            const d2 = new Date(fin.value);
            const diffTime = d2 - d1;
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            
            if (diffDays >= 0) {
                const jours = diffDays === 0 ? 1 : diffDays;
                const total = jours * tarif;
                affichage.textContent = new Intl.NumberFormat('fr-FR').format(total) + " DT";
                affichage.style.color = 'var(--primary-color)';
                affichage.style.textShadow = '0 0 10px rgba(0, 210, 255, 0.4)';
            } else {
                affichage.textContent = "Dates invalides";
                affichage.style.color = 'var(--danger-color)';
                affichage.style.textShadow = 'none';
            }
        }
    }

    debut.addEventListener('change', calculerMontant);
    fin.addEventListener('change', calculerMontant);
});
</script>

<?php include 'views/footer.php'; ?>
