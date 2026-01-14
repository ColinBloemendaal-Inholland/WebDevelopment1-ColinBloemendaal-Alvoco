<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container-fluid m-0 py-5">
            <div class="row">
                <div class="col-12">
                    <header>
                        <h2 class="h4 mb-4">Bewerk Bestuurslid</h2>
                    </header>
                    <article class="card shadow-sm">
                        <div class="card-body">
                            <?php \View::partial('Layout.errors'); ?>
                            <form method="POST" action="/admin/bestuursleden/<?= $data['bestuurslid']['id'] ?>">
                                <input type="hidden" name="_method" value="PUT">
                                <div class="mb-3 row">
                                    <label for="Leden_id" class="col-sm-3 col-form-label">Lid</label>
                                    <div class="col-sm-9">
                                        <select name="Leden_id" id="Leden_id" class="form-select" required>
                                            <option value="">Selecteer een lid</option>
                                            <?php foreach ($data['leden'] as $lid): ?>
                                                <option value="<?= e($lid['id']) ?>"
                                                    <?= (isset($_SESSION['form_old']['Leden_id']) && $_SESSION['form_old']['Leden_id'] == $lid['id'])
                                                        ? 'selected'
                                                        : ($data['bestuurslid']['Leden_id'] == $lid['id'] ? 'selected' : '') ?>>
                                                    <?= e($lid['fullname']) ?>
                                                </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="role" class="col-sm-3 col-form-label">Rol</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" id="role" name="role" aria-label="Rol invoerveld"
                                               value="<?= e($_SESSION['form_old']['role'] ?? $data['bestuurslid']['role']) ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="start_date" class="col-sm-3 col-form-label">Start Datum</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="start_date" name="start_date" aria-label="Startdatum invoerveld"
                                               value="<?= e($_SESSION['form_old']['start_date'] ?? $data['bestuurslid']['start_date']) ?>" required>
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <label for="end_date" class="col-sm-3 col-form-label">Eind Datum</label>
                                    <div class="col-sm-9">
                                        <input type="date" class="form-control" id="end_date" name="end_date" aria-label="Einddatum invoerveld"
                                               value="<?= e($_SESSION['form_old']['end_date'] ?? $data['bestuurslid']['end_date']) ?>">
                                    </div>
                                </div>
                                <div class="mb-3 row">
                                    <div class="col-sm-9 offset-sm-3">
                                        <button type="submit" class="btn btn-primary">Opslaan</button>
                                        <a href="/admin/bestuursleden" class="btn btn-secondary">Annuleren</a>
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
    $(function() {
        new TomSelect("#Leden_id", {
            create: false,
            sortField: { field: "text", direction: "asc" }
        });
    });
</script>
