</main>
<footer style="background: rgba(30, 41, 59, 0.9); border-top: 1px solid var(--surface-border); padding: 4rem 5% 2rem; margin-top: auto;">
    <div class="container grid" style="padding: 0; margin-bottom: 3rem;">
        <div>
            <div class="logo" style="margin-bottom: 1.5rem;">Renti</div>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Des véhicules fiables et modernes pour tous vos déplacements. Réservez facilement votre voiture au meilleur prix avec Renti.</p>
        </div>
        <div>
            <h4 style="color: #fff; margin-bottom: 1.5rem;">Liens Rapides</h4>
            <ul style="display:flex; flex-direction:column; gap:0.75rem;">
                <li><a href="index.php" style="color: var(--text-muted);">Accueil</a></li>
                <li><a href="index.php?c=Vehicle&a=catalogue" style="color: var(--text-muted);">Notre Flotte</a></li>
                <li><a href="#" style="color: var(--text-muted);">Conditions générales</a></li>
                <li><a href="#" style="color: var(--text-muted);">Contact</a></li>
            </ul>
        </div>
        <div>
            <h4 style="color: #fff; margin-bottom: 1.5rem;">Contact</h4>
            <ul style="display:flex; flex-direction:column; gap:0.75rem; color: var(--text-muted);">
                <li>📍 63 Avenue Habib Bourguiba, Tunis</li>
                <li>📞 +216 21 763 230</li>
                <li>✉️ VIP@renti.com</li>
            </ul>
        </div>
        <div>
            <h4 style="color: #fff; margin-bottom: 1.5rem;">Newsletter</h4>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 1rem;">Recevez nos offres exclusives.</p>
            <div style="display:flex;">
                <input type="email" placeholder="Votre email" style="border-radius: 50px 0 0 50px; border-right: none;">
                <button class="btn btn-primary" style="border-radius: 0 50px 50px 0; padding: 0.5rem 1.5rem;">OK</button>
            </div>
        </div>
    </div>
    <div style="text-align: center; color: var(--text-muted); border-top: 1px solid rgba(255,255,255,0.05); padding-top: 2rem;">
        <p>&copy; <?= date('Y') ?> Renti. Design premium.</p>
    </div>
</footer>
<script src="assets/js/main.js"></script>
<script src="assets/js/validation.js"></script>
</body>
</html>
