<?php include 'views/header.php'; ?>

<div class="container fade-in">
    <div style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 2rem;">
        <div>
            <span style="color: var(--primary-color); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 0.9rem;">Administration</span>
            <h1 style="margin-bottom: 0;">Gestion des Clients</h1>
        </div>
        <p style="color: var(--text-muted);">Connecté en tant que <strong><?= $_SESSION['user']['prenom'] ?></strong></p>
    </div>

    <!-- Admin Sub-navigation -->
    <div style="display: flex; gap: 1rem; margin-bottom: 2rem; border-bottom: 1px solid var(--surface-border); padding-bottom: 1rem;">
        <a href="index.php?c=Admin&a=dashboard" class="btn btn-outline" style="padding: 0.5rem 1.5rem; border-color: var(--surface-border); color: var(--text-muted);">Vue d'ensemble</a>
        <a href="index.php?c=Admin&a=vehicles" class="btn btn-outline" style="padding: 0.5rem 1.5rem; border-color: var(--surface-border); color: var(--text-muted);">Véhicules</a>
        <a href="index.php?c=Admin&a=users" class="btn btn-primary" style="padding: 0.5rem 1.5rem;">Clients</a>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
        <h2>Utilisateurs Inscrits</h2>
    </div>
    
    <div class="card" style="padding: 0;">
        <div style="overflow-x: auto; max-height: 600px;">
            <table>
                <thead style="position: sticky; top: 0; z-index: 10;">
                    <tr>
                        <th>ID</th>
                        <th>Client</th>
                        <th>Email</th>
                        <th>Date d'inscription</th>
                        <th>Rôle</th>
                        <th style="text-align: right;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($users as $u): ?>
                    <tr>
                        <td style="color: var(--text-muted); font-family: 'Outfit';">#<?= str_pad($u['id'], 3, '0', STR_PAD_LEFT) ?></td>
                        <td style="font-weight: 500; color: #fff;">
                            <div style="display: flex; align-items: center; gap: 1rem;">
                                <div style="width: 30px; height: 30px; border-radius: 50%; background: rgba(255,255,255,0.1); display: flex; align-items: center; justify-content: center; font-size: 0.8rem; font-weight: bold;">
                                    <?= substr(htmlspecialchars($u['prenom']), 0, 1) . substr(htmlspecialchars($u['nom']), 0, 1) ?>
                                </div>
                                <?= htmlspecialchars($u['prenom'] . ' ' . $u['nom']) ?>
                            </div>
                        </td>
                        <td style="color: var(--text-muted);"><?= htmlspecialchars($u['email']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($u['date_creation'])) ?></td>
                        <td>
                            <?php if($u['role'] === 'admin'): ?>
                                <span class="badge" style="background: rgba(0, 210, 255, 0.1); color: var(--primary-color); border: 1px solid rgba(0, 210, 255, 0.2);">Admin</span>
                            <?php else: ?>
                                <span class="badge" style="background: rgba(255, 255, 255, 0.05); color: var(--text-muted); border: 1px solid rgba(255, 255, 255, 0.1);">Client</span>
                            <?php endif; ?>
                        </td>
                        <td style="text-align: right;">
                            <?php if($u['id'] != $_SESSION['user']['id']): ?>
                                <a href="index.php?c=Admin&a=deleteUser&id=<?= $u['id'] ?>" class="btn btn-danger" style="padding: 0.3rem 0.8rem; font-size: 0.8rem; background: rgba(255, 75, 75, 0.1); border: 1px solid rgba(255, 75, 75, 0.3); color: var(--danger-color);" onclick="return confirm('Attention ! Supprimer ce client supprimera également toutes ses réservations. Continuer ?');">Supprimer</a>
                            <?php else: ?>
                                <span style="font-size: 0.8rem; color: var(--text-muted); font-style: italic;">Vous-même</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'views/footer.php'; ?>
