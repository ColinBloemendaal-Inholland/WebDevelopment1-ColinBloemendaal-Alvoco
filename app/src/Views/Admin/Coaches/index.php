<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container m-0">
                        <?php \View::partial('Partials.DeleteModal', ['type' => 'coach']); ?>
                        <?php \View::partial('Partials.ForceDeleteModal', ['type' => 'coach']); ?>
            <header>
                <h1 class="mb-4">Coaches</h1>
            </header>
            <div class="row">
                <!-- Name search -->
                <div class="form-group col-3">
                    <label for="searchName">Zoek op naam:</label>
                    <input type="text" class="form-control" id="searchName" name="searchName"
                        aria-label="Zoek op naam invoerveld" placeholder="Voer een naam in:">
                </div>
                <div class="form-group col-3">
                    <label for="searchRole">Zoek op rol:</label>
                    <input type="text" class="form-control" id="searchRole" name="searchRole"
                        aria-label="Zoek op rol invoerveld" placeholder="Voer een rol in:">
                </div>
                <div class="form-group col-3 d-flex align-items-end">
                    <div class="form-check form-switch float-right">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
                            aria-label="Met verwijderde coaches checkbox" value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde coaches</label>
                    </div>
                </div>

                <div class="form-group col-3 d-flex align-items-end justify-content-end">
                    <a href="/admin/coaches/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>
            <table id="coachesTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Rol</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" class="text-center">Loading…</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</div>
<script src="/JS/Admin/Coaches/index.js"></script>
