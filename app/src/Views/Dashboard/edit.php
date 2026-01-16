<main>
    <section class="container py-5">
        <div class="row mb-4">
            <div class="col-md-8 mx-auto">
                <article class="card shadow-sm">
                    <div class="card-body">
                        <header>
                            <h2 class="card-title mb-3">Profiel bewerken</h2>
                        </header>
                        <form method="POST" action="/profile/update">
                        <?php \View::partial('Layout.errors'); ?>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="firstname" class="form-label">Voornaam</label>
                                <input type="text" name="firstname" id="firstname" class="form-control"
                                    value="<?= e($_SESSION['form_old']['firstname'] ?? $data['user']->firstname) ?>" placeholder="Voornaam" required aria-label="Voornaam invoerveld">
                            </div>
                            <div class="col-md-4">
                                <label for="middlename" class="form-label">Tussenvoegsel</label>
                                <input type="text" name="middlename" id="middlename" class="form-control"
                                    value="<?= e($_SESSION['form_old']['middlename'] ?? $data['user']->middlename) ?>" placeholder="Tussenvoegsel" aria-label="Tussenvoegsel invoerveld">
                            </div>
                            <div class="col-md-4">
                                <label for="lastname" class="form-label">Achternaam</label>
                                <input type="text" name="lastname" id="lastname" class="form-control"
                                    value="<?= e($_SESSION['form_old']['lastname'] ?? $data['user']->lastname) ?>" placeholder="Achternaam" required aria-label="Achternaam invoerveld">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="email" class="form-label">E-mailadres</label>
                                <input type="email" name="email" id="email" class="form-control"
                                    value="<?= e($_SESSION['form_old']['email'] ?? $data['user']->email) ?>" placeholder="E-mailadres" required aria-label="E-mailadres invoerveld">
                            </div>
                            <div class="col-md-6">
                                <label for="phone" class="form-label">Telefoon</label>
                                <input type="text" name="phone" id="phone" class="form-control"
                                    value="<?= e($_SESSION['form_old']['phone'] ?? $data['user']->phone) ?>" placeholder="+31612345678 / 0612345678" aria-label="Telefoon invoerveld">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="streetname" class="form-label">Straatnaam</label>
                                <input type="text" name="streetname" id="streetname" class="form-control"
                                    value="<?= e($_SESSION['form_old']['streetname'] ?? $data['user']->streetname) ?>" placeholder="Straatnaam" aria-label="Straatnaam invoerveld">
                            </div>
                            <div class="col-md-4">
                                <label for="streetnumber" class="form-label">Huisnummer</label>
                                <input type="text" name="streetnumber" id="streetnumber" class="form-control"
                                    value="<?= e($_SESSION['form_old']['streetnumber'] ?? $data['user']->streetnumber) ?>" placeholder="Huisnummer" aria-label="Huisnummer invoerveld">
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="postalcode" class="form-label">Postcode</label>
                                <input type="text" name="postalcode" id="postalcode" class="form-control"
                                    value="<?= e($_SESSION['form_old']['postalcode'] ?? $data['user']->postalcode) ?>" placeholder="Postcode" aria-label="Postcode invoerveld">
                            </div>
                            <div class="col-md-6">
                                <label for="city" class="form-label">Plaats</label>
                                <input type="text" name="city" id="city" class="form-control"
                                    value="<?= e($_SESSION['form_old']['city'] ?? $data['user']->city) ?>" placeholder="Plaats" aria-label="Plaats invoerveld">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="country" class="form-label">Land</label>
                            <input type="text" name="country" id="country" class="form-control"
                                value="<?= e($_SESSION['form_old']['country'] ?? $data['user']->country) ?>" placeholder="Land" aria-label="Land invoerveld">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="gender" class="form-label">Geslacht</label>
                                <select name="gender" id="gender" class="form-select" required aria-label="Geslacht selectie">
                                    <?php $genderValue = $_SESSION['form_old']['gender'] ?? $data['user']->gender ?? ''; ?>
                                    <option value="" <?= $genderValue === '' ? 'selected' : '' ?>>Selecteer geslacht</option>
                                    <option value="M" <?= $genderValue === 'M' ? 'selected' : '' ?>>Man</option>
                                    <option value="F" <?= $genderValue === 'F' ? 'selected' : '' ?>>Vrouw</option>
                                    <option value="O" <?= $genderValue === 'O' ? 'selected' : '' ?>>Anders</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="geboortedatum" class="form-label">Geboortedatum</label>
                                <input type="date" name="date_of_birth" id="geboortedatum" class="form-control" aria-label="Geboortedatum invoerveld"
                                    value="<?= e($_SESSION['form_old']['geboortedatum'] ?? $data['user']->date_of_birth) ?>">
                            </div>
                        </div>
                        <hr>
                        <header>
                            <h4 class="mb-3">Noodcontact gegevens</h4>
                        </header>
                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label for="emergency_contact_firstname" class="form-label">Voornaam</label>
                                <input type="text" name="emergency_contact_firstname" id="emergency_contact_firstname" class="form-control"
                                    value="<?= e($_SESSION['form_old']['emergency_contact_firstname'] ?? $data['user']->emergency_contact_firstname ?? '') ?>" placeholder="Voornaam" aria-label="Noodcontact voornaam invoerveld">
                            </div>
                            <div class="col-md-4">
                                <label for="emergency_contact_middlename" class="form-label">Tussenvoegsel</label>
                                <input type="text" name="emergency_contact_middlename" id="emergency_contact_middlename" class="form-control"
                                    value="<?= e($_SESSION['form_old']['emergency_contact_middlename'] ?? $data['user']->emergency_contact_middlename ?? '') ?>" placeholder="Tussenvoegsel" aria-label="Noodcontact tussenvoegsel invoerveld">
                            </div>
                            <div class="col-md-4">
                                <label for="emergency_contact_lastname" class="form-label">Achternaam</label>
                                <input type="text" name="emergency_contact_lastname" id="emergency_contact_lastname" class="form-control"
                                    value="<?= e($_SESSION['form_old']['emergency_contact_lastname'] ?? $data['user']->emergency_contact_lastname ?? '') ?>" placeholder="Achternaam" aria-label="Noodcontact achternaam invoerveld">
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="emergency_contact_phone" class="form-label">Telefoon</label>
                            <input type="text" name="emergency_contact_phone" id="emergency_contact_phone" class="form-control" placeholder="+31612345678 / 0612345678"
                                value="<?= e($_SESSION['form_old']['emergency_contact_phone'] ?? $data['user']->emergency_contact_phone ?? '') ?>" aria-label="Noodcontact telefoon invoerveld">
                        </div>
                        <button type="submit" class="btn btn-primary" aria-label="Opslaan van profielwijzigingen">Opslaan</button>
                        <a href="/profile" class="btn btn-secondary ms-2" aria-label="Annuleren en terug naar profiel">Annuleren</a>
                        </form>
                    </div>
                </article>
            </div>
        </div>
    </section>
</main>
