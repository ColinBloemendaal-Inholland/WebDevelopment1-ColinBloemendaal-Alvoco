<main>
    <div class="container py-5">
        <header class="row mb-4">
            <div class="col-12 text-center">
                <h1 class="display-4 fw-bold">Nieuwsberichten</h1>
                <p class="lead">Blijf op de hoogte van het laatste nieuws en updates van onze vereniging.</p>
            </div>
        </header>
        <section class="row g-4" aria-label="Nieuwsberichten lijst">
            <?php if (!empty($data['nieuwsberichten']) && $data['nieuwsberichten']): ?>
                <?php foreach ($data['nieuwsberichten'] as $nieuws): ?>
                    <div class="col-12 col-md-6 col-lg-4 d-flex align-items-stretch">
                        <article class="card shadow-sm h-100 flex-grow-1">
                            <div class="card-body d-flex flex-column">
                                <h2 class="card-title mb-2 h5">
                                    <a href="/nieuwsberichten/<?= e($nieuws['id']) ?>" class="text-decoration-none text-dark">
                                        <?= e(trim($nieuws['Title']) ?? '') ?>
                                    </a>
                                </h2>
                                <h3 class="card-subtitle mb-2 text-muted h6">
                                    <?php if (!empty($nieuws['Authur']['lid'])): ?>
                                        Door
                                        <?= e($nieuws['Authur']['lid']['firstname'] . ' ' . ($nieuws['Authur']['lid']['middlename'] ?? '') . ' ' . $nieuws['Authur']['lid']['lastname']) ?>
                                    <?php endif; ?>
                                </h3>
                                <?php if (!empty($nieuws['created_at'])): ?>
                                    <small class="text-secondary mb-2">Geplaatst op
                                        <?= date('d-m-Y', strtotime($nieuws['created_at'])) ?></small>
                                <?php endif; ?>
                                <p class="card-text mt-2 flex-grow-1">
                                    <?= htmlspecialchars_decode($nieuws->preview()) ?>
                                </p>
                                <a href="/nieuwsberichten/<?= e($nieuws['id']) ?>" class="btn btn-outline-primary mt-auto" aria-label="Lees meer over <?= e(trim($nieuws['Title']) ?? '') ?>">Lees
                                    meer</a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">Geen nieuwsberichten gevonden.</div>
                </div>
            <?php endif; ?>
        </section>
    </div>
</main>
