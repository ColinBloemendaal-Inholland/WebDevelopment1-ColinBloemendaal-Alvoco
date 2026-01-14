<main>
    <div class="container py-5">
        <div class="row g-4">
            <!-- Main Content - Nieuwsberichten -->
            <section class="col-lg-8" aria-label="Nieuwsberichten">
                <h1 class="mb-4">Welkom bij Alvoco</h1>
                <section class="mb-5" aria-label="Recente Nieuwsberichten">
                    <h2 class="mb-4">Recente Nieuwsberichten</h2>
                    <?php if (empty($data['nieuwsberichten'])): ?>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>Geen nieuwsberichten beschikbaar.
                        </div>
                    <?php else: ?>
                        <?php foreach ($data['nieuwsberichten'] as $nieuwsbericht): ?>
                            <article class="card shadow-sm border-0 mb-3">
                                <div class="card-body">
                                    <h3 class="card-title h5">
                                        <a href="/nieuwsberichten/<?= e($nieuwsbericht['id']) ?>" class="text-decoration-none">
                                            <?= e(trim($nieuwsbericht['Title'])  ?? 'Geen titel') ?>
                                        </a>
                                    </h3>
                                    <p class="card-text text-muted small mb-2">
                                        <i class="bi bi-calendar-event me-1"></i>
                                        <?= date('d M Y', strtotime( $nieuwsbericht['date'] ?? 'now')) ?>
                                    </p>
                                    <p class="card-text">
                                        <?= htmlspecialchars_decode($nieuwsbericht->preview(200) ?? '') ?>
                                    </p>
                                    <a href="/nieuwsberichten/<?= e($nieuwsbericht['id']) ?>" class="btn btn-primary btn-sm">
                                        Lees meer
                                    </a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </section>
            </section>
            <!-- Sidebar - Wedstrijden -->
            <aside class="col-lg-4" aria-label="Komende Wedstrijden">
                <div class="sticky-top" style="top: 20px;">
                    <h2 class="mb-4">Komende Wedstrijden</h2>
                    <?php if (empty($data['wedstrijdenByDate'])): ?>
                        <div class="alert alert-info">
                            <i class="bi bi-info-circle me-2"></i>Geen wedstrijden gepland.
                        </div>
                    <?php else: ?>
                        <?php foreach ($data['wedstrijdenByDate'] as $date => $wedstrijden): ?>
                            <section class="mb-4" aria-label="Wedstrijden op <?= date('l, d F', strtotime($date)) ?>">
                                <h5 class="mb-3 pb-2 border-bottom">
                                    <i class="bi bi-calendar-check me-2"></i>
                                    <?= date('l, d F', strtotime($date)) ?>
                                </h5>
                                <?php foreach ($wedstrijden as $wedstrijd): ?>
                                    <article class="card shadow-sm border-0 mb-2">
                                        <div class="card-body p-3">
                                            <div class="d-flex justify-content-between align-items-start mb-2">
                                            <h6 class="card-title mb-0">
                                                <a href="/wedstrijden/<?= e($wedstrijd['id']) ?>" class="text-decoration-none">
                                                    <?= e(trim($wedstrijd['team_home']) ?? '') . ' - ' . e(trim($wedstrijd['team_away']) ?? '') ?>
                                                </a>
                                            </h6>
                                        </div>
                                        <p class="card-text small text-muted mb-2">
                                            <i class="bi bi-clock me-1"></i>
                                            <?= date('H:i', strtotime($wedstrijd['time'])) ?>
                                        </p>
                                        <p class="card-text small mb-0">
                                            <i class="bi bi-geo-alt me-1"></i>
                                            <?= e($wedstrijd['location'] ?? 'Locatie onbekend') ?>
                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
