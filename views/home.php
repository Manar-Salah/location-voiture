<?php include 'views/header.php'; ?>

<section class="hero">
    <div class="hero-bg"></div>
    <div class="hero-overlay"></div>
    <div style="z-index: 1; text-align: center; max-width: 900px; margin: 0 auto;">
        <h1 style="font-size: clamp(3rem, 5vw, 5rem);">Votre route commence ici.</h1>
        <p style="font-size: clamp(1.2rem, 2vw, 1.5rem); margin-bottom: 2.5rem; text-shadow: 0 2px 4px rgba(0,0,0,0.5);">Découvrez une flotte de véhicules récents, disponibles immédiatement avec réservation simplifiée, prix transparents et assurance incluse.</p>
        <div style="display: flex; gap: 1.5rem; justify-content: center;">
            <a href="index.php?c=Vehicle&a=catalogue" class="btn btn-primary" style="padding: 1rem 2.5rem; font-size: 1.1rem;">Découvrir la flotte</a>
            <a href="#stats" class="btn btn-outline" style="padding: 1rem 2.5rem; font-size: 1.1rem; color: #fff; border-color: rgba(255,255,255,0.3);">Comment ça marche ?</a>
        </div>
    </div>
</section>

<!-- How it works Section -->
<section id="stats" class="container reveal fade-bottom" style="margin-top: 2rem; position: relative; z-index: 2;">
    <div class="grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); text-align: center; gap: 1.5rem;">
        <div class="card reveal fade-bottom" style="background: rgba(30, 41, 59, 0.95); transition-delay: 0.1s;">
            <div class="card-body">
                <div style="color: var(--primary-color); margin-bottom: 1.5rem;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="10" rx="2"/><circle cx="7" cy="17" r="2"/><circle cx="17" cy="17" r="2"/><path d="M14 11V7a2 2 0 0 0-2-2H8a2 2 0 0 0-2 2v4"/></svg>
                </div>
                <h3 style="color: var(--text-primary); font-size: 1.2rem; margin-bottom: 0.5rem;">1. Choisissez</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Parcourez notre flotte et trouvez la voiture adaptée à vos besoins.</p>
            </div>
        </div>
        <div class="card reveal fade-bottom" style="background: rgba(30, 41, 59, 0.95); transition-delay: 0.2s;">
            <div class="card-body">
                <div style="color: var(--primary-color); margin-bottom: 1.5rem;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"/><line x1="16" y1="2" x2="16" y2="6"/><line x1="8" y1="2" x2="8" y2="6"/><line x1="3" y1="10" x2="21" y2="10"/></svg>
                </div>
                <h3 style="color: var(--text-primary); font-size: 1.2rem; margin-bottom: 0.5rem;">2. Réservez</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Sélectionnez vos dates et validez votre réservation en quelques clics.</p>
            </div>
        </div>
        <div class="card reveal fade-bottom" style="background: rgba(30, 41, 59, 0.95); transition-delay: 0.3s;">
            <div class="card-body">
                <div style="color: var(--primary-color); margin-bottom: 1.5rem;">
                    <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M21 2l-2 2m-7.61 7.61a5.5 5.5 0 1 1-7.778 7.778 5.5 5.5 0 0 1 7.777-7.777zm0 0L15.5 7.5m0 0l3 3L22 7l-3-3m-3.5 3.5L19 4"/></svg>
                </div>
                <h3 style="color: var(--text-primary); font-size: 1.2rem; margin-bottom: 0.5rem;">3. Conduisez</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem;">Récupérez vos clés en agence et profitez de votre trajet sereinement.</p>
            </div>
        </div>
    </div>
</section>

<section class="container" style="padding-top: 4rem;">
    <div class="reveal fade-bottom" style="display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 3rem;">
        <div>
            <h2 style="font-size: 1.8rem; margin-top: 0.5rem; margin-bottom: 0;">Notre sélection pour votre prochain trajet.</h2>
        </div>
        <a href="index.php?c=Vehicle&a=catalogue" style="display: flex; align-items: center; gap: 0.5rem; font-weight: 600;">
            Voir tout 
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
        </a>
    </div>
    
    <div class="grid">
        <?php if (!empty($vehicules)): ?>
            <?php foreach($vehicules as $index => $v): ?>
                <div class="card reveal fade-bottom" style="transition-delay: <?= $index * 0.1 ?>s;">
                    <div class="card-img-container">
                        <img src="<?= htmlspecialchars($v['image_url']) ?>" alt="<?= htmlspecialchars($v['marque'] . ' ' . $v['modele']) ?>" class="card-img" onerror="this.src='https://images.unsplash.com/photo-1503376762362-7a2c6c9966b6?w=600'">
                    </div>
                    <div class="card-body">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem;">
                            <div>
                                <h3 style="margin-bottom: 0; font-size: 1.4rem;"><?= htmlspecialchars($v['marque'] . ' ' . $v['modele']) ?></h3>
                                <p style="color: var(--text-muted); font-size: 0.9rem;"><?= htmlspecialchars($v['annee']) ?></p>
                            </div>
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
                        <a href="index.php?c=Vehicle&a=details&id=<?= $v['id'] ?>" class="btn btn-outline" style="width: 100%; border-color: var(--surface-border); color: #fff;">Réserver maintenant</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="color: var(--text-muted);">Aucun véhicule premium disponible pour le moment.</p>
        <?php endif; ?>
    </div>
</section>

<!-- Testimonials Section -->
<section class="container reveal fade-bottom" style="padding-top: 2rem; padding-bottom: 5rem;">
    <div style="text-align: center; margin-bottom: 3rem;">
        <span style="color: var(--primary-color); font-weight: 700; letter-spacing: 2px; text-transform: uppercase; font-size: 0.9rem;">Témoignages</span>
        <h2 style="font-size: 2.5rem; margin-top: 0.5rem;">L'expérience de nos clients</h2>
    </div>
    <div class="grid" style="grid-template-columns: repeat(3, 1fr);">
        <div class="card reveal fade-left" style="background: rgba(255,255,255,0.02); transition-delay: 0.1s;">
            <div class="card-body">
                <div style="display:flex; color: var(--warning-color); margin-bottom: 1rem;">
                    ★ ★ ★ ★ ★
                </div>
                <p style="font-style: italic; color: var(--text-muted); margin-bottom: 1.5rem;">"Réservation très rapide et sans complication. La voiture était propre, récente et exactement comme sur les photos."</p>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: #333; overflow: hidden;">
                        <img src="https://i.pravatar.cc/100?img=47" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div>
                        <h4 style="margin: 0; font-size: 1rem;">Yasmine B.</h4>
                        <span style="font-size: 0.8rem; color: var(--text-muted);">Étudiante à Tunis</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card reveal fade-bottom" style="background: rgba(255,255,255,0.02); transition-delay: 0.2s;">
            <div class="card-body">
                <div style="display:flex; color: var(--warning-color); margin-bottom: 1rem;">
                    ★ ★ ★ ★ ★
                </div>
                <p style="font-style: italic; color: var(--text-muted); margin-bottom: 1.5rem;">"Très bon rapport qualité/prix. J’ai récupéré la voiture en quelques minutes seulement. Service sérieux."</p>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: #333; overflow: hidden;">
                        <img src="https://i.pravatar.cc/100?img=33" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div>
                        <h4 style="margin: 0; font-size: 1rem;">Mohamed A.</h4>
                        <span style="font-size: 0.8rem; color: var(--text-muted);">Consultant</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="card reveal fade-right" style="background: rgba(255,255,255,0.02); transition-delay: 0.3s;">
            <div class="card-body">
                <div style="display:flex; color: var(--warning-color); margin-bottom: 1rem;">
                    ★ ★ ★ ★ ★
                </div>
                <p style="font-style: italic; color: var(--text-muted); margin-bottom: 1.5rem;">"Première expérience avec Renti et franchement rien à dire. Processus clair, prix transparents et conduite agréable."</p>
                <div style="display: flex; align-items: center; gap: 1rem;">
                    <div style="width: 40px; height: 40px; border-radius: 50%; background: #333; overflow: hidden;">
                        <img src="https://i.pravatar.cc/100?img=11" alt="Avatar" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <div>
                        <h4 style="margin: 0; font-size: 1rem;">Walid T.</h4>
                        <span style="font-size: 0.8rem; color: var(--text-muted);">Ingénieur</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include 'views/footer.php'; ?>
