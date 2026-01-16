<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container-fluid m-0 py-5">
            <article class="card shadow-sm">
                <div class="card-body">
                    <header>
                        <h2 class="card-title text-center mb-4">Ledenformulier</h2>
                    </header>
                    <form autocomplete="off" method="POST" action="/admin/leden/create">
                        <!-- Persoonlijke Gegevens -->
                        <h5 class="mb-3">Persoonlijke Gegevens</h5>

                        <?php \View::partial('Layout.errors'); ?>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-12 col-md-4">
                                <label class="form-label" for="firstname">Voornaam</label>
                                <input type="text" id="firstname" name="firstname" value="<?= e($_SESSION['form_old']['firstname'] ?? '') ?>"
                                    class="form-control" name="firstname" placeholder="Jan" required autofocus aria-label="Voornaam invoerveld">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label class="form-label" for="middlename">Tussenvoegsel</label>
                                <input type="text" name="middlename" value="<?= e($_SESSION['form_old']['middlename'] ?? '') ?>"
                                    class="form-control" id="middlename" name="middlename" placeholder="van" aria-label="Tussenvoegsel invoerveld">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label class="form-label" for="lastname">Achternaam</label>
                                <input type="text" name="lastname" value="<?= e($_SESSION['form_old']['lastname'] ?? '') ?>"
                                    class="form-control" id="lastname" name="lastname" placeholder="Dijk" required aria-label="Achternaam invoerveld">
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 col-md-4">
                                <label class="form-label" for="gender">Geslacht</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option disabled hidden <?= ($_SESSION['form_old']['gender'] ?? '') === '' ? 'selected' : '' ?>>Kies...</option>
                                    <option value="M" <?= ($_SESSION['form_old']['gender'] ?? '') === 'M' ? 'selected' : '' ?>>Man</option>
                                    <option value="F" <?= ($_SESSION['form_old']['gender'] ?? '') === 'F' ? 'selected' : '' ?>>Vrouw</option>
                                    <option value="O" <?= ($_SESSION['form_old']['gender'] ?? '') === 'O' ? 'selected' : '' ?>>Anders</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label class="form-label" for="dateofbirth">Geboortedatum</label>
                                <input type="date" id="dateofbirth" class="form-control" name="date_of_birth" required value="<?= $_SESSION['form_old']['date_of_birth'] ?? '' ?>" aria-label="Geboortedatum invoerveld">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label class="form-label" for="email">E-mail</label>
                                <input type="email" id="email" class="form-control" name="email" placeholder="voorbeeld@email.com" required value="<?= $_SESSION['form_old']['email'] ?? '' ?>" aria-label="E-mail invoerveld">
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-sm-4 col-md-4">
                                <label class="form-label" for="phone">Telefoon</label>
                                <input type="tel" name="phone" value="<?= e($_SESSION['form_old']['phone'] ?? '') ?>"
                                    class="form-control" id="phone" name="phone" placeholder="+31 6 12345678" required aria-label="Telefoon invoerveld">
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label" for="password">Wachtwoord</label>
                                <input type="password" id="password" class="form-control" name="password" placeholder="••••••••"
                                    required>
                            </div>
                            <div class="col-sm-4">
                                <label class="form-label" for="confirmpassword">Bevestig Wachtwoord</label>
                                <input type="password" id="confirmpassword" class="form-control" name="password_confirm"
                                    placeholder="••••••••" required>
                            </div>
                        </div>

                        <!-- Rollen -->
                        <h5 class="mb-3">Rollen</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label class="form-label" for="roles">Selecteer Rollen</label>
                                <select name="role[]" id="roles" class="form-select" multiple>
                                    <option value="" selected disabled hidden>Selecteer een rol</option>
                                    <?php foreach ($data['rolen'] as $rol) { ?>
                                        <option value="<?= $rol['id'] ?>" <?= (isset($_SESSION['form_old']['role']) && $_SESSION['form_old']['role'] == $rol['id']) ? 'selected' : '' ?>>
                                            <?= e($rol['name']) ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- Adres -->
                        <h5 class="mb-3">Adres</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-8 col-md-4">
                                <label class="form-label" for="streetname">Straatnaam</label>
                                <input type="text" name="streetname" value="<?= e($_SESSION['form_old']['streetname'] ?? '') ?>"
                                    class="form-control" id="streetname" name="streetname" placeholder="Hoofdstraat">
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <label class="form-label" for="streetnumber">Nummer</label>
                                <input type="text" name="streetnumber" value="<?= e($_SESSION['form_old']['streetnumber'] ?? '') ?>"
                                    class="form-control" id="streetnumber" name="streetnumber" placeholder="123">
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <label class="form-label" for="postalcode">Postcode</label>
                                <input type="text" name="postalcode" value="<?= e($_SESSION['form_old']['postalcode'] ?? '') ?>"
                                    class="form-control" id="postalcode" name="postalcode" placeholder="1234 AB">
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <label class="form-label" for="city">Plaats</label>
                                <input type="text" name="city" value="<?= e($_SESSION['form_old']['city'] ?? '') ?>"
                                    class="form-control" id="city" name="city" placeholder="Amsterdam">
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label class="form-label" for="Country">Land</label>
                                <input type="text" name="country" value="<?= e($_SESSION['form_old']['country'] ?? '') ?>"
                                    class="form-control" name="country" id="Country" placeholder="Nederland">
                            </div>
                        </div>

                        <!-- Noodcontact -->
                        <h5 class="mb-3">Noodcontact</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label" for="emergency_firstname">Voornaam</label>
                                <input type="text"
                                    value="<?= e($_SESSION['form_old']['emergency_contact_firstname'] ?? '') ?>"
                                    class="form-control" id="emergency_firstname" name="emergency_contact_firstname" placeholder="Piet" required>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label" for="emergency_middlename">Tussenvoegsel</label>
                                <input type="text"
                                    value="<?= e($_SESSION['form_old']['emergency_contact_middlename'] ?? '') ?>"
                                    class="form-control" id="emergency_middlename" name="emergency_contact_middlename" placeholder="de">
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label" for="emergency_lastname">Achternaam</label>
                                <input type="text" id="emergency_lastname"
                                    value="<?= e($_SESSION['form_old']['emergency_contact_lastname'] ?? '') ?>"
                                    class="form-control" name="emergency_contact_lastname" placeholder="Vries" required>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label" for="emergency_phone">Telefoon</label>
                                <input type="tel" name="emergency_contact_phone" value="<?= e($_SESSION['form_old']['emergency_contact_phone'] ?? '') ?>"
                                    class="form-control" id="emergency_phone" name="emergency_contact_phone" placeholder="+31 6 12345678"
                                    required>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary btn-lg">Verzenden</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

    </div>
            </article>
        </section>
    </main>


<script src="/JS/Admin/Leden/create.js"></script>
