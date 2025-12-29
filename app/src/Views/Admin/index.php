<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid">
            <div class="row mb-4">
                <div class="col-12">
                    <h1>Admin Dashboard</h1>
                    <p class="text-muted">Welkom in het beheerdersportaal</p>
                </div>
            </div>

            <!-- Statistics Cards -->
            <div class="row mb-4">
                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="card-title mb-2 text-muted">Totaal Leden</h6>
                                    <h2 class="mb-0"><?= e($data['stats']['totalLeden'] ?? 0) ?></h2>
                                </div>
                                <div class="text-primary" style="font-size: 2.5rem; opacity: 0.2;">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                            </div>
                            <small class="text-muted">Actieve leden in het systeem</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="card-title mb-2 text-muted">Teams</h6>
                                    <h2 class="mb-0"><?= e($data['stats']['totalTeams'] ?? 0) ?></h2>
                                </div>
                                <div class="text-primary" style="font-size: 2.5rem; opacity: 0.2;">
                                    <i class="bi bi-diagram-3-fill"></i>
                                </div>
                            </div>
                            <small class="text-muted">Geregistreerde teams</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="card-title mb-2 text-muted">Wedstrijden</h6>
                                    <h2 class="mb-0"><?= e($data['stats']['totalWedstrijden'] ?? 0) ?></h2>
                                </div>
                                <div class="text-primary" style="font-size: 2.5rem; opacity: 0.2;">
                                    <i class="bi bi-calendar-event-fill"></i>
                                </div>
                            </div>
                            <small class="text-muted">Geplande wedstrijden</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="card-title mb-2 text-muted">Nieuwsberichten</h6>
                                    <h2 class="mb-0"><?= e($data['stats']['totalNieuwsberichten'] ?? 0) ?></h2>
                                </div>
                                <div class="text-primary" style="font-size: 2.5rem; opacity: 0.2;">
                                    <i class="bi bi-newspaper"></i>
                                </div>
                            </div>
                            <small class="text-muted">Gepubliceerde berichten</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="card-title mb-2 text-muted">Spelers</h6>
                                    <h2 class="mb-0"><?= e($data['stats']['totalSpelers'] ?? 0) ?></h2>
                                </div>
                                <div class="text-primary" style="font-size: 2.5rem; opacity: 0.2;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            </div>
                            <small class="text-muted">Geregistreerde spelers</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="card-title mb-2 text-muted">Trainers</h6>
                                    <h2 class="mb-0"><?= e($data['stats']['totalTrainers'] ?? 0) ?></h2>
                                </div>
                                <div class="text-primary" style="font-size: 2.5rem; opacity: 0.2;">
                                    <i class="bi bi-person-vcard-fill"></i>
                                </div>
                            </div>
                            <small class="text-muted">Actieve trainers</small>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3 mb-3">
                    <div class="card shadow-sm border-0">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1">
                                    <h6 class="card-title mb-2 text-muted">Coaches</h6>
                                    <h2 class="mb-0"><?= e($data['stats']['totalCoaches'] ?? 0) ?></h2>
                                </div>
                                <div class="text-primary" style="font-size: 2.5rem; opacity: 0.2;">
                                    <i class="bi bi-person-badge-fill"></i>
                                </div>
                            </div>
                            <small class="text-muted">Geregistreerde coaches</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="row mb-4">
                <div class="col-12">
                    <h5 class="mb-3">Beheer Secties</h5>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-people-fill text-primary me-2"></i>Leden Beheren
                            </h5>
                            <p class="card-text text-muted">Voeg, bewerk en verwijder leden</p>
                            <a href="/admin/leden" class="btn btn-primary btn-sm">Ga naar Leden</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-diagram-3-fill text-primary me-2"></i>Teams Beheren
                            </h5>
                            <p class="card-text text-muted">Beheer alle teams in het systeem</p>
                            <a href="/admin/teams" class="btn btn-primary btn-sm">Ga naar Teams</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-calendar-event-fill text-primary me-2"></i>Wedstrijden Beheren
                            </h5>
                            <p class="card-text text-muted">Plan en beheer wedstrijden</p>
                            <a href="/admin/wedstrijden" class="btn btn-primary btn-sm">Ga naar Wedstrijden</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-newspaper text-primary me-2"></i>Nieuwsberichten Beheren
                            </h5>
                            <p class="card-text text-muted">Publish en beheer nieuwsberichten</p>
                            <a href="/admin/nieuwsberichten" class="btn btn-primary btn-sm">Ga naar Nieuws</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-person-badge-fill text-primary me-2"></i>Coaches Beheren
                            </h5>
                            <p class="card-text text-muted">Beheer coaches en hun toewijzingen</p>
                            <a href="/admin/coaches" class="btn btn-primary btn-sm">Ga naar Coaches</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-person-fill-check text-primary me-2"></i>Bestuur Beheren
                            </h5>
                            <p class="card-text text-muted">Beheer bestuursleden</p>
                            <a href="/admin/bestuursleden" class="btn btn-primary btn-sm">Ga naar Bestuur</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-person-fill text-primary me-2"></i>Spelers Beheren
                            </h5>
                            <p class="card-text text-muted">Beheer alle spelers per team</p>
                            <a href="/admin/spelers" class="btn btn-primary btn-sm">Ga naar Spelers</a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4 mb-3">
                    <div class="card shadow-sm border-0 h-100">
                        <div class="card-body">
                            <h5 class="card-title">
                                <i class="bi bi-person-vcard-fill text-primary me-2"></i>Trainers Beheren
                            </h5>
                            <p class="card-text text-muted">Beheer trainers en toewijzingen</p>
                            <a href="/admin/trainers" class="btn btn-primary btn-sm">Ga naar Trainers</a>
                        </div>
                    </div>
                </div>
