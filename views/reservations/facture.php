<?php include 'views/header.php'; ?>

<div class="container">
    <div class="invoice-box">
        <div style="display: flex; justify-content: space-between; margin-bottom: 2rem; border-bottom: 2px solid var(--border-color); padding-bottom: 1rem;">
            <div>
                <h2>Renti</h2>
                <p>63 Avenue Habib Bourguiba<br>Tunis, Tunisie<br>VIP@renti.com</p>
            </div>
            <div style="text-align: right;">
                <h1 style="color: var(--primary-color);">FACTURE</h1>
                <p><strong>Réf :</strong> #<?= str_pad($reservation['id'], 5, '0', STR_PAD_LEFT) ?></p>
                <p><strong>Date :</strong> <?= date('d/m/Y', strtotime($reservation['date_creation'])) ?></p>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; margin-bottom: 2rem;">
            <div>
                <h4>Facturé à :</h4>
                <p>
                    <strong><?= htmlspecialchars($reservation['prenom'] . ' ' . $reservation['nom']) ?></strong><br>
                    <?= htmlspecialchars($reservation['email']) ?>
                </p>
            </div>
            <div>
                <h4>Informations Véhicule :</h4>
                <p>
                    <strong><?= htmlspecialchars($reservation['marque'] . ' ' . $reservation['modele']) ?></strong><br>
                    Tarif journalier : <?= number_format($reservation['tarif_jour'], 2, ',', ' ') ?> DT
                </p>
            </div>
        </div>

        <table style="margin-bottom: 2rem;">
            <thead>
                <tr>
                    <th>Description</th>
                    <th>Période</th>
                    <th>Jours</th>
                    <th style="text-align: right;">Montant</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $d1 = new DateTime($reservation['date_debut']);
                    $d2 = new DateTime($reservation['date_fin']);
                    $diff = $d1->diff($d2)->days;
                    $jours = $diff > 0 ? $diff : 1;
                ?>
                <tr>
                    <td>Location de véhicule</td>
                    <td>Du <?= date('d/m/Y', strtotime($reservation['date_debut'])) ?> au <?= date('d/m/Y', strtotime($reservation['date_fin'])) ?></td>
                    <td><?= $jours ?></td>
                    <td style="text-align: right;"><?= number_format($reservation['montant'], 2, ',', ' ') ?> DT</td>
                </tr>
                <?php if ($reservation['frais_sup'] > 0): ?>
                <tr>
                    <td colspan="3"><strong>Frais supplémentaires</strong></td>
                    <td style="text-align: right;"><?= number_format($reservation['frais_sup'], 2, ',', ' ') ?> DT</td>
                </tr>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr style="background-color: var(--secondary-color); font-weight: bold; font-size: 1.2rem;">
                    <td colspan="3" style="text-align: right;">TOTAL TTC</td>
                    <td style="text-align: right; color: var(--primary-color);">
                        <?= number_format($reservation['montant'] + $reservation['frais_sup'], 2, ',', ' ') ?> DT
                    </td>
                </tr>
            </tfoot>
        </table>

        <div style="text-align: center; margin-top: 3rem;">
            <p>Merci pour votre confiance !</p>
            <p style="font-size: 0.9rem; color: var(--text-muted);">En cas de question concernant cette facture, veuillez nous contacter.</p>
        </div>

        <div style="text-align: center; margin-top: 2rem;" class="no-print">
            <button onclick="printInvoice()" class="btn btn-primary">Imprimer la facture</button>
            <a href="index.php?c=Reservation&a=mes_reservations" class="btn btn-outline" style="margin-left: 1rem;">Retour aux réservations</a>
        </div>
    </div>
</div>

<style>
@media print {
    header, footer, .no-print, .alert {
        display: none !important;
    }
    body {
        background-color: white;
    }
    .invoice-box {
        box-shadow: none;
        border: none;
        padding: 0;
    }
}
</style>

<?php include 'views/footer.php'; ?>
