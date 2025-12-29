<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Lid Bewerken</h2>
                    <form method="POST" action="/admin/leden/<?= e($data['lid']['id'] ?? '') ?>">
                        <input type="hidden" name="_method" value="PUT">
                        <?php \View::Partial('Layout.errors'); ?>
                        
                        <!-- Persoonlijke Gegevens -->
                        <h5 class="mb-3">Persoonlijke Gegevens</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-12 col-md-4">
                                <label for="firstname" class="form-label">Voornaam</label>
                                <input id="firstname" type="text" class="form-control" name="firstname" required
                                    value="<?= e($data['lid']['firstname'] ?? '') ?>">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="middlename" class="form-label">Tussenvoegsel</label>
                                <input id="middlename" type="text" class="form-control" name="middlename"
                                    value="<?= e($data['lid']['middlename'] ?? '') ?>">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label for="lastname" class="form-label">Achternaam</label>
                                <input id="lastname" type="text" class="form-control" name="lastname" required
                                    value="<?= e($data['lid']['lastname'] ?? '') ?>">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 col-md-6">
                                <label for="gender" class="form-label">Geslacht</label>
                                <select id="gender" class="form-select" name="gender" required>
                                    <option disabled hidden>Kies...</option>
                                    <option value="M" <?= $data['lid']['gender'] ?? '' === 'M' ? 'selected' : '' ?>>Man</option>
                                    <option value="F" <?= $data['lid']['gender'] ?? '' === 'F' ? 'selected' : '' ?>>Vrouw</option>
                                    <option value="O" <?= $data['lid']['gender'] ?? '' === 'O' ? 'selected' : '' ?>>Anders</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-6">
                                <label for="date_of_birth" class="form-label">Geboortedatum</label>
                                <input id="date_of_birth" type="date" class="form-control" name="date_of_birth" required
                                    value="<?= e($data['lid']['date_of_birth'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-12 col-md-6">
                                <label for="email"  class="form-label">E-mail</label>
                                <input id="email" type="email" class="form-control" name="email" required
                                    value="<?= e($data['lid']['email'] ?? '') ?>">
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="phone" class="form-label">Telefoonnummer</label>
                                <input id="phone" type="tel" class="form-control" name="phone" required
                                    value="<?= e($data['lid']['phone'] ?? '') ?>">
                            </div>
                        </div>
                        <!-- Rollen -->
                        <h5 class="mb-3">Rollen</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label class="form-label" for="roles">Selecteer Rollen</label>
                                <select name="role[]" id="roles" class="form-select" multiple>
                                    <?php foreach ($data['rolen'] as $rol): ?>
                                        <option value="<?= $rol->id ?>" <?= in_array($rol->id, $data['roleIds'] ?? []) ? 'selected' : '' ?>>
                                            <?= e($rol->name) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>

                        <!-- Adres -->
                        <h5 class="mb-3">Adres</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-8 col-md-4">
                                <label for="streetname" class="form-label">Straatnaam</label>
                                <input id="streetname" type="text" class="form-control" name="streetname"
                                    value="<?= e($data['lid']['streetname'] ?? '') ?>">
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <label for="streetnumber" class="form-label">Nummer</label>
                                <input id="streetnumber" type="text" class="form-control" name="streetnumber"
                                    value="<?= e($data['lid']['streetnumber'] ?? '') ?>">
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <label for="postalcode" class="form-label">Postcode</label>
                                <input id="postalcode" type="text" class="form-control" name="postalcode"
                                    value="<?= e($data['lid']['postalcode'] ?? '') ?>">
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <label for="city" class="form-label">Plaats</label>
                                <input id="city" type="text" class="form-control" name="city"
                                    value="<?= e($data['lid']['city'] ?? '') ?>">
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label for="country" class="form-label">Land</label>
                                <input id="country" type="text" class="form-control" name="country"
                                    value="<?= e($data['lid']['country'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- Noodcontact -->
                        <h5 class="mb-3">Noodcontact</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 col-md-3">
                                <label for="emergency_contact_firstname" class="form-label">Voornaam</label>
                                <input id="emergency_contact_firstname" type="text" class="form-control" required name="emergency_contact_firstname"
                                    value="<?= e($data['lid']['emergency_contact_firstname'] ?? '') ?>">
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label for="emergency_contact_middlename" class="form-label">Tussenvoegsel</label>
                                <input id="emergency_contact_middlename" type="text" class="form-control" name="emergency_contact_middlename"
                                    value="<?= e($data['lid']['emergency_contact_middlename'] ?? '') ?>">
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label for="emergency_contact_lastname" class="form-label">Achternaam</label>
                                <input id="emergency_contact_lastname" type="text" class="form-control" required name="emergency_contact_lastname"
                                    value="<?= e($data['lid']['emergency_contact_lastname'] ?? '') ?>">
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label for="emergency_contact_phone" class="form-label">Telefoon</label>
                                <input id="emergency_contact_phone" type="tel" class="form-control" required name="emergency_contact_phone"
                                    value="<?= e($data['lid']['emergency_contact_phone'] ?? '') ?>">
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Opslaan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    new TomSelect("#roles", {
        plugins: ["remove_button"],
        placeholder: "Selecteer rollen...",
        maxItems: null
    });
</script>
