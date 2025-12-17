<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4"><?= e($data['nieuwsbericht']['Title']) ?></h2>
                        <div>
                            <a href="edit.php?id=<?= $data['nieuwsbericht']['id'] ?>"
                                class="btn btn-primary btn-sm">Bewerken</a>
                            <a href="delete.php?id=<?= $data['nieuwsbericht']['id'] ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Weet je het zeker?')">Verwijderen</a>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Bericht</dt>
                                <dd class="col-sm-9">
                                    <?= $data['nieuwsbericht']['Message'] ?>
                                </dd>

                                <dt class="col-sm-3">Auteur</dt>
                                <dd class="col-sm-9">
                                    <?= e($data['nieuwsbericht']['authur']['lid']['fullname'] ?? 'Onbekend') ?>
                                </dd>

                                <dt class="col-sm-3">Aangemaakt op</dt>
                                <dd class="col-sm-9"><?= e($data['nieuwsbericht']['created_at']) ?></dd>

                                <dt class="col-sm-3">Laatste wijziging</dt>
                                <dd class="col-sm-9"><?= e($data['nieuwsbericht']['updated_at']) ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>