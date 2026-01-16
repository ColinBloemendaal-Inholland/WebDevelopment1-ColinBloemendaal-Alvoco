<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container m-0">
            <header>
                <h1 class="mb-4">Leden</h1>
            </header>
            <?php \View::partial('Partials.DeleteModal', ['type' => 'lid']); ?>
            <?php \View::partial('Partials.ForceDeleteModal', ['type' => 'lid']); ?>
            <div class="row">
                <!-- Name or email search -->
                <div class="form-group col-4">
                    <label for="searchNameOrEmail">Zoek op naam of email:</label>
                    <input type="text" class="form-control" id="searchNameOrEmail"
                        aria-label="Zoek op naam of e-mail invoerveld" placeholder="Voer een naam of email in:">
                </div>
                <!-- Adress search -->
                <div class="form-group col-4">
                    <label for="searchAdress">Zoek op adres:</label>
                    <input type="text" class="form-control" id="searchAdress" name="searchAdress"
                        aria-label="Zoek op adres invoerveld" placeholder="Voor een adres in:">
                </div>
                <!-- Role filter -->
                <div class="form-group col-4">
                    <label for="searchRole">Zoek op rol:</label>
                    <select name="role" id="searchRole" class="form-control" multiple>
                        <option value="" selected disabled hidden>Selecteer een rol</option>
                        <?php foreach ($data['rolen'] as $rol) { ?>
                            <option value="<?= e($rol->id) ?>"><?= e($rol->name) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <!-- Phone search -->
                <div class="form-group col-6">
                    <label for="searchPhone">Zoek op telefoon nummer:</label>
                    <input type="tel" class="form-control" id="searchPhone" name="searchPhone"
                        aria-label="Zoek op telefoonnummer invoerveld" placeholder="Voer een telefoon nummer in:">
                </div>
                <!-- With or without soft deleted leden -->
                <div class="form-group col-3 d-flex align-items-end justify-content-end">
                    <div class="form-check form-switch float-right">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
                            aria-label="Met verwijderde leden checkbox" value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde leden</label>
                    </div>
                </div>
                <div class="form-group col-3 d-flex align-items-end justify-content-end">
                    <a href="/admin/leden/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>
            <table id="ledenTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Telefoon</th>
                        <th>Adres</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center">Loading…</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</div>
<script src="/JS/Admin/Leden/index.js"></script>
