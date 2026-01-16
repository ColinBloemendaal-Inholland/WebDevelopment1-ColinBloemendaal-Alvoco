<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <header>
                        <h2 class="h4 mb-4">Bewerk Team</h2>
                    </header>
                    <article class="card shadow-sm">
                        <div class="card-body">
                            <?php \View::partial('Layout.errors'); ?>
                            <form method="POST" action="/admin/teams/<?= e($data['team']['id']) ?>" enctype="multipart/form-data">
                                <input type="hidden" name="_method" value="PUT">
                                <!-- Naam -->
                                <div class="mb-3 row">
                                    <label for="name" class="col-sm-3 col-form-label">Naam</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="name" name="name" aria-label="Teamnaam invoerveld"
                                               value="<?= e($_SESSION['form_old']['name'] ?? $data['team']['name']) ?>" required>
                                    </div>
                                </div>

                                <!-- Categorie -->
                                <div class="mb-3 row">
                                    <label for="Category" class="col-sm-3 col-form-label">Categorie</label>
                                    <div class="col-sm-9">
                                        <select class="form-select" id="Category" name="category" aria-label="Categorie selectievak">
                                            <option value="">Selecteer categorie</option>
                                            <?php foreach ($data['categories'] as $category): ?>
                                                <option value="<?= e($category) ?>" <?= (($_SESSION['form_old']['category'] ?? $data['team']['category']) === $category) ? 'selected' : '' ?>>
                                                    <?= e($category) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <!-- Klas -->
                                <div class="mb-3 row">
                                    <label for="class" class="col-sm-3 col-form-label">Klas</label>
                                    <div class="col-sm-9">
                                        <?php $selectedClass = $_SESSION['form_old']['class'] ?? $data['team']['class']; ?>
                                        <select class="form-select" id="class" name="class" aria-label="Klasse selectievak">
                                            <option value="">Selecteer klasse</option>
                                            <?php foreach ($data['classes'] as $class): ?>
                                                <option value="<?= e($class) ?>" <?= ($selectedClass === $class) ? 'selected' : '' ?>>
                                                    <?= e($class) ?>
                                                </option>
                                            <?php endforeach; ?>
                                            <option value="Overig" <?= ($selectedClass && !in_array($selectedClass, $data['classes'], true)) ? 'selected' : '' ?>>Overig</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- Seizoen -->
                                <div class="mb-3 row">
                                    <label for="season" class="col-sm-3 col-form-label">Seizoen</label>
                                    <div class="col-sm-9">
                                        <select name="seizoen_id" id="" class="form-select">
                                            <option value="">Selecteer seizoen</option>
                                            <?php foreach ($data['seizoenen'] as $season): ?>
                                                <option value="<?= e($season['id']) ?>"
                                                    <?= isset($_SESSION['form_old']['seizoen_id']) ? 
                                                    ($_SESSION['form_old']['seizoen_id'] == $season['id'] ? 'selected' : '') : 
                                                    ((!empty($season['is_current']) && $season['is_current']) ? 'selected' : '') ?>>
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
                                            <?php foreach ($data['spelers'] as $speler): ?>
                                                <option value="<?= e($speler['id']) ?>"
                                                    <?= in_array(
                                                        $speler['id'],
                                                        $_SESSION['form_old']['spelers'] ?? $data['team']['spelers']->pluck('id')->toArray()
                                                    ) ? 'selected' : '' ?>>
                                                    <?= e($speler['lid']['fullname'] ?? 'Onbekend') ?>
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
                                                    <?= e($coach['lid']['fullname'] ?? 'Onbekend') ?>
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
                                                    <?= e($trainer['lid']['fullname'] ?? 'Onbekend') ?>
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
        </section>
    </main>
</div>

<script src="/JS/Admin/Teams/edit.js"></script>
