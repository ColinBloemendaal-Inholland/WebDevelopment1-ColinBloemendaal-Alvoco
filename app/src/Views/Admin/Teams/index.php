<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container m-0">
                        <?php \View::partial('Partials.DeleteModal', ['type' => 'team']); ?>
                        <?php \View::partial('Partials.ForceDeleteModal', ['type' => 'team']); ?>
            <header>
                <h1 class="mb-4">Teams</h1>
            </header>
            <div class="row pb-3">
                <!-- Name search -->
                <div class="form-group col-3">
                    <label for="searchName">Zoek op naam:</label>
                    <input type="text" class="form-control" id="searchName" name="searchName"
                        aria-label="Zoek op teamnaam invoerveld" placeholder="Voer een naam in:">
                </div>
                <div class="form-group col-3">
                    <label for="searchSeizoen">Zoek op seizoen:</label>
                    <select name="seizoen" id="searchSeizoen" class="form-select">
                        <option value="" selected>Selecteer een seizoen</option>
                        <?php foreach ($data['seizoenen'] as $seizoen): ?>
                            <option value="<?= e($seizoen['id']) ?>" <?= $seizoen['is_current'] ? 'selected' : '' ?>>
                                <?= e($seizoen['title']) ?>     <?= !empty($seizoen['is_current']) ? ' (Huidig)' : '' ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group col-3 d-flex align-items-end">
                    <div class="form-check form-switch float-right">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
                            aria-label="Met verwijderde teams checkbox" value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde teams</label>
                    </div>
                </div>
                <div class="form-group col-3 d-flex align-items-end justify-content-end">
                    <a href="/admin/teams/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>
            <table id="teamsTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Klasse</th>
                        <th>Seizoen</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center">Loading…</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script src="/JS/Admin/Teams/index.js"></script>
