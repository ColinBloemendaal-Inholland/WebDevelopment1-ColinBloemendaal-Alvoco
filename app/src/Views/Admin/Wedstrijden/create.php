
<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="h4 mb-4">Nieuwe Wedstrijd toevoegen</h2>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <?php \View::partial('Layout.errors'); ?>

                            <form method="POST">
                                <!-- Thuisteam -->
                                <div class="mb-3 row">
                                    <label for="hometeam" class="col-sm-3 col-form-label">Thuisteam</label>
                                    <div class="col-sm-9">
                                        <select name="team_home" id="hometeam" class="form-select" required>
                                            <option value="">Selecteer thuisteam</option>
                                            <?php foreach ($data['teams'] as $team): ?>
                                                <option value="<?= e($team['id']) ?>"
                                                <?= ($_SESSION['form_old']['team_home'] ?? '') == $team['id'] ? 'selected' : '' ?>>
                                                    <?= e($team->name) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Uitteam -->
                                <div class="mb-3 row">
                                    <label for="awayteam" class="col-sm-3 col-form-label">Uitteam</label>
                                    <div class="col-sm-9">
                                        <select name="team_away" id="awayteam" class="form-select" required>
                                            <option value="">Selecteer uitteam</option>
                                            <?php foreach ($data['teams'] as $team): ?>
                                                <option value="<?= e($team['id']) ?>"
                                                    <?= ($_SESSION['form_old']['team_away'] ?? '') == $team['id'] ? 'selected' : '' ?>>
                                                    <?= e($team['name']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Datum -->
                                <div class="mb-3 row">
                                    <label for="date" class="col-sm-3 col-form-label">Datum</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="date" name="date" value="<?= e($_SESSION['form_old']['date'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <!-- Tijd -->
                                <div class="mb-3 row">
                                    <label for="time" class="col-sm-3 col-form-label">Tijd</label>
                                    <div class="col-sm-9">
                                        <input type="time" class="form-control" id="time" name="time" value="<?= e($_SESSION['form_old']['time'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <!-- Locatie -->
                                <div class="mb-3 row">
                                    <label for="location" class="col-sm-3 col-form-label">Locatie</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="location" name="location" placeholder="Bijv. Sporthal Alvoco" value="<?= e($_SESSION['form_old']['location'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <!-- Scheidsrechter -->
                                <div class="mb-3 row">
                                    <label for="referee" class="col-sm-3 col-form-label">Scheidsrechter</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="referee" name="referee" placeholder="Naam scheidsrechter" value="<?= e($_SESSION['form_old']['referee'] ?? '') ?>">
                                    </div>
                                </div>

                                <div class="mb-3 row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Opslaan</button>
                                        <a href="/admin/wedstrijden" class="btn btn-secondary">Annuleren</a>
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
        new TomSelect("#hometeam", { plugins: ['remove_button'] });
        new TomSelect("#awayteam", { plugins: ['remove_button'] });
    });
</script>
