<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <header class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4"><?= e($data['team']['name']) ?></h2>
                        <div class="d-flex gap-2">
                            <a href="/admin/teams/<?= e($data['team']['id']) ?>/edit"
                                class="btn btn-primary btn-sm">Bewerken</a>
                            <form action="/admin/teams/<?= e($data['team']['id']) ?>" method="POST" onsubmit="return confirm('Weet je het zeker?')">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger btn-sm">Verwijderen</button>
                            </form>
                        </div>
                    </header>
                    <article class="card shadow-sm mb-4">
                        <div class="card-body">
                            <!-- Team eigenschappen -->
                            <div class="row">
                                <div class="col-md-8">
                                    <h5 class="mb-3">Eigenschappen</h5>
                                    <dl class="row">
                                        <dt class="col-sm-4">Naam</dt>
                                        <dd class="col-sm-8"><?= e($data['team']['name']) ?></dd>

                                        <dt class="col-sm-4">Categorie</dt>
                                        <dd class="col-sm-8"><?= e($data['team']['category'] ?? '-') ?></dd>

                                        <dt class="col-sm-4">Klas</dt>
                                        <dd class="col-sm-8"><?= e($data['team']['class'] ?? '-') ?></dd>

                                        <dt class="col-sm-4">Seizoen</dt>
                                        <dd class="col-sm-8"><?= e($data['team']['seizoenen']['title'] ?? '-') ?></dd>

                                        <dt class="col-sm-4">Aangemaakt op</dt>
                                        <dd class="col-sm-8"><?= e($data['team']['created_at'] ?? '-') ?></dd>

                                        <dt class="col-sm-4">Laatste wijziging</dt>
                                        <dd class="col-sm-8"><?= e($data['team']['updated_at'] ?? '-') ?></dd>
                                    </dl>
                                </div>
                                <div class="col-md-4 d-flex align-items-center justify-content-center">
                                    <?php if (!empty($data['team']['image'])): ?>
                                        <img src="<?= e($data['team']['image']) ?>" alt="Teamfoto" class="img-fluid rounded shadow w-100 h-100" >
                                    <?php else: ?>
                                        <div class="bg-light border rounded d-flex align-items-center justify-content-center w-100 h-100">
                                            <span class="text-muted">Geen teamfoto</span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <hr>

                            <!-- Spelers -->
                            <h5 class="mb-3">Spelers</h5>
                            <?php if (!empty($data['team']['spelers'])): ?>
                                <ul class="list-group mb-3">
                                    <?php foreach ($data['team']['spelers'] as $speler): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= e($speler['lid']['fullname']) ?> (Nummer: <?= e($speler['number']) ?>, Positie:
                                            <?= e($speler['position']) ?>)
                                            <a href="/admin/spelers/<?= e($speler['id']) ?>"
                                                class="btn btn-sm btn-outline-primary">Bekijk</a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <span class="text-muted">Geen spelers toegevoegd aan dit team.</span>
                            <?php endif; ?>

                            <hr>

                            <!-- Coaches -->
                            <h5 class="mb-3">Coaches</h5>
                            <?php if (!empty($data['team']['coaches'])): ?>
                                <ul class="list-group mb-3">
                                    <?php foreach ($data['team']['coaches'] as $coach): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= e($coach['lid']['fullname']) ?> (Rol: <?= e($coach['role']) ?>)
                                            <a href="/admin/coaches/<?= e($coach['id']) ?>"
                                                class="btn btn-sm btn-outline-primary">Bekijk</a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <span class="text-muted">Geen coaches toegevoegd aan dit team.</span>
                            <?php endif; ?>

                            <hr>

                            <!-- Trainers -->
                            <h5 class="mb-3">Trainers</h5>
                            <?php if (!empty($data['team']['trainers'])): ?>
                                <ul class="list-group mb-3">
                                    <?php foreach ($data['team']['trainers'] as $trainer): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= e($trainer['lid']['fullname']) ?> (Rol: <?= e($trainer['role']) ?>)
                                            <a href="/admin/trainers/<?= e($trainer['id']) ?>"
                                                class="btn btn-sm btn-outline-primary">Bekijk</a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <span class="text-muted">Geen trainers toegevoegd aan dit team.</span>
                            <?php endif; ?>

                            <hr>

                            <!-- Wedstrijden -->
                            <h5 class="mb-3">Wedstrijden</h5>
                            <?php if (!empty($data['team']['wedstrijden'])): ?>
                                <ul class="list-group mb-3">
                                    <?php foreach ($data['team']['wedstrijden'] as $wedstrijd): ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <?= e($wedstrijd->hometeam['name']) ?> vs <?= e($wedstrijd->awayTeam['name']) ?>
                                            <a href="/admin/wedstrijden/<?= e($wedstrijd['id']) ?>"
                                                class="btn btn-sm btn-outline-primary">Bekijk</a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php else: ?>
                                <span class="text-muted">Geen wedstrijden gevonden</span>
                            <?php endif; ?>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>
</div>
