<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4"><?= e($data['contact']['naam']) ?></h2>
                        <div>
                            <a href="/admin/contact/<?= e($data['contact']['id']) ?>/edit" class="btn btn-primary btn-sm">Edit</a>
                            <a href="/admin/contact/<?= e($data['contact']['id']) ?>/delete" class="btn btn-danger btn-sm" onclick="return confirm('Weet je het zeker?')">Delete</a>
                        </div>
                    </div>
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Naam</dt>
                                <dd class="col-sm-9"><?= e($data['contact']['naam']) ?></dd>
                                <dt class="col-sm-3">Email</dt>
                                <dd class="col-sm-9"><?= e($data['contact']['email']) ?></dd>
                                <dt class="col-sm-3">Bericht</dt>
                                <dd class="col-sm-9"><?= e($data['contact']['bericht']) ?></dd>
                                <dt class="col-sm-3">Bestuurslid</dt>
                                <dd class="col-sm-9"><?php
                                    if (!empty($data['contact']['bestuurslid_naam'])) {
                                        echo e($data['contact']['bestuurslid_naam']);
                                    } else {
                                        echo e($data['contact']['bestuurslid_id']);
                                    }
                                ?></dd>
                                <dt class="col-sm-3">Aangemaakt op</dt>
                                <dd class="col-sm-9"><?= e($data['contact']['created_at'] ?? '') ?></dd>
                                <dt class="col-sm-3">Bijgewerkt op</dt>
                                <dd class="col-sm-9"><?= e($data['contact']['updated_at'] ?? '') ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
