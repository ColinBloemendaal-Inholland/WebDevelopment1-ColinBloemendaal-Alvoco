<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container m-0">
                        <?php \View::partial('Partials.DeleteModal', ['type' => 'speler']); ?>
                        <?php \View::partial('Partials.ForceDeleteModal', ['type' => 'speler']); ?>
            <header>
                <h1 class="mb-4">Spelers</h1>
            </header>
            <div class="row">
                <!-- Name or email search -->
                <div class="form-group col-3">
                    <label for="searchName">Zoek op naam:</label>
                    <input type="text" class="form-control" id="searchName" name="searchName"
                        aria-label="Zoek op naam invoerveld" placeholder="Voer een naam in:">
                </div>
                <div class="form-group col-3">
                    <label for="searchTeam">Zoek op team:</label>
                    <select name="team" id="searchTeam" class="form-control" multiple>
                        <option value="" selected disabled hidden>Selecteer een team</option>
                        <?php foreach ($data['teams'] as $team) { ?>
                            <option value="<?= e($team->id) ?>"><?= e($team->name) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-3 d-flex align-items-end justify-content-end">
                    <a href="/admin/spelers/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>
            <table id="spelersTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Team</th>
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

<script src="/JS/Admin/Spelers/index.js"></script>
