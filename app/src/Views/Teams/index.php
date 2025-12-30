<div class="container my-5">
    <div class="row mb-4 align-items-center">
        <div class="col-lg-8 col-md-7 col-12">
            <h1 class="display-5 fw-bold mb-2 text-primary">
                <i class="bi bi-people-fill me-2"></i> Teams
            </h1>
            <p class="lead text-muted mb-0">Ontdek alle teams van Alvoco, gesorteerd per categorie. Klik op een team
                voor meer informatie, spelers, coaches en wedstrijden.</p>
        </div>
    </div>

    <?php
    if (!empty($data['teams']) && is_array($data['teams'])) {
        foreach ($data['teams'] as $category => $categoryTeams) {
            if (!empty($categoryTeams)) {
                echo '<h2 class="mt-4 mb-3">' . htmlspecialchars($category) . '</h2>';
                echo '<div class="row g-4">';
                foreach ($categoryTeams as $team) {
                    ?>
                    <div class="col-12 col-sm-6 col-md-4 col-lg-3 team-card">
                        <a href="/teams/<?= intval($team->id); ?>" class="text-decoration-none text-dark">
                            <div class="card h-100 shadow-sm">
                                <div class="ratio ratio-16x9 bg-secondary d-flex align-items-center justify-content-center text-white"
                                    style="background-image: linear-gradient(135deg, rgba(0,0,0,0.15), rgba(255,255,255,0.02));">
                                    <div>
                                        <i class="bi bi-people-fill" style="font-size:36px; opacity:0.9"></i>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mb-1"><?= htmlspecialchars($team->name); ?></h5>
                                    <p class="card-text text-muted small mb-2">Klasse: <?= htmlspecialchars($team->class ?? '-'); ?></p>
                                    <?php if (!empty($team->Category)): ?>
                                        <span class="badge bg-primary"><?= htmlspecialchars($team->Category); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="card-footer bg-transparent border-0">
                                    <small class="text-muted">Bekijk team</small>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                echo '</div>';
            }
        }
    }
    if (empty($data['teams']) || count($data['teams']) === 0): ?>
        <div class="col-12">
            <div class="alert alert-info">Er zijn nog geen teams beschikbaar.</div>
        </div>
    <?php endif; ?>
</div>
