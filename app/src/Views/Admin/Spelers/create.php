<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="h4 mb-4">Nieuwe Speler toevoegen</h2>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <?php \View::Partial('Layout.errors'); ?>

                            <form method="POST">
                                <!-- Lid select -->
                                <div class="mb-3 row">
                                    <label for="Leden_id" class="col-sm-3 col-form-label">Lid</label>
                                    <div class="col-sm-9">
                                        <select name="Leden_id" id="Leden_id" class="form-select" required>
                                            <option value="">Selecteer een lid</option>
                                            <?php foreach ($data['leden'] as $lid): ?>
                                                <option value="<?= e($lid['id']) ?>"
                                                    <?= (isset($_SESSION['form_old']['Leden_id']) && $_SESSION['form_old']['Leden_id'] == $lid['id']) ? 'selected' : '' ?>>
                                                    <?= e($lid['fullname']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Nummer -->
                                <div class="mb-3 row">
                                    <label for="number" class="col-sm-3 col-form-label">Nummer</label>
                                    <div class="col-sm-9">
                                        <input type="number" class="form-control" id="number" name="number"
                                               value="<?= e($_SESSION['form_old']['number'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <!-- Positie -->
                                <div class="mb-3 row">
                                    <label for="position" class="col-sm-3 col-form-label">Positie</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="position" name="position"
                                               value="<?= e($_SESSION['form_old']['position'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <!-- Team select -->
                                <div class="mb-3 row">
                                    <label for="team_id" class="col-sm-3 col-form-label">Team</label>
                                    <div class="col-sm-9">
                                        <select name="team_id" id="team_id" class="form-select" required>
                                            <option value="">Selecteer een team</option>
                                            <?php foreach ($data['teams'] as $team): ?>
                                                <option value="<?= e($team['id']) ?>"
                                                    <?= (isset($_SESSION['form_old']['team_id']) && $_SESSION['form_old']['team_id'] == $team['id']) ? 'selected' : '' ?>>
                                                    <?= e($team['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <!-- Submit -->
                                <div class="mb-3 row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Opslaan</button>
                                        <a href="/admin/spelers" class="btn btn-secondary">Annuleren</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function () {
        new TomSelect("#Leden_id", { create: false, sortField: { field: "text", direction: "asc" } });
        new TomSelect("#team_id", { create: false, sortField: { field: "text", direction: "asc" } });
    });
</script>
