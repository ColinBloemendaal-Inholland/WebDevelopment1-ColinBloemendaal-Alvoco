<main>
    <div class="container my-5">
        <header class="row mb-4 align-items-center">
            <div class="col-lg-8 col-md-7 col-12">
                <h1 class="display-5 fw-bold mb-2 text-primary">
                    <i class="bi bi-people-fill me-2"></i> Teams
                </h1>
                <p class="lead text-muted mb-0">Ontdek alle teams van Alvoco, gesorteerd per categorie. Klik op een team voor meer informatie, spelers, coaches en wedstrijden.</p>
            </div>
            <div class="col-lg-4 col-md-5 col-12 mt-3 mt-md-0">
                <form method="GET" action="">
                    <label for="seizoenFilter" class="form-label">Filter op seizoen:</label>
                    <select name="seizoen_id" id="seizoenFilter" class="form-select" onchange="this.form.submit()">
                        <option value="">Alle seizoenen</option>
                        <?php foreach ($data['seizoenen'] as $seizoen): ?>
                            <option value="<?= e($seizoen['id']) ?>" <?= (isset($_GET['seizoen_id']) ? ($_GET['seizoen_id'] == $seizoen['id']) : (!empty($seizoen['is_current']))) ? 'selected' : '' ?>>
                                <?= e($seizoen['title']) ?><?= !empty($seizoen['is_current']) ? ' (Huidig)' : '' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </form>
            </div>
        </header>

        <?php
        if (!empty($data['teams']) && is_array($data['teams'])) {
            foreach ($data['teams'] as $category => $categoryTeams) {
                if (!empty($categoryTeams)) {
                    echo '<section class="mt-4 mb-3" aria-label="Categorie ' . e($category) . '">';
                    echo '<h2 class="mb-3">' . e($category) . '</h2>';
                    echo '<div class="row g-4">';
                    foreach ($categoryTeams as $team) {
                        ?>
                        <div class="col-12 col-sm-6 col-md-4 col-lg-3 team-card">
                            <a href="/teams/<?= intval($team->id); ?>" class="text-decoration-none text-dark">
                                <article class="card h-100 shadow-sm" itemscope itemtype="https://schema.org/SportsTeam">
                                    <?php if (!empty($team->image)): ?>
                                        <img src="<?= e($team->image) ?>" alt="Teamfoto" class="img-fluid rounded shadow w-100 h-100" >
                                    <?php else: ?>
                                        <div class="bg-light border rounded d-flex align-items-center justify-content-center w-100 h-100">
                                            <span class="text-muted">Geen teamfoto</span>
                                        </div>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <h3 class="card-title mb-1 h5" itemprop="name"><?= e($team->name); ?></h3>
                                        <p class="card-text text-muted small mb-2">Klasse: <?= e($team->class ?? '-'); ?></p>
                                        <?php if (!empty($team->Category)): ?>
                                            <span class="badge bg-primary"><?= e($team->Category); ?></span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="card-footer bg-transparent border-0">
                                        <small class="text-muted">Bekijk team</small>
                                    </div>
                                </article>
                            </a>
                        </div>
                        <?php
                    }
                    echo '</div>';
                    echo '</section>';
                }
            }
        }
        if (empty($data['teams']) || count($data['teams']) === 0): ?>
            <div class="col-12">
                <div class="alert alert-info">Er zijn nog geen teams beschikbaar.</div>
            </div>
        <?php endif; ?>
    </div>
</main>
