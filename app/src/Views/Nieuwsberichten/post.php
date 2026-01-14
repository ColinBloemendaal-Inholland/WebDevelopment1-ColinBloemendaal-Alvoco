<main>
    <div class="container mt-4">
        <a href="/nieuwsberichten" class="btn btn-link mb-3"><i class="bi bi-arrow-left"></i> Terug naar nieuwsberichten</a>
        <article class="card">
            <div class="card-body">
                <h1 class="card-title"><?= e($data['nieuwsbericht']['Title'] ?? '') ?></h1>
                <h6 class="card-subtitle mb-2 text-muted">
                    <?php if (!empty($data['nieuwsbericht']['authur'])): ?>
                        Door: <?= e($data['nieuwsbericht']['authur']['lid']['fullname']) ?>
                    <?php endif; ?>
                </h6>
                <p class="card-text mt-3"><?= htmlspecialchars_decode($data['nieuwsbericht']['Message'] ?? '') ?></p>
            </div>
        </article>
    </div>
</main>
