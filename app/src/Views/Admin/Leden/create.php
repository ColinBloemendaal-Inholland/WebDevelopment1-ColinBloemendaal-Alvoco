<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Ledenformulier</h2>
                    <form method="POST" action="/admin/leden/create">
                        <!-- Persoonlijke Gegevens -->
                        <h5 class="mb-3">Persoonlijke Gegevens</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-12 col-md-4">
                                <label class="form-label">Voornaam</label>
                                <input type="text" class="form-control" name="firstname" placeholder="Jan" required>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label class="form-label">Tussenvoegsel</label>
                                <input type="text" class="form-control" name="middlename" placeholder="van">
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label class="form-label">Achternaam</label>
                                <input type="text" class="form-control" name="lastname" placeholder="Dijk" required>
                            </div>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 col-md-4">
                                <label class="form-label">Geslacht</label>
                                <select class="form-select" name="gender" required>
                                    <option selected disabled hidden>Kies...</option>
                                    <option value="M">Man</option>
                                    <option value="F">Vrouw</option>
                                    <option value="O">Anders</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-md-4">
                                <label class="form-label">Geboortedatum</label>
                                <input type="date" class="form-control" name="date_of_birth" required>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <label class="form-label">E-mail</label>
                                <input type="email" class="form-control" name="email" placeholder="voorbeeld@email.com"
                                    required>
                            </div>
                        </div>

                        <div class="row g-3 mb-4">
                            <div class="col-sm-6">
                                <label class="form-label">Wachtwoord</label>
                                <input type="password" class="form-control" name="password" placeholder="••••••••"
                                    required>
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Bevestig Wachtwoord</label>
                                <input type="password" class="form-control" name="password_confirm"
                                    placeholder="••••••••" required>
                            </div>
                        </div>

                        <!-- Rollen -->
                        <h5 class="mb-3">Rollen</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-12">
                                <label class="form-label" for="roles">Selecteer Rollen</label>
                                <select name="role" id="roles" class="form-select" multiple>
                                    <option value="" selected disabled hidden>Selecteer een rol</option>
                                    <?php foreach ($data['rolen'] as $rol) { ?>
                                        <option value="<?= $rol->id ?>"><?= $rol->name ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <!-- Adres -->
                        <h5 class="mb-3">Adres</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-8 col-md-4">
                                <label class="form-label">Straatnaam</label>
                                <input type="text" class="form-control" name="streetname" placeholder="Hoofdstraat">
                            </div>
                            <div class="col-sm-4 col-md-1">
                                <label class="form-label">Nummer</label>
                                <input type="text" class="form-control" name="streetnumber" placeholder="123">
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <label class="form-label">Postcode</label>
                                <input type="text" class="form-control" name="postalcode" placeholder="1234 AB">
                            </div>
                            <div class="col-sm-6 col-md-2">
                                <label class="form-label">Plaats</label>
                                <input type="text" class="form-control" name="city" placeholder="Amsterdam">
                            </div>
                            <div class="col-sm-12 col-md-3">
                                <label class="form-label" for="Country">Land</label>
                                <input type="text" class="form-control" name="country" id="Country"
                                    placeholder="Nederland">
                            </div>
                        </div>

                        <!-- Noodcontact -->
                        <h5 class="mb-3">Noodcontact</h5>
                        <div class="row g-3 mb-3">
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label">Voornaam</label>
                                <input type="text" class="form-control" name="emergency_contact_firstname"
                                    placeholder="Piet" required>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label">Tussenvoegsel</label>
                                <input type="text" class="form-control" name="emergency_contact_middlename"
                                    placeholder="de">
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label">Achternaam</label>
                                <input type="text" class="form-control" name="emergency_contact_lastname"
                                    placeholder="Vries" required>
                            </div>
                            <div class="col-sm-6 col-md-3">
                                <label class="form-label">Telefoon</label>
                                <input type="tel" class="form-control" name="emergency_contact_phone"
                                    placeholder="+31 6 12345678" required>
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
</div>


<script>
    new TomSelect("#roles", {
        plugins: ["remove_button"],
        maxItems: null,
        placeholder: "Selecteer rollen...",
    });
</script>