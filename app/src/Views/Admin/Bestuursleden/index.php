<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container m-0 py-5">
            <?php \View::partial('Partials.DeleteModal', ['type' => 'bestuurslid']); ?>
            <?php \View::partial('Partials.ForceDeleteModal', ['type' => 'bestuurslid']); ?>
            <header>
                <h1 class="mb-4">Bestuursleden</h1>
            </header>
            <div class="row mb-3">
                <!-- Name  search -->
                <div class="form-group col-4">
                    <label for="searchName">Zoek op naam:</label>
                    <input type="text" class="form-control" id="searchName" aria-label="Zoek op naam invoerveld"
                        placeholder="Voer een naam in:">
                </div>
                <!-- Adress search -->
                <div class="form-group col-4">
                    <label for="searchRole">Zoek op rol:</label>
                    <input type="text" class="form-control" id="searchRole" name="searchRole"
                        aria-label="Zoek op rol invoerveld" placeholder="Voer een rol in:">
                </div>
                <div class="form-group col-md-2 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
                            value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde</label>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end justify-content-end">
                    <a href="/admin/bestuursleden/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>

            <table id="bestuursledenTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Rol</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3" class="text-center">Loading…</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</div>
<script src="/JS/Admin/Bestuursleden/index.js"></script>
