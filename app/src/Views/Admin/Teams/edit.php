<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <h2 class="h4 mb-4">Bewerk Team</h2>

                    <div class="card shadow-sm">
                        <div class="card-body">
                            <?php \View::Partial('Layout.errors'); ?>

                            <form method="POST" action="/admin/teams/<?= e($data['team']['id']) ?>">
                                <input type="hidden" name="_method" value="PUT">
                                <!-- Naam -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Naam</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="<?= e($_SESSION['form_old']['name'] ?? $data['team']['name']) ?>" required>
                                    </div>
                                </div>

                                <!-- Categorie -->
                                <div class="mb-3 row">
                                    <label for="Category" class="col-sm-3 col-form-label">Categorie</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Category" name="category"
                                               value="<?= e($_SESSION['form_old']['Category'] ?? $data['team']['Category']) ?>">
                                    </div>
                                </div>

                                <!-- Klas -->
                                <div class="mb-3 row">
                                    <label for="class" class="col-sm-3 col-form-label">Klas</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="class" name="class"
                                               value="<?= e($_SESSION['form_old']['class'] ?? $data['team']['class']) ?>">
                                    </div>
                                </div>

                                <hr>

                                <!-- Spelers -->
                                <div class="mb-3 row">
                                    <label for="spelers" class="col-sm-3 col-form-label">Spelers</label>
                                    <div class="col-sm-9">
                                        <select name="spelers[]" id="spelers" class="form-select" multiple>
                                            <?php foreach ($data['spelers'] as $speler): ?>
                                                <option value="<?= e($speler['id']) ?>"
                                                    <?= in_array(
                                                        $speler['id'],
                                                        $_SESSION['form_old']['spelers'] ?? $data['team']['spelers']->pluck('id')->toArray()
                                                    ) ? 'selected' : '' ?>>
                                                    <?= e($speler['lid']['fullname']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Coaches -->
                                <div class="mb-3 row">
                                    <label for="coaches" class="col-sm-3 col-form-label">Coaches</label>
                                    <div class="col-sm-9">
                                        <select name="coaches[]" id="coaches" class="form-select" multiple>
                                            <?php foreach ($data['coaches'] as $coach): ?>
                                                <option value="<?= e($coach['id']) ?>"
                                                    <?= in_array(
                                                        $coach['id'],
                                                        $_SESSION['form_old']['coaches'] ?? $data['team']['coaches']->pluck('id')->toArray()
                                                    ) ? 'selected' : '' ?>>
                                                    <?= e($coach['lid']['fullname']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Trainers -->
                                <div class="mb-3 row">
                                    <label for="trainers" class="col-sm-3 col-form-label">Trainers</label>
                                    <div class="col-sm-9">
                                        <select name="trainers[]" id="trainers" class="form-select" multiple>
                                            <?php foreach ($data['trainers'] as $trainer): ?>
                                                <option value="<?= e($trainer['id']) ?>"
                                                    <?= in_array(
                                                        $trainer['id'],
                                                        $_SESSION['form_old']['trainers'] ?? $data['team']['trainers']->pluck('id')->toArray()
                                                    ) ? 'selected' : '' ?>>
                                                    <?= e($trainer['lid']['fullname']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <hr>

                                <div class="mb-3 row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Opslaan</button>
                                        <a href="/admin/teams" class="btn btn-secondary">Annuleren</a>
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
        new TomSelect("#spelers", { plugins: ['remove_button'] });
        new TomSelect("#coaches", { plugins: ['remove_button'] });
        new TomSelect("#trainers", { plugins: ['remove_button'] });
    });
</script>
