<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">

                    <!-- Top: Match header + action buttons -->
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4"><?= e($data['wedstrijd']['hometeam']['name'] ?? '-') ?> vs
                            <?= e($data['wedstrijd']['awayTeam']['name'] ?? '-') ?>
                        </h2>
                        <div>
                            <a href="/admin/wedstrijden/<?= e($data['wedstrijd']['id']) ?>/edit"
                                class="btn btn-primary btn-sm">Bewerken</a>
                            <a href="/admin/wedstrijden/<?= e($data['wedstrijd']['id']) ?>/delete" class="btn btn-danger btn-sm"
                                onclick="return confirm('Weet je het zeker?')">Verwijderen</a>
                        </div>
                    </div>

                    <!-- Match main info -->
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="mb-3">Wedstrijd informatie</h5>
                            <dl class="row">
                                <dt class="col-sm-3">Datum</dt>
                                <dd class="col-sm-9"><?= e((new DateTime($data['wedstrijd']['date']))->format('d-m-Y')) ?></dd>

                                <dt class="col-sm-3">Tijd</dt>
                                <dd class="col-sm-9"><?= e((new DateTime($data['wedstrijd']['time']))->format('H:i')) ?></dd>

                                <dt class="col-sm-3">Locatie</dt>
                                <dd class="col-sm-9"><?= e($data['wedstrijd']['location']) ?></dd>

                                <dt class="col-sm-3">Score Thuis</dt>
                                <dd class="col-sm-9"><?= e($data['wedstrijd']['score_home'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Score Uit</dt>
                                <dd class="col-sm-9"><?= e($data['wedstrijd']['score_away'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Status</dt>
                                <dd class="col-sm-9"><?= e($data['wedstrijd']['status'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Scheidsrechter</dt>
                                <dd class="col-sm-9"><?= e($data['wedstrijd']['referee'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Aangemaakt op</dt>
                                <dd class="col-sm-9"><?= e($data['wedstrijd']['created_at'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Laatste wijziging</dt>
                                <dd class="col-sm-9"><?= e($data['wedstrijd']['updated_at'] ?? '-') ?></dd>
                            </dl>
                        </div>
                    </div>

                    <!-- Teams columns -->
                    <div class="row">
                        <!-- Home team -->
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0"><?= e($data['wedstrijd']['hometeam']['name'] ?? '-') ?></h5>
                                        <a href="/admin/teams/<?= e($data['wedstrijd']['hometeam']['id']) ?>"
                                            class="btn btn-sm btn-primary">Bekijk team</a>
                                    </div>
                                    <dl class="row">
                                        <dt class="col-sm-4">Naam</dt>
                                        <dd class="col-sm-8"><?= e($data['wedstrijd']['hometeam']['name'] ?? '-') ?></dd>

                                        <dt class="col-sm-4">Categorie</dt>
                                        <dd class="col-sm-8"><?= e($data['wedstrijd']['hometeam']['Category'] ?? '-') ?></dd>

                                        <dt class="col-sm-4">Klas</dt>
                                        <dd class="col-sm-8"><?= e($data['wedstrijd']['hometeam']['class'] ?? '-') ?></dd>
                                    </dl>

                                    <!-- Home team players -->
                                    <h6>Spelers</h6>
                                    <?php if (!empty($data['wedstrijd']['hometeam']['spelers'])): ?>
                                        <ul class="list-group mb-3">
                                            <?php foreach ($data['wedstrijd']['hometeam']['spelers'] as $speler): ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?= e($speler['lid']['fullname']) ?> (Nummer: <?= e($speler['number']) ?>,
                                                    Positie: <?= e($speler['position']) ?>)
                                                    <a href="/admin/spelers/<?= e($speler['id']) ?>"
                                                        class="btn btn-sm btn-outline-primary">Bekijk</a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p>- Geen spelers toegewezen</p>
                                    <?php endif; ?>

                                    <!-- Home team coaches -->
                                    <h6>Coaches</h6>
                                    <?php if (!empty($data['wedstrijd']['hometeam']['coaches'])): ?>
                                        <ul class="list-group mb-3">
                                            <?php foreach ($data['wedstrijd']['hometeam']['coaches'] as $coach): ?>
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
                                </div>
                            </div>
                        </div>

                        <!-- Away team -->
                        <div class="col-md-6 mb-4">
                            <div class="card shadow-sm">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h5 class="mb-0"><?= e($data['wedstrijd']['awayTeam']['name'] ?? '-') ?></h5>
                                        <a href="/admin/teams/<?= e($data['wedstrijd']['awayTeam']['id']) ?>"
                                            class="btn btn-sm btn-primary">Bekijk team</a>
                                    </div>
                                    <dl class="row">
                                        <dt class="col-sm-4">Naam</dt>
                                        <dd class="col-sm-8"><?= e($data['wedstrijd']['awayTeam']['name'] ?? '-') ?></dd>

                                        <dt class="col-sm-4">Categorie</dt>
                                        <dd class="col-sm-8"><?= e($data['wedstrijd']['awayTeam']['Category'] ?? '-') ?></dd>

                                        <dt class="col-sm-4">Klas</dt>
                                        <dd class="col-sm-8"><?= e($data['wedstrijd']['awayTeam']['class'] ?? '-') ?></dd>
                                    </dl>

                                    <!-- Away team players -->
                                    <h6>Spelers</h6>
                                    <?php if (!empty($data['wedstrijd']['awayTeam']['spelers'])): ?>
                                        <ul class="list-group mb-3">
                                            <?php foreach ($data['wedstrijd']['awayTeam']['spelers'] as $speler): ?>
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <?= e($speler['lid']['fullname']) ?> (Nummer: <?= e($speler['number']) ?>,
                                                    Positie: <?= e($speler['position']) ?>)
                                                    <a href="/admin/spelers/<?= e($speler['id']) ?>"
                                                        class="btn btn-sm btn-outline-primary">Bekijk</a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php else: ?>
                                        <p>- Geen spelers toegewezen</p>
                                    <?php endif; ?>

                                    <!-- Away team coaches -->
                                    <h6>Coaches</h6>
                                    <?php if (!empty($data['wedstrijd']['awayTeam']['coaches'])): ?>
                                        <ul class="list-group mb-3">
                                            <?php foreach ($data['wedstrijd']['awayTeam']['coaches'] as $coach): ?>
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End Teams columns -->

                </div>
            </div>
        </div>
    </div>
</div>