<?php include 'views/header.php'; ?>

<div class="container fade-in">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem;">
        <div>
            <span style="color: var(--primary-color); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 0.9rem;">Espace Client</span>
            <h1 style="margin-bottom: 0;">Mes Réservations</h1>
        </div>
        <a href="index.php?c=Vehicle&a=catalogue" class="btn btn-primary">+ Nouvelle Réservation</a>
    </div>

    <?php if (!empty($reservations)): ?>
        <div class="card" style="padding: 0;">
            <div style="overflow-x: auto;">
                <table>
                    <thead>
                        <tr>
                            <th>N° Réf</th>
                            <th>Véhicule</th>
                            <th>Dates</th>
                            <th>Statut</th>
                            <th style="text-align: right;">Montant Total</th>
                            <th style="text-align: center;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($reservations as $r): 
                            $total = $r['montant'] + $r['frais_sup'];
                        ?>
                            <tr>
                                <td style="font-family: 'Outfit', sans-serif; font-weight: 600; color: var(--text-muted);">#<?= str_pad($r['id'], 5, '0', STR_PAD_LEFT) ?></td>
                                <td>
                                    <div style="display: flex; align-items: center; gap: 1rem;">
                                        <img src="<?= htmlspecialchars($r['image_url']) ?>" alt="Voiture" style="width: 50px; height: 35px; object-fit: cover; border-radius: 4px;" onerror="this.src='https://images.unsplash.com/photo-1503376762362-7a2c6c9966b6?w=100'">
                                        <span style="font-weight: 500; color: #fff;"><?= htmlspecialchars($r['marque'] . ' ' . $r['modele']) ?></span>
                                    </div>
                                </td>
                                <td><?= date('d/m/y', strtotime($r['date_debut'])) ?> &rarr; <?= date('d/m/y', strtotime($r['date_fin'])) ?></td>
                                <td><span class="badge <?= htmlspecialchars($r['statut']) ?>"><?= ucfirst(str_replace('_', ' ', $r['statut'])) ?></span></td>
                                <td style="text-align: right; font-family: 'Outfit', sans-serif; font-weight: 600; color: var(--primary-color);"><?= number_format($total, 0, ',', ' ') ?> DT</td>
                                <td style="text-align: center;">
                                    <a href="index.php?c=Reservation&a=facture&id=<?= $r['id'] ?>" class="btn btn-outline" style="padding: 0.4rem 1rem; font-size: 0.8rem;">Facture</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php else: ?>
        <div class="card" style="text-align: center; padding: 4rem;">
            <div style="color: var(--text-muted); margin-bottom: 1rem;">
                <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M4 19a2 2 0 1 0 4 0a2 2 0 0 0-4 0zm12 0a2 2 0 1 0 4 0a2 2 0 0 0-4 0z"/><path d="M3.1 11h17.8L19 4H5zM2 19h2M8 19h8M22 19h-2"/></svg>
            </div>
            <h3 style="margin-bottom: 1rem;">Aucune réservation</h3>
            <p style="color: var(--text-muted); margin-bottom: 2rem;">Vous n'avez pas encore loué de véhicule chez nous.</p>
            <a href="index.php?c=Vehicle&a=catalogue" class="btn btn-primary">Parcourir la flotte</a>
        </div>
    <?php endif; ?>
</div>

<?php include 'views/footer.php'; ?>
