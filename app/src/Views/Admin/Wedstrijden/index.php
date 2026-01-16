<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container m-0">
                        <?php \View::partial('Partials.DeleteModal', ['type' => 'wedstrijd']); ?>
                        <?php \View::partial('Partials.ForceDeleteModal', ['type' => 'wedstrijd']); ?>
            <header>
                <h1 class="mb-4">Wedstrijden</h1>
            </header>
            <div class="row">
                <!-- Home team select -->
                <div class="form-group col-4">
                    <label for="searchHomeTeam">Zoek op thuisteam:</label>
                    <select name="homeTeam" id="searchHomeTeam" class="form-control" multiple>
                        <option value="" selected disabled hidden>Selecteer een team</option>
                        <?php foreach ($data['teams'] as $team) { ?>
                            <option value="<?= e($team->id) ?>"><?= e($team->name) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- Away team select -->
                <div class="form-group col-4">
                    <label for="searchAwayTeam">Zoek op uitteam:</label>
                    <select name="awayTeam" id="searchAwayTeam" class="form-control" multiple>
                        <option value="" selected disabled hidden>Selecteer een team</option>
                        <?php foreach ($data['teams'] as $team) { ?>
                            <option value="<?= e($team->id) ?>"><?= e($team->name) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- Score search -->
                <div class="form-group col-2">
                    <label for="searchScore">Zoek op score</label>
                    <input type="text" name="searchScore" class="form-control" id="searchScore"
                        placeholder="Bijv. 3 - 2" aria-label="Zoek op score invoerveld">
                </div>
            </div>
            <div class="row py-3">
                <div class="form-group col-9 d-flex align-items-end">
                    <div class="form-check form-switch float-right">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
                            aria-label="Met verwijderde wedstrijden checkbox" value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde wedstrijden</label>
                    </div>
                </div>
                <div class="form-group col-3 d-flex align-items-end justify-content-end">
                    <a href="/admin/wedstrijden/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>
            <table id="wedstrijdenTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Thuis</th>
                        <th>Uit</th>
                        <th>Datum</th>
                        <th>Tijd</th>
                        <th>Locatie</th>
                        <th>Score</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="7" class="text-center">Loading…</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</div>
<script src="/JS/Admin/Wedstrijden/index.js"></script>
