<main>
    <div class="container py-5">
        <div class="row mb-4">
            <section class="col-md-8 mx-auto" aria-label="Dashboard hoofdsectie">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <header class="d-flex align-items-center justify-content-between mb-3">
                            <h1 class="card-title mb-0 h2">Welkom,
                                <?= e($data['user']->fullname) ?>
                            </h1>
                            <a href="/profile/edit" class="btn btn-outline-primary btn-sm ms-3">Profiel bewerken</a>
                        </header>
                        <p class="mb-1"><strong>Email:</strong> <?= e($data['user']->email) ?></p>
                        <?php if (!empty($data['teamsCoached']) && count($data['teamsCoached']) > 0): ?>
                            <hr>
                            <section aria-label="Teams die je coacht">
                                <h2 class="mt-3 h5">Teams die je coacht</h2>
                                <div class="accordion mb-3" id="teamsAccordion">
                                    <?php foreach ($data['teamsCoached'] as $idx => $team): ?>
                                        <?php if ($team): ?>
                                            <article class="accordion-item">
                                                <h3 class="accordion-header d-flex align-items-center h6 gap-2"
                                                    id="heading<?= $idx ?>">
                                                    <button class="accordion-button collapsed flex-grow-1 text-start" type="button"
                                                        data-bs-toggle="collapse" data-bs-target="#collapse<?= $idx ?>"
                                                        aria-expanded="false" aria-controls="collapse<?= $idx ?>">
                                                        <?= e($team->name ?? 'Onbekend team') ?>
                                                    </button>
                                                </h3>
                                                <div id="collapse<?= $idx ?>" class="accordion-collapse collapse"
                                                    aria-labelledby="heading<?= $idx ?>" data-bs-parent="#teamsAccordion">
                                                    <div class="accordion-body">
                                                        <div class="d-flex flex-wrap align-items-center justify-content-between gap-2 mb-3">
                                                            <h4 class="h6 mb-0">Komende wedstrijden</h4>
                                                            <div class="d-flex gap-2">
                                                                <a href="/teams/<?= e($team->id) ?>"
                                                                    class="btn btn-primary btn-sm">
                                                                    Bekijk
                                                                </a>
                                                                <a href="/profile/teams/<?= e($team->id) ?>/edit"
                                                                    class="btn btn-secondary btn-sm">
                                                                    Bewerken
                                                                </a>
                                                            </div>
                                                        </div>
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
                                                                <h5 class="h6">Spelers</h5>
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
                                            </article>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </section>
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
                                                <strong class="me-2 mb-0"><?= e($news->Title) ?></strong>
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
            </section>
        </div>
    </div>
</main>