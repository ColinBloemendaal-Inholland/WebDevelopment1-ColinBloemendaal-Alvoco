<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4"><?= e($data['team']['name']) ?></h2>
                        <div>
                            <a href="edit.php?id=<?= e($data['team']['id']) ?>"
                                class="btn btn-primary btn-sm">Bewerken</a>
                            <a href="delete.php?id=<?= e($data['team']['id']) ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Weet je het zeker?')">Verwijderen</a>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <!-- Team eigenschappen -->
                            <h5 class="mb-3">Eigenschappen</h5>
                            <dl class="row">
                                <dt class="col-sm-3">Naam</dt>
                                <dd class="col-sm-9"><?= e($data['team']['name']) ?></dd>

                                <dt class="col-sm-3">Categorie</dt>
                                <dd class="col-sm-9"><?= e($data['team']['Category'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Klas</dt>
                                <dd class="col-sm-9"><?= e($data['team']['class'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Aangemaakt op</dt>
                                <dd class="col-sm-9"><?= e($data['team']['created_at'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Laatste wijziging</dt>
                                <dd class="col-sm-9"><?= e($data['team']['updated_at'] ?? '-') ?></dd>
                            </dl>

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
                                <p>- Geen spelers toegewezen</p>
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
                                <p>- Geen coaches toegewezen</p>
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
                                <p>- Geen trainers toegewezen</p>
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
                                <p>- Geen wedstrijden gevonden</p>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>