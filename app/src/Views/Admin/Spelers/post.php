<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4"><?= e($data['speler']['lid']['fullname']) ?></h2>
                        <div>
                            <a href="/admin/leden/<?= e($data['speler']['lid']['id']) ?>"
                                class="btn btn-primary btn-sm">Bekijk lid</a>
                            <a href="/admin/spelers/<?= e($data['speler']['id']) ?>/edit"
                                class="btn btn-primary btn-sm">Bewerken</a>
                            <a href="/admin/spelers/<?= e($data['speler']['id']) ?>/delete" class="btn btn-danger btn-sm"
                                onclick="return confirm('Weet je het zeker?')">Verwijderen</a>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Nummer</dt>
                                <dd class="col-sm-9"><?= e($data['speler']['number']) ?></dd>

                                <dt class="col-sm-3">Positie</dt>
                                <dd class="col-sm-9"><?= e($data['speler']['position']) ?></dd>

                                <dt class="col-sm-3">Team</dt>
                                <dd class="col-sm-9"><?= e($data['speler']['team']['name'] ?? 'Niet toegewezen') ?></dd>

                                <dt class="col-sm-3">Member ID</dt>
                                <dd class="col-sm-9"><?= e($data['speler']['Leden_id']) ?></dd>

                                <dt class="col-sm-3">Aangemaakt op</dt>
                                <dd class="col-sm-9"><?= e($data['speler']['created_at']) ?></dd>

                                <dt class="col-sm-3">Laatste wijziging</dt>
                                <dd class="col-sm-9"><?= e($data['speler']['updated_at']) ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>