<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4"><?= e($data['coach']['lid']['fullname']) ?></h2>
                        <div>
                            <a href="/admin/leden/<?= e($data['coach']['lid']['id']) ?>"
                                class="btn btn-primary btn-sm">Bekijk lid</a>
                            <a href="edit.php?id=<?= e($data['coach']['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete.php?id=<?= e($data['coach']['id']) ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </div>

                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Rol</dt>
                                <dd class="col-sm-9"><?= e($data['coach']['role']) ?></dd>

                                <dt class="col-sm-3">Start Datum</dt>
                                <dd class="col-sm-9"><?= e($data['coach']['start_date']) ?></dd>

                                <dt class="col-sm-3">Eind Datum</dt>
                                <dd class="col-sm-9"><?= e($data['coach']['end_date'] ?? 'Huidig') ?></dd>

                                <dt class="col-sm-3">Team</dt>
                                <dd class="col-sm-9"><?= e($data['coach']['team']['name'] ?? 'Niet toegewezen') ?></dd>

                                <dt class="col-sm-3">Member ID</dt>
                                <dd class="col-sm-9"><?= e($data['coach']['Leden_id']) ?></dd>

                                <dt class="col-sm-3">Created At</dt>
                                <dd class="col-sm-9"><?= e($data['coach']['created_at']) ?></dd>

                                <dt class="col-sm-3">Updated At</dt>
                                <dd class="col-sm-9"><?= e($data['coach']['updated_at']) ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>