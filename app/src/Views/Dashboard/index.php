<div class="container py-5">
    <div class="row mb-4">
        <div class="col-md-8 mx-auto">
            <div class="card shadow-sm">
                <div class="card-body">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h2 class="card-title mb-0">Welkom,
                            <?= e($data['user']->fullname) ?>
                        </h2>
                        <a href="/profile/edit" class="btn btn-outline-primary btn-sm ms-3">Profiel bewerken</a>
                    </div>
                    <p class="mb-1"><strong>Email:</strong> <?= e($data['user']->email) ?></p>
                    <?php if (!empty($data['teamsCoached']) && count($data['teamsCoached']) > 0): ?>
                        <hr>
                        <h5 class="mt-3">Teams die je coacht</h5>
                        <div class="accordion mb-3" id="teamsAccordion">
                            <?php foreach ($data['teamsCoached'] as $idx => $team): ?>
                                <?php if ($team): ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header d-flex align-items-center" id="heading<?= $idx ?>">
                                            <button class="accordion-button collapsed d-flex justify-content-between align-items-center" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#collapse<?= $idx ?>"
                                                aria-expanded="false" aria-controls="collapse<?= $idx ?>">
                                                <span class="flex-grow-1 text-start"><?= e($team->name ?? 'Onbekend team') ?></span>
                                                <a href="/dashboard/teams/<?= e($team->id) ?>/edit"
                                                    class="btn btn-outline-secondary btn-sm ms-2 p-1" title="Team bewerken">
                                                    <span class="bi bi-pencil"></span>
                                                </a>
                                            </button>

                                        </h2>
                                        <div id="collapse<?= $idx ?>" class="accordion-collapse collapse"
                                            aria-labelledby="heading<?= $idx ?>" data-bs-parent="#teamsAccordion">
                                            <div class="accordion-body">
                                                <h6>Komende wedstrijden</h6>
                                                <ul class="list-group mb-3">
                                                    <?php if (!empty($team->upcoming_games) && count($team->upcoming_games) > 0): ?>
                                                        <?php foreach ($team->upcoming_games as $game): ?>
                                                            <li class="list-group-item">
                                                                <?= e(date('d-m-Y', strtotime($game->date))) ?>
                                                                <?= e(date('H:i', strtotime($game->time))) ?> -
                                                                <?= e($game->hometeam->name ?? '') ?> vs
                                                                <?= e($game->awayTeam->name ?? '') ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <li class="list-group-item">Geen komende wedstrijden</li>
                                                    <?php endif; ?>
                                                </ul>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>Spelers</h6>
                                                        <ul class="list-group mb-3">
                                                            <?php foreach ($team->spelers as $speler): ?>
                                                                <li class="list-group-item">
                                                                    <span
                                                                        class="badge bg-primary me-2"><?= e($speler->number ?? '-') ?></span>
                                                                    <?= e($speler->lid->fullname ?? 'Onbekende speler') ?>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Coaches</h6>
                                                        <ul class="list-group mb-3">
                                                            <?php foreach ($team->coaches as $coach): ?>
                                                                <li class="list-group-item">
                                                                    <?= e($coach->lid->fullname ?? 'Onbekende coach') ?>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                        <h6>Trainers</h6>
                                                        <ul class="list-group mb-3">
                                                            <?php foreach ($team->trainers as $trainer): ?>
                                                                <li class="list-group-item">
                                                                    <?= e($trainer->lid->fullname ?? 'Onbekende trainer') ?>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['teamsTrained']) && count($data['teamsTrained']) > 0): ?>
                        <hr>
                        <h5 class="mt-3">Teams die je traint</h5>
                        <div class="accordion mb-3" id="teamsTrainedAccordion">
                            <?php foreach ($data['teamsTrained'] as $idx => $team): ?>
                                <?php if ($team): ?>
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingTrained<?= $idx ?>">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseTrained<?= $idx ?>" aria-expanded="false"
                                                aria-controls="collapseTrained<?= $idx ?>">
                                                <?= e($team->name ?? 'Onbekend team') ?>
                                            </button>
                                        </h2>
                                        <div id="collapseTrained<?= $idx ?>" class="accordion-collapse collapse"
                                            aria-labelledby="headingTrained<?= $idx ?>" data-bs-parent="#teamsTrainedAccordion">
                                            <div class="accordion-body">
                                                <h6>Komende wedstrijden</h6>
                                                <ul class="list-group mb-3">
                                                    <?php if (!empty($team->upcoming_games) && count($team->upcoming_games) > 0): ?>
                                                        <?php foreach ($team->upcoming_games as $game): ?>
                                                            <li class="list-group-item">
                                                                <?= e(date('d-m-Y', strtotime($game->date))) ?>
                                                                <?= e(date('H:i', strtotime($game->time))) ?> -
                                                                <?= e($game->hometeam->name ?? '') ?> vs
                                                                <?= e($game->awayTeam->name ?? '') ?>
                                                            </li>
                                                        <?php endforeach; ?>
                                                    <?php else: ?>
                                                        <li class="list-group-item">Geen komende wedstrijden</li>
                                                    <?php endif; ?>
                                                </ul>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h6>Spelers</h6>
                                                        <ul class="list-group mb-3">
                                                            <?php foreach ($team->spelers as $speler): ?>
                                                                <li class="list-group-item">
                                                                    <span
                                                                        class="badge bg-primary me-2"><?= e($speler->number ?? '-') ?></span>
                                                                    <?= e($speler->lid->fullname ?? 'Onbekende speler') ?>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <h6>Coaches</h6>
                                                        <ul class="list-group mb-3">
                                                            <?php foreach ($team->coaches as $coach): ?>
                                                                <li class="list-group-item">
                                                                    <?= e($coach->lid->fullname ?? 'Onbekende coach') ?>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                        <h6>Trainers</h6>
                                                        <ul class="list-group mb-3">
                                                            <?php foreach ($team->trainers as $trainer): ?>
                                                                <li class="list-group-item">
                                                                    <?= e($trainer->lid->fullname ?? 'Onbekende trainer') ?>
                                                                </li>
                                                            <?php endforeach; ?>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($data['recentNews']) && count($data['recentNews']) > 0): ?>
                        <hr>
                        <h5 class="mt-3">Jouw 5 meest recente nieuwsberichten</h5>
                        <ul class="list-group mb-3">
                            <?php foreach ($data['recentNews'] as $news): ?>
                                <li
                                    class="list-group-item d-flex flex-md-row flex-column justify-content-between align-items-start gap-2">
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center">
                                            <strong class="me-2 mb-0" style="line-height:1.5;"><?= e($news->Title) ?></strong>
                                            <a href="/nieuwsberichten/<?= e($news->id) ?>"
                                                class="btn btn-primary btn-sm ms-auto">Bekijk</a>
                                        </div>
                                        <small class="text-muted">Geplaatst op
                                            <?= e(date('d-m-Y H:i', strtotime($news->created_at))) ?></small>
                                        <div><?= e($news->preview()) ?></div>
                                    </div>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
