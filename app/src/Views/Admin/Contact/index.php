<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container m-0">
                        <?php \View::partial('Partials.DeleteModal', ['type' => 'contact']); ?>
                        <?php \View::partial('Partials.ForceDeleteModal', ['type' => 'contact']); ?>
            <header>
                <h1 class="mb-4">Contacten</h1>
            </header>
            <div class="row pb-3">
                <div class="form-group col-3">
                    <label for="searchNaam">Zoek op naam:</label>
                    <input type="text" class="form-control" id="searchNaam" name="searchNaam"
                        aria-label="Zoek op naam invoerveld" placeholder="Voer een naam in:">
                </div>
                <div class="form-group col-3">
                    <label for="searchEmail">Zoek op email:</label>
                    <input type="text" class="form-control" id="searchEmail" name="searchEmail"
                        aria-label="Zoek op e-mail invoerveld" placeholder="Voer een email in:">
                </div>
                <div class="form-group col-3">
                    <label for="searchBestuurslid">Filter op bestuurslid:</label>
                    <select id="searchBestuurslid" name="bestuurslid_id" class="form-select">
                        <option value="" selected disabled hidden>Alle bestuursleden</option>
                        <?php if (!empty($data['bestuursleden'])): ?>
                            <?php foreach ($data['bestuursleden'] as $bestuurslid): ?>
                                <option value="<?= e($bestuurslid['id']) ?>"><?= e($bestuurslid['lid']['fullname']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group col-3 d-flex align-items-end">
                    <div class="form-check form-switch float-right">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
                            aria-label="Met verwijderde contacten checkbox" value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde contacten</label>
                    </div>
                </div>
            </div>
            <table id="contactTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Bestuurslid</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center">Loading…</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</div>
<script src="/JS/Admin/Contact/index.js"></script>
