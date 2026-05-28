<?php include 'views/header.php'; ?>

<div class="container fade-in" style="display: flex; justify-content: center; align-items: center; min-height: 70vh;">
    <div class="card" style="width: 100%; max-width: 550px; padding: 1rem;">
        <div class="card-body">
            <div style="text-align: center; margin-bottom: 2rem;">
                <h2 style="font-size: 2rem; margin-bottom: 0.5rem;">Créer un compte</h2>
                <p style="color: var(--text-muted);">Rejoignez Renti pour réserver votre véhicule.</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert alert-danger" style="background: rgba(255, 75, 75, 0.1); border: 1px solid rgba(255, 75, 75, 0.3); color: var(--danger-color); padding: 1rem; border-radius: var(--border-radius-sm); margin-bottom: 1.5rem;">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="index.php?c=Auth&a=register" data-validate="true">
                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                    <div class="form-group">
                        <label for="prenom">Prénom</label>
                        <input type="text" id="prenom" name="prenom" required placeholder="Jean">
                        <div class="error-message" style="color: var(--danger-color); font-size: 0.85rem; display: none; margin-top: 0.5rem;"></div>
                    </div>
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" id="nom" name="nom" required placeholder="Dupont">
                        <div class="error-message" style="color: var(--danger-color); font-size: 0.85rem; display: none; margin-top: 0.5rem;"></div>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="email">Adresse Email</label>
                    <input type="email" id="email" name="email" required placeholder="nom@exemple.com">
                    <div class="error-message" style="color: var(--danger-color); font-size: 0.85rem; display: none; margin-top: 0.5rem;"></div>
                </div>
                
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div style="position: relative;">
                        <input type="password" id="password" name="password" required minlength="6" placeholder="Minimum 6 caractères" style="padding-right: 2.5rem;">
                        <button type="button" onclick="togglePasswordVisibility('password', 'eyeIcon1')" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-muted); cursor: pointer; padding: 0; outline: none;">
                            <svg id="eyeIcon1" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                    </div>
                    <div class="error-message" style="color: var(--danger-color); font-size: 0.85rem; display: none; margin-top: 0.5rem;"></div>
                </div>
                
                <div class="form-group" style="margin-bottom: 2.5rem;">
                    <label for="password_confirm">Confirmer le mot de passe</label>
                    <div style="position: relative;">
                        <input type="password" id="password_confirm" name="password_confirm" required placeholder="Répétez le mot de passe" style="padding-right: 2.5rem;">
                        <button type="button" onclick="togglePasswordVisibility('password_confirm', 'eyeIcon2')" style="position: absolute; right: 0.75rem; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-muted); cursor: pointer; padding: 0; outline: none;">
                            <svg id="eyeIcon2" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </button>
                    </div>
                    <div class="error-message" style="color: var(--danger-color); font-size: 0.85rem; display: none; margin-top: 0.5rem;"></div>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 1rem;">Finaliser l'inscription</button>
            </form>
            
            <p style="text-align: center; margin-top: 2rem; color: var(--text-muted);">
                Déjà membre ? <a href="index.php?c=Auth&a=login" style="font-weight: 600;">Se connecter</a>
            </p>
        </div>
    </div>
</div>

<script>
function togglePasswordVisibility(inputId, iconId) {
    const passwordInput = document.getElementById(inputId);
    const eyeIcon = document.getElementById(iconId);
    if (passwordInput.type === 'password') {
        passwordInput.type = 'text';
        eyeIcon.innerHTML = '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"></path><line x1="1" y1="1" x2="23" y2="23"></line>';
    } else {
        passwordInput.type = 'password';
        eyeIcon.innerHTML = '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle>';
    }
}
</script>

<?php include 'views/footer.php'; ?>
