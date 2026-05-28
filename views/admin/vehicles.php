<?php include 'views/header.php'; ?>

<div class="container fade-in">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem;">
        <div>
            <span style="color: var(--primary-color); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 0.9rem;">Administration</span>
            <h1 style="margin-bottom: 0;">Gestion des Véhicules</h1>
        </div>
        <p style="color: var(--text-muted);">Connecté en tant que <strong><?= $_SESSION['user']['prenom'] ?></strong></p>
    </div>

    <!-- Admin Sub-navigation -->
    <div style="display: flex; gap: 1rem; margin-bottom: 2rem; border-bottom: 1px solid var(--surface-border); padding-bottom: 1rem;">
        <a href="index.php?c=Admin&a=dashboard" class="btn btn-outline" style="padding: 0.5rem 1.5rem; border-color: var(--surface-border); color: var(--text-muted);">Vue d'ensemble</a>
        <a href="index.php?c=Admin&a=vehicles" class="btn btn-primary" style="padding: 0.5rem 1.5rem;">Véhicules</a>
        <a href="index.php?c=Admin&a=users" class="btn btn-outline" style="padding: 0.5rem 1.5rem; border-color: var(--surface-border); color: var(--text-muted);">Clients</a>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Flotte Actuelle</h2>
        <button onclick="document.getElementById('addVehicleModal').style.display='flex'" class="btn btn-primary" style="padding: 0.5rem 1.5rem; font-size: 0.9rem;">+ Nouveau Véhicule</button>
    </div>
    
    <div class="card" style="padding: 0;">
        <div style="overflow-x: auto; max-height: 600px;">
            <table>
                <thead style="position: sticky; top: 0; z-index: 10;">
                    <tr>
                        <th>Véhicule</th>
                        <th>Année</th>
                        <th>Infos</th>
                        <th>Tarif/j</th>
                        <th>Statut</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($vehicles as $v): ?>
                    <tr>
                        <td>
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <img src="<?= htmlspecialchars($v['image_url']) ?>" alt="Voiture" style="width: 60px; height: 40px; object-fit: cover; border-radius: 4px;" onerror="this.src='https://images.unsplash.com/photo-1503376762362-7a2c6c9966b6?w=100'">
                                <span style="font-weight: 500; color: #fff;"><?= htmlspecialchars($v['marque'] . ' ' . $v['modele']) ?></span>
                            </div>
                        </td>
                        <td><?= htmlspecialchars($v['annee']) ?></td>
                        <td><span style="font-size: 0.85rem; color: var(--text-muted);"><?= htmlspecialchars($v['carburant'] . ' - ' . $v['boite_vitesse']) ?></span></td>
                        <td style="color: var(--primary-color); font-family: 'Outfit', sans-serif; font-weight: 600;"><?= number_format($v['tarif_jour'], 0) ?> DT</td>
                        <td><span class="badge <?= $v['statut'] ?>"><?= ucfirst($v['statut']) ?></span></td>
                        <td style="text-align: right;">
                            <button onclick='editVehicle(<?= htmlspecialchars(json_encode($v), ENT_QUOTES, "UTF-8") ?>)' class="btn btn-outline" style="padding: 0.3rem 0.8rem; font-size: 0.8rem; margin-right: 0.5rem;">Éditer</button>
                            <a href="index.php?c=Admin&a=deleteVehicle&id=<?= $v['id'] ?>" class="btn btn-danger" style="padding: 0.3rem 0.8rem; font-size: 0.8rem; background: rgba(255, 75, 75, 0.1); border: 1px solid rgba(255, 75, 75, 0.3); color: var(--danger-color);" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?');">Supprimer</a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Ajout Véhicule -->
<div id="addVehicleModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(30, 41, 59, 0.8); backdrop-filter: blur(5px); z-index:2000; align-items:center; justify-content:center;">
    <div class="card" style="width: 100%; max-width: 600px; padding: 2.5rem; max-height: 90vh; overflow-y: auto;">
        <h2 style="margin-bottom: 1.5rem;">Ajouter un Véhicule</h2>
        <form method="POST" action="index.php?c=Admin&a=addVehicle">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group" style="margin-bottom: 0;"><label>Marque</label><input type="text" name="marque" required></div>
                <div class="form-group" style="margin-bottom: 0;"><label>Modèle</label><input type="text" name="modele" required></div>
                <div class="form-group" style="margin-bottom: 0;"><label>Année</label><input type="number" name="annee" required></div>
                <div class="form-group" style="margin-bottom: 0;"><label>Tarif/Jour (DT)</label><input type="number" step="1" name="tarif_jour" required></div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label>Carburant</label>
                    <select name="carburant">
                        <option value="Essence">Essence</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Hybride">Hybride</option>
                        <option value="Électrique">Électrique</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label>Boîte</label>
                    <select name="boite_vitesse">
                        <option value="Automatique">Automatique</option>
                        <option value="Manuelle">Manuelle</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group" style="margin-top: 1.5rem;">
                <label>URL Image (Unsplash recommandé)</label>
                <input type="text" name="image_url" placeholder="https://...">
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" rows="3"></textarea>
            </div>
            
            <div class="form-group">
                <label>Statut</label>
                <select name="statut">
                    <option value="disponible">Disponible</option>
                    <option value="reserve">Réservé</option>
                    <option value="maintenance">En maintenance</option>
                </select>
            </div>
            <div style="display:flex; gap:1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="flex:1;">Ajouter le véhicule</button>
                <button type="button" class="btn btn-outline" style="flex:1;" onclick="document.getElementById('addVehicleModal').style.display='none'">Annuler</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Édition Véhicule -->
<div id="editVehicleModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(30, 41, 59, 0.8); backdrop-filter: blur(5px); z-index:2000; align-items:center; justify-content:center;">
    <div class="card" style="width: 100%; max-width: 600px; padding: 2.5rem; max-height: 90vh; overflow-y: auto;">
        <h2 style="margin-bottom: 1.5rem;">Éditer le Véhicule</h2>
        <form method="POST" action="index.php?c=Admin&a=updateVehicle">
            <input type="hidden" name="id" id="edit_id">
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1.5rem;">
                <div class="form-group" style="margin-bottom: 0;"><label>Marque</label><input type="text" name="marque" id="edit_marque" required></div>
                <div class="form-group" style="margin-bottom: 0;"><label>Modèle</label><input type="text" name="modele" id="edit_modele" required></div>
                <div class="form-group" style="margin-bottom: 0;"><label>Année</label><input type="number" name="annee" id="edit_annee" required></div>
                <div class="form-group" style="margin-bottom: 0;"><label>Tarif/Jour (DT)</label><input type="number" step="1" name="tarif_jour" id="edit_tarif" required></div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label>Carburant</label>
                    <select name="carburant" id="edit_carburant">
                        <option value="Essence">Essence</option>
                        <option value="Diesel">Diesel</option>
                        <option value="Hybride">Hybride</option>
                        <option value="Électrique">Électrique</option>
                    </select>
                </div>
                <div class="form-group" style="margin-bottom: 0;">
                    <label>Boîte</label>
                    <select name="boite_vitesse" id="edit_boite">
                        <option value="Automatique">Automatique</option>
                        <option value="Manuelle">Manuelle</option>
                    </select>
                </div>
            </div>
            
            <div class="form-group" style="margin-top: 1.5rem;">
                <label>URL Image</label>
                <input type="text" name="image_url" id="edit_image">
            </div>
            
            <div class="form-group">
                <label>Description</label>
                <textarea name="description" id="edit_description" rows="3"></textarea>
            </div>
            
            <div class="form-group">
                <label>Statut</label>
                <select name="statut" id="edit_statut">
                    <option value="disponible">Disponible</option>
                    <option value="reserve">Réservé</option>
                    <option value="maintenance">En maintenance</option>
                </select>
            </div>
            <div style="display:flex; gap:1rem; margin-top: 2rem;">
                <button type="submit" class="btn btn-primary" style="flex:1;">Mettre à jour</button>
                <button type="button" class="btn btn-outline" style="flex:1;" onclick="document.getElementById('editVehicleModal').style.display='none'">Annuler</button>
            </div>
        </form>
    </div>
</div>

<script>
function editVehicle(v) {
    document.getElementById('edit_id').value = v.id;
    document.getElementById('edit_marque').value = v.marque;
    document.getElementById('edit_modele').value = v.modele;
    document.getElementById('edit_annee').value = v.annee;
    document.getElementById('edit_tarif').value = v.tarif_jour;
    document.getElementById('edit_carburant').value = v.carburant;
    document.getElementById('edit_boite').value = v.boite_vitesse;
    document.getElementById('edit_image').value = v.image_url;
    document.getElementById('edit_description').value = v.description;
    document.getElementById('edit_statut').value = v.statut;
    document.getElementById('editVehicleModal').style.display = 'flex';
}
</script>

<?php include 'views/footer.php'; ?>
