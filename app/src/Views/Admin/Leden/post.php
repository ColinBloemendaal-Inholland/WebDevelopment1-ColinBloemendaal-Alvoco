<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h2 class="h4"><?= e($data['lid']['fullname']) ?></h2>
                        <div>
                            <a href="edit.php?id=<?= e($data['lid']['id']) ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="delete.php?id=<?= e($data['lid']['id']) ?>" class="btn btn-danger btn-sm"
                                onclick="return confirm('Are you sure?')">Delete</a>
                        </div>
                    </div>
                    <div class="card shadow-sm mb-4">
                        <div class="card-body">
                            <dl class="row">
                                <dt class="col-sm-3">Voornaam</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['firstname']) ?></dd>

                                <dt class="col-sm-3">Tussenvoegsel</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['middlename'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Achternaam</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['lastname']) ?></dd>

                                <dt class="col-sm-3">Geslacht</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['gender'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Geboortedatum</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['date_of_birth'] ?? '-') ?></dd>
                                <?php //TODO: Calculate age property and display ?>
                                <dt class="col-sm-3">Leeftijd</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['age'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Email</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['email']) ?></dd>

                                <dt class="col-sm-3">Telefoonnummer</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['phone'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Adres</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['adres'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Land</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['country'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Rollen</dt>
                                <dd class="col-sm-9">
                                    <?php if (!empty($data['lid']['roles'])): ?>
                                        <?php foreach ($data['lid']['roles'] as $role): ?>
                                            <span class="badge bg-secondary me-1"><?= e($role['name']) ?></span>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <span>-</span>
                                    <?php endif; ?>
                                </dd>

                                <dt class="col-sm-3">Noodcontact</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['emergencycontactfullname'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Noodcontact Telefoonnummer</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['emergency_contact_phone'] ?? '-') ?></dd>

                                <dt class="col-sm-3">Aangemaakt op</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['created_at']) ?></dd>

                                <dt class="col-sm-3">Laatste wijziging</dt>
                                <dd class="col-sm-9"><?= e($data['lid']['updated_at']) ?></dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>