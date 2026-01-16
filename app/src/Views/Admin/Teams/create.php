<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <header>
                        <h2 class="h4 mb-4">Nieuw Team toevoegen</h2>
                    </header>
                    <article class="card shadow-sm">
                        <div class="card-body">
                            <?php \View::partial('Layout.errors'); ?>
                            <form method="POST" enctype="multipart/form-data">
                                <!-- Naam -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Naam</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" placeholder="Bijv. Heren 1" aria-label="Teamnaam invoerveld"
                                               value="<?= e($_SESSION['form_old']['name'] ?? '') ?>" required>
                                    </div>
                                </div>

                                <!-- Categorie -->
                                <div class="mb-3 row">
                                    <label for="Category" class="col-sm-3 col-form-label">Categorie</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Category" name="category" placeholder="Bijv. Heren" aria-label="Categorie invoerveld"
                                               value="<?= e($_SESSION['form_old']['category'] ?? '') ?>">
                                    </div>
                                </div>

                                <!-- Klasse -->
                                <div class="mb-3 row">
                                    <label for="class" class="col-sm-3 col-form-label">Klasse</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="class" name="class" placeholder="Bijv. 2de klasse" aria-label="Klasse invoerveld"
                                               value="<?= e($_SESSION['form_old']['class'] ?? '') ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="season" class="col-sm-3 col-form-label">Seizoen</label>
                                    <div class="col-sm-9">
                                        <select name="seizoen_id" id="" class="form-select">
                                            <option value="">Selecteer seizoen</option>
                                            <?php foreach ($data['seizoenen'] as $season): ?>
                                                <option value="<?= e($season['id']) ?>"
                                                    <?= isset($_SESSION['form_old']['seizoen_id']) ? ($_SESSION['form_old']['seizoen_id'] == $season['id'] ? 'selected' : '') : ((!empty($season['is_current']) && $season['is_current']) ? 'selected' : '') ?>>
                                                    <?= e($season['title']) ?><?= !empty($season['is_current']) ? ' (Huidig)' : '' ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <hr>
                                <!-- Teamfoto upload -->
                                <div class="mb-3 row">
                                    <label for="team_picture" class="col-sm-3 col-form-label">Teamfoto</label>
                                    <div class="col-sm-9">
                                        <input type="file" class="form-control" id="team_picture" name="picture" accept="image/*">
                                    </div>
                                </div>

                                <!-- Spelers -->
                                <div class="mb-3 row">
                                    <label for="spelers" class="col-sm-3 col-form-label">Spelers</label>
                                    <div class="col-sm-9">
                                        <select name="spelers[]" id="spelers" class="form-select" multiple>
                                            <option value="">Selecteer meerdere spelers</option>
                                            <?php foreach ($data['spelers'] as $speler): ?>
                                                <option value="<?= e($speler['id']) ?>"
                                                    <?= in_array($speler['id'], $_SESSION['form_old']['spelers'] ?? []) ? 'selected' : '' ?>>
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
                                            <option value="">Selecteer coach(es)</option>
                                            <?php foreach ($data['coaches'] as $coach): ?>
                                                <option value="<?= e($coach['id']) ?>"
                                                    <?= in_array($coach['id'], $_SESSION['form_old']['coaches'] ?? []) ? 'selected' : '' ?>>
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
                                            <option value="">Selecteer trainer(s)</option>
                                            <?php foreach ($data['trainers'] as $trainer): ?>
                                                <option value="<?= e($trainer['id']) ?>"
                                                    <?= in_array($trainer['id'], $_SESSION['form_old']['trainers'] ?? []) ? 'selected' : '' ?>>
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
                    </article>
                </div>
            </div>
        </div>
    </div>
                    </article>
                </div>
            </div>
        </section>
    </main>

<script src="/JS/Admin/Teams/create.js"></script>
