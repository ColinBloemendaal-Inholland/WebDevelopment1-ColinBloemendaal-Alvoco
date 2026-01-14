<script>
    tinymce.init({
        selector: '#mytextarea'
    });
</script>

<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <header>
                        <h2 class="h4 mb-4">Bewerk Nieuwsbericht</h2>
                    </header>
                    <article class="card shadow-sm">
                        <div class="card-body">
                            <?php \View::partial('Layout.errors'); ?>
                            <form method="POST" action="/admin/nieuwsberichten/<?= $data['nieuwsbericht']['id'] ?>">
                                <!-- Simulate PUT method -->
                                <input type="hidden" name="_method" value="PUT">

                                <!-- Titel -->
                                <div class="mb-3 row">
                                    <label for="Title" class="col-sm-3 col-form-label">Titel</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="Title" name="Title"
                                            value="<?= e($_SESSION['form_old']['Title'] ?? $data['nieuwsbericht']['Title']) ?>"
                                            required aria-label="Titel invoerveld">
                                    </div>
                                </div>

                                <!-- Message (WYSIWYG) -->
                                <div class="mb-3 row">
                                    <label for="Message" class="col-sm-3 col-form-label">Bericht</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="Message" name="Message" rows="8"
                                            required aria-label="Bericht invoerveld"><?= htmlspecialchars_decode($_SESSION['form_old']['Message'] ?? $data['nieuwsbericht']['Message']) ?></textarea>
                                    </div>
                                </div>

                                <!-- Auteur select -->
                                <div class="mb-3 row">
                                    <label for="Bestuursleden_id" class="col-sm-3 col-form-label">Auteur</label>
                                    <div class="col-sm-9">
                                        <select name="Bestuursleden_id" id="Bestuursleden_id" class="form-select"
                                            required>
                                            <option value="">Selecteer een auteur</option>
                                            <?php foreach ($data['bestuursleden'] as $bestuurslid): ?>
                                                <option value="<?= e($bestuurslid['id']) ?>"
                                                    <?= (isset($_SESSION['form_old']['Bestuursleden_id']) && $_SESSION['form_old']['Bestuursleden_id'] == $bestuurslid['id'])
                                                        ? 'selected'
                                                        : ($data['nieuwsbericht']['Bestuursleden_id'] == $bestuurslid['id'] ? 'selected' : '') ?>>
                                                    <?= e($bestuurslid['lid']['fullname']) ?>
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
                                        <a href="/admin/nieuwsberichten" class="btn btn-secondary">Annuleren</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </article>
                </div>
            </div>
        </section>
    </main>

<script>
    $(function () {
        new TomSelect("#Bestuursleden_id", { create: false, sortField: { field: "text", direction: "asc" } });
    });
</script>
