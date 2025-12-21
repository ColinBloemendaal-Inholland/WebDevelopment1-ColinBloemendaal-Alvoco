<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4"><?= e($data['trainer']['lid']['fullname']) ?></h2>
                        <div>
                            <a href="/admin/leden/<?= e($data['trainer']['lid']['id']) ?>"
                                class="btn btn-primary btn-sm">Bekijk lid</a>
                            <a href="/admin/trainers/<?= e($data['trainer']['id']) ?>/edit"
                                class="btn btn-primary btn-sm">Bewerken</a>
                            <a href="/admin/trainers/<?= e($data['trainer']['id']) ?>/delete" class="btn btn-danger btn-sm"
                                onclick="return confirm('Weet je het zeker?')">Verwijderen</a>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <h5 class="mb-3">Eigenschappen</h5>
                            <dl class="row">
                                <dt class="col-sm-3">Rol</dt>
                                <dd class="col-sm-9"><?= e($data['trainer']['role']) ?></dd>

                                <dt class="col-sm-3">Start Datum</dt>
                                <dd class="col-sm-9"><?= e($data['trainer']['start_date']) ?></dd>

                                <dt class="col-sm-3">Eind Datum</dt>
                                <dd class="col-sm-9"><?= e($data['trainer']['end_date'] ?? 'Huidig') ?></dd>

                                <dt class="col-sm-3">Team</dt>
                                <dd class="col-sm-9"><?= e($data['trainer']['team']['name'] ?? 'Niet toegewezen') ?>
                                </dd>

                                <dt class="col-sm-3">Member ID</dt>
                                <dd class="col-sm-9"><?= e($data['trainer']['Leden_id']) ?></dd>

                                <dt class="col-sm-3">Aangemaakt op</dt>
                                <dd class="col-sm-9"><?= e($data['trainer']['created_at']) ?></dd>

                                <dt class="col-sm-3">Laatste wijziging</dt>
                                <dd class="col-sm-9"><?= e($data['trainer']['updated_at']) ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>