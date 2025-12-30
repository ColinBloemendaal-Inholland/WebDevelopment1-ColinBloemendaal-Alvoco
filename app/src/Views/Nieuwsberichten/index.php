<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold">Nieuwsberichten</h1>
            <p class="lead">Blijf op de hoogte van het laatste nieuws en updates van onze vereniging.</p>
        </div>
    </div>
    <div class="row g-4">
        <?php if (!empty($data['nieuwsberichten']) && is_array($data['nieuwsberichten'])): ?>
            <?php foreach ($data['nieuwsberichten'] as $nieuws): ?>
                <div class="col-12 col-md-6 col-lg-4 d-flex align-items-stretch">
                    <div class="card shadow-sm h-100 flex-grow-1">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2">
                                <a href="/nieuwsberichten/<?= e($nieuws['id']) ?>" class="text-decoration-none text-dark">
                                    <?= e($nieuws['Title']) ?>
                                </a>
                            </h5>
                            <h6 class="card-subtitle mb-2 text-muted">
                                <?php if (!empty($nieuws['Authur']['lid'])): ?>
                                    Door
                                    <?= e($nieuws['Authur']['lid']['firstname'] . ' ' . ($nieuws['Authur']['lid']['middlename'] ?? '') . ' ' . $nieuws['Authur']['lid']['lastname']) ?>
                                <?php endif; ?>
                            </h6>
                            <?php if (!empty($nieuws['created_at'])): ?>
                                <small class="text-secondary mb-2">Geplaatst op
                                    <?= date('d-m-Y', strtotime($nieuws['created_at'])) ?></small>
                            <?php endif; ?>
                            <p class="card-text mt-2 flex-grow-1">
                                <?= e($nieuws['preview']) ?>
                            </p>
                            <a href="/nieuwsberichten/<?= e($nieuws['id']) ?>" class="btn btn-outline-primary mt-auto">Lees
                                meer</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info text-center">Geen nieuwsberichten gevonden.</div>
            </div>
        <?php endif; ?>
    </div>
</div>
