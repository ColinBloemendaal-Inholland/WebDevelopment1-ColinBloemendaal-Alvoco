<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Lid Details:
                        <?= e(($data['lid']['firstname'] ?? '') . ' ' . ($data['lid']['lastname'] ?? '')) ?>
                    </h3>
                </div>
                <div class="card-body">
                    <!-- Persoonlijke Gegevens -->
                    <h5 class="mb-3">Persoonlijke Gegevens</h5>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Voornaam:</strong>
                            <?= e($data['lid']['firstname'] ?? '') ?></div>
                        <div class="col-md-4"><strong>Tussenvoegsel:</strong>
                            <?= e($data['lid']['middlename'] ?? '') ?></div>
                        <div class="col-md-4"><strong>Achternaam:</strong>
                            <?= e($data['lid']['lastname'] ?? '') ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Geslacht:</strong>
                            <?= e($data['lid']['gender'] ?? '') ?></div>
                        <div class="col-md-4"><strong>Geboortedatum:</strong>
                            <?= e($data['lid']['date_of_birth'] ?? '') ?></div>
                        <div class="col-md-4"><strong>E-mail:</strong>
                            <?= e($data['lid']['email'] ?? '') ?></div>
                    </div>

                    <!-- Rollen -->
                    <h5 class="mb-3">Rollen</h5>
                    <div class="mb-3">
                        <?php if (!empty($data['lid']['roles'])): ?>
                            <div>
                                <?php foreach ($data['lid']['roles'] as $role): ?>
                                    <span class="badge bg-primary me-2 mb-2 fs-8 py-2 px-3">
                                        <?= e($role['name'] ?? '') ?>
                                    </span>
                                <?php endforeach; ?>
                            </div>
                        <?php else: ?>
                            <p>- Geen rollen toegewezen -</p>
                        <?php endif; ?>
                    </div>

                    <!-- Adres -->
                    <h5 class="mb-3">Adres</h5>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Straatnaam:</strong>
                            <?= e($data['lid']['streetname'] ?? '') ?></div>
                        <div class="col-md-2"><strong>Nummer:</strong>
                            <?= e($data['lid']['streetnumber'] ?? '') ?></div>
                        <div class="col-md-3"><strong>Postcode:</strong>
                            <?= e($data['lid']['postalcode'] ?? '') ?></div>
                        <div class="col-md-3"><strong>Plaats:</strong>
                            <?= e($data['lid']['city'] ?? '') ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Land:</strong>
                            <?= e($data['lid']['country'] ?? '') ?></div>
                    </div>

                    <!-- Noodcontact -->
                    <h5 class="mb-3">Noodcontact</h5>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Voornaam:</strong>
                            <?= e($data['lid']['emergency_contact_firstname'] ?? '') ?></div>
                        <div class="col-md-4"><strong>Tussenvoegsel:</strong>
                            <?= e($data['lid']['emergency_contact_middlename'] ?? '') ?></div>
                        <div class="col-md-4"><strong>Achternaam:</strong>
                            <?= e($data['lid']['emergency_contact_lastname'] ?? '') ?></div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-4"><strong>Telefoon:</strong>
                            <?= e($data['lid']['emergency_contact_phone'] ?? '') ?></div>
                    </div>

                    <!-- Actions -->
                    <div class="text-end mt-4">
                        <a href="/admin/leden/<?= e($data['lid']['id'] ?? '') ?>/edit"
                            class="btn btn-warning me-2">Bewerken</a>
                        <a href="/admin/leden" class="btn btn-secondary">Terug naar lijst</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>