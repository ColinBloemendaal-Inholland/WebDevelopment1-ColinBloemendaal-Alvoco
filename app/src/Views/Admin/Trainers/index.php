<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container m-0">
                            <?php \View::partial('Partials.DeleteModal', ['type' => 'trainer']); ?>
                            <?php \View::partial('Partials.ForceDeleteModal', ['type' => 'trainer']); ?>
            <header>
                <h1 class="mb-4">Trainers</h1>
            </header>
            <div class="row">
                <!-- Name or email search -->
                <div class="form-group col-3">
                    <label for="searchName">Zoek op naam:</label>
                    <input type="text" class="form-control" id="searchName" name="searchName"
                        placeholder="Voer een naam in:" aria-label="Zoek op naam invoerveld">
                </div>
                <div class="form-group col-3">
                    <label for="searchRole">Zoek op rol:</label>
                    <input type="text" class="form-control" id="searchRole" name="searchRole"
                        placeholder="Voer een rol in:" aria-label="Zoek op rol invoerveld">
                </div>
                <div class="form-group col-3 d-flex align-items-end">
                    <div class="form-check form-switch float-right">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
                            aria-label="Met verwijderde trainers checkbox" value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde trainers</label>
                    </div>
                </div>
                <div class="form-group col-3 d-flex align-items-end justify-content-end">
                    <a href="/admin/trainers/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>
            <table id="trainersTable" class="table table-striped table-hover">
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

<script src="/JS/Admin/Trainers/index.js"></script>
