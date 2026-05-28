<?php include 'views/header.php'; ?>

<div class="container fade-in">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem;">
        <div>
            <span style="color: var(--primary-color); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 0.9rem;">Administration</span>
            <h1 style="margin-bottom: 0;">Dashboard</h1>
        </div>
        <p style="color: var(--text-muted);">Connecté en tant que <strong><?= $_SESSION['user']['prenom'] ?></strong></p>
    </div>

    <!-- Admin Sub-navigation -->
    <div style="display: flex; gap: 1rem; margin-bottom: 2rem; border-bottom: 1px solid var(--surface-border); padding-bottom: 1rem;">
        <a href="index.php?c=Admin&a=dashboard" class="btn btn-primary" style="padding: 0.5rem 1.5rem;">Vue d'ensemble</a>
        <a href="index.php?c=Admin&a=vehicles" class="btn btn-outline" style="padding: 0.5rem 1.5rem; border-color: var(--surface-border); color: var(--text-muted);">Véhicules</a>
        <a href="index.php?c=Admin&a=users" class="btn btn-outline" style="padding: 0.5rem 1.5rem; border-color: var(--surface-border); color: var(--text-muted);">Clients</a>
    </div>

    <!-- KPIs -->
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); margin-bottom: 3rem;">
        <div class="card" style="border-bottom: 4px solid var(--primary-color); background: rgba(0,210,255,0.05);">
            <div class="card-body" style="padding: 1.5rem;">
                <h4 style="color: var(--text-muted); font-size: 1rem; margin-bottom: 0.5rem; font-family: 'Plus Jakarta Sans', sans-serif;">Clients Inscrits</h4>
                <p style="font-size: 3rem; font-weight: 800; color: var(--primary-color); font-family: 'Outfit', sans-serif; line-height: 1;"><?= $stats['total_users'] ?></p>
            </div>
        </div>
        <div class="card" style="border-bottom: 4px solid var(--success-color); background: rgba(0,230,118,0.05);">
            <div class="card-body" style="padding: 1.5rem;">
                <h4 style="color: var(--text-muted); font-size: 1rem; margin-bottom: 0.5rem; font-family: 'Plus Jakarta Sans', sans-serif;">Véhicules</h4>
                <p style="font-size: 3rem; font-weight: 800; color: var(--success-color); font-family: 'Outfit', sans-serif; line-height: 1;"><?= $stats['total_vehicles'] ?></p>
            </div>
        </div>
        <div class="card" style="border-bottom: 4px solid var(--warning-color); background: rgba(255,183,77,0.05);">
            <div class="card-body" style="padding: 1.5rem;">
                <h4 style="color: var(--text-muted); font-size: 1rem; margin-bottom: 0.5rem; font-family: 'Plus Jakarta Sans', sans-serif;">Réservations</h4>
                <p style="font-size: 3rem; font-weight: 800; color: var(--warning-color); font-family: 'Outfit', sans-serif; line-height: 1;"><?= $stats['total_reservations'] ?></p>
            </div>
        </div>
        <div class="card" style="border-bottom: 4px solid #b794f6; background: rgba(183,148,246,0.05);">
            <div class="card-body" style="padding: 1.5rem;">
                <h4 style="color: var(--text-muted); font-size: 1rem; margin-bottom: 0.5rem; font-family: 'Plus Jakarta Sans', sans-serif;">Chiffre d'Affaires</h4>
                <p style="font-size: 2.5rem; font-weight: 800; color: #b794f6; font-family: 'Outfit', sans-serif; line-height: 1.2;"><?= number_format($stats['revenue'], 0, ',', ' ') ?> DT</p>
            </div>
        </div>
    </div>

    <!-- Dernières réservations -->
    <div>
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h2>Dernières Réservations</h2>
        </div>
        
        <div class="card" style="padding: 0;">
            <div style="overflow-x: auto; max-height: 500px;">
                <table>
                    <thead style="position: sticky; top: 0; z-index: 10;">
                        <tr>
                            <th>Réf</th>
                            <th>Client</th>
                            <th>Véhicule</th>
                            <th>Dates</th>
                            <th>Total</th>
                            <th>Statut</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($recent_reservations as $r): 
                            $total = $r['montant'] + $r['frais_sup'];
                        ?>
                        <tr>
                            <td style="color: var(--text-muted); font-family: 'Outfit';">#<?= str_pad($r['id'], 4, '0', STR_PAD_LEFT) ?></td>
                            <td style="font-weight: 500; color: #fff;"><?= htmlspecialchars($r['prenom'] . ' ' . $r['nom']) ?></td>
                            <td><?= htmlspecialchars($r['marque'] . ' ' . $r['modele']) ?></td>
                            <td><?= date('d/m/y', strtotime($r['date_debut'])) ?> au <?= date('d/m/y', strtotime($r['date_fin'])) ?></td>
                            <td style="color: var(--primary-color); font-weight: 600;"><?= number_format($total, 0, ',', ' ') ?> DT</td>
                            <td><span class="badge <?= $r['statut'] ?>"><?= ucfirst($r['statut']) ?></span></td>
                            <td>
                                <button onclick="editReservation(<?= htmlspecialchars(json_encode($r)) ?>)" class="btn btn-outline" style="padding: 0.3rem 0.8rem; font-size: 0.8rem;">Gérer</button>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Gestion Réservation -->
<div id="editReservationModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(30, 41, 59, 0.8); backdrop-filter: blur(5px); z-index:2000; align-items:center; justify-content:center;">
    <div class="card" style="width: 100%; max-width: 400px; padding: 2.5rem;">
        <h2 style="margin-bottom: 1.5rem;">Réservation #<span id="res_id_display" style="color: var(--primary-color);"></span></h2>
        <form method="POST" action="index.php?c=Admin&a=updateReservation">
            <input type="hidden" name="id" id="res_id">
            <div class="form-group">
                <label>Statut</label>
                <select name="statut" id="res_statut">
                    <option value="en_attente">En attente</option>
                    <option value="confirmee">Confirmée</option>
                    <option value="terminee">Terminée</option>
                    <option value="annulee">Annulée</option>
                </select>
            </div>
            <div class="form-group">
                <label>Frais supplémentaires (DT)</label>
                <input type="number" step="0.01" name="frais_sup" id="res_frais" value="0">
            </div>
            <div style="display:flex; gap:1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="flex:1;">Mettre à jour</button>
                <button type="button" class="btn btn-outline" style="flex:1;" onclick="document.getElementById('editReservationModal').style.display='none'">Fermer</button>
            </div>
        </form>
    </div>
</div>

<script>
function editReservation(res) {
    document.getElementById('res_id').value = res.id;
    document.getElementById('res_id_display').textContent = String(res.id).padStart(4, '0');
    document.getElementById('res_statut').value = res.statut;
    document.getElementById('res_frais').value = res.frais_sup;
    document.getElementById('editReservationModal').style.display = 'flex';
}
</script>

<?php include 'views/footer.php'; ?>
