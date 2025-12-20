<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4"><?= e($data['bestuurslid']['lid']['fullname']) ?></h2>
                        <div>
                            <a href="/admin/leden/<?= e($data['bestuurslid']['lid']['id']) ?>"
                                class="btn btn-primary btn-sm">Bekijk lid</a>
                            <a href="edit.php?id=<?= e($data['bestuurslid']['id']) ?>"
                                class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete.php?id=<?= e($data['bestuurslid']['id']) ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </div>
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Rol</dt>
                                <dd class="col-sm-9"><?= e($data['bestuurslid']['role']) ?></dd>

                                <dt class="col-sm-3">Start Datum</dt>
                                <dd class="col-sm-9"><?= e($data['bestuurslid']['start_date']) ?></dd>

                                <dt class="col-sm-3">Eind Datum</dt>
                                <dd class="col-sm-9"><?= e($data['bestuurslid']['end_date'] ?? 'Huidig') ?></dd>

                                <dt class="col-sm-3">Member ID</dt>
                                <dd class="col-sm-9"><?= e($data['bestuurslid']['Leden_id']) ?></dd>

                                <dt class="col-sm-3">Created At</dt>
                                <dd class="col-sm-9"><?= e($data['bestuurslid']['created_at']) ?></dd>

                                <dt class="col-sm-3">Updated At</dt>
                                <dd class="col-sm-9"><?= e($data['bestuurslid']['updated_at']) ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>