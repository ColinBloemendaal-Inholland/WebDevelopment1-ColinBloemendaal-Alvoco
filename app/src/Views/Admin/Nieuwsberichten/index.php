<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container m-0">
            <?php \View::partial('Partials.DeleteModal', ['type' => 'nieuwsbericht']); ?>
            <?php \View::partial('Partials.ForceDeleteModal', ['type' => 'nieuwsbericht']); ?>
            <header>
                <h1 class="mb-4">Nieuwsberichten</h1>
            </header>
            <div class="row">
                <!-- Name of authur search -->
                <div class="form-group col-4">
                    <label for="searchAuthur">Zoek op authur</label>
                    <input type="text" class="form-control" id="searchAuthur" placeholder="Voer een naam in"
                        aria-label="Zoek op auteur invoerveld">
                </div>
                <!-- Title search -->
                <div class="form-group col-4">
                    <label for="searchTitle">Zoek op titel:</label>
                    <input type="text" class="form-control" id="searchTitle" name="searchTitle"
                        placeholder="Voor een titel in:" aria-label="Zoek op titel invoerveld">
                </div>
            </div>
            <div class="row">
                <!-- From date search -->
                <div class="form-group col-3">
                    <label for="searchFrom">Vanaf:</label>
                    <input type="date" class="form-control" id="searchFrom" name="searchFrom"
                        aria-label="Zoek vanaf datum invoerveld">
                </div>
                <!-- Till date search -->
                <div class="form-group col-3">
                    <label for="searchTill">Tot:</label>
                    <input type="date" class="form-control" id="searchTill" name="searchTill"
                        aria-label="Zoek tot datum invoerveld">
                </div>
                <!-- With or without soft deleted leden -->
                <div class="form-group col-3 d-flex align-items-end justify-content-end">
                    <div class="form-check form-switch float-right">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
                            value="1" aria-label="Met verwijderde nieuwsberichten checkbox">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde nieuwsberichten</label>
                    </div>
                </div>
                <div class="form-group col-3 d-flex align-items-end justify-content-end">
                    <a href="/admin/nieuwsberichten/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>
            <table id="nieuwsberichtenTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Titel</th>
                        <th>Authur</th>
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
<script src="/JS/Admin/Nieuwsberichten/index.js"></script>