<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <header>
                        <h2 class="h4 mb-4">Contact bewerken</h2>
                    </header>
                    <article class="card shadow-sm">
                        <div class="card-body">
                            <?php \View::partial('Layout.errors'); ?>
                            <form method="POST" action="/admin/contact/<?= $data['contact']['id'] ?>">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="mb-3 row">
                                    <label for="naam" class="col-sm-3 col-form-label">Naam</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="naam" name="naam" value="<?= e($_SESSION['form_old']['naam'] ?? $data['contact']['naam']) ?>" required aria-label="Naam invoerveld">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="email" class="col-sm-3 col-form-label">Email</label>
                                    <div class="col-sm-9">
                                        <input type="email" class="form-control" id="email" name="email" value="<?= e($_SESSION['form_old']['email'] ?? $data['contact']['email']) ?>" required aria-label="E-mail invoerveld">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="bericht" class="col-sm-3 col-form-label">Bericht</label>
                                    <div class="col-sm-9">
                                        <textarea class="form-control" id="bericht" name="bericht" required aria-label="Bericht invoerveld"><?= e($_SESSION['form_old']['bericht'] ?? $data['contact']['bericht']) ?></textarea>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="bestuurslid_id" class="col-sm-3 col-form-label">Bestuurslid</label>
                                    <div class="col-sm-9">
                                        <select name="bestuurslid_id" id="bestuurslid_id" class="form-select" required>
                                            <option value="">Selecteer een bestuurslid</option>
                                            <?php foreach ($data['bestuursleden'] as $lid): ?>
                                                <option value="<?= e($lid['id']) ?>" <?= (isset($_SESSION['form_old']['bestuurslid_id']) && $_SESSION['form_old']['bestuurslid_id'] == $lid['id']) ? 'selected' : ($data['contact']['bestuurslid_id'] == $lid['id'] ? 'selected' : '') ?>>
                                                    <?= e($lid['fullname']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <hr>
                                <div class="mb-3 row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Opslaan</button>
                                        <a href="/admin/contact/<?= e($data['contact']['id']) ?>" class="btn btn-secondary">Annuleren</a>
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
        new TomSelect("#bestuurslid_id", { create: false, sortField: { field: "text", direction: "asc" } });
    });
</script>
