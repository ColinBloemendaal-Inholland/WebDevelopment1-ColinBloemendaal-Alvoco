<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">
                        Bestuurslid aanmaken
                    </h2>
                    <?php \View::Partial('Layout.errors'); ?>
                    <form method="POST" action="/admin/bestuursleden/store" autocomplete="off">
                        <!-- Lid selectie -->
                        <h5 class="mb-3">Lid gegevens</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-12 col-md-6">
                                <label for="Leden_id" class="form-label">Selecteer Lid</label>
                                <select name="Leden_id" id="Leden_id" class="form-select" required>
                                    <option value="" disabled selected hidden>Kies een lid</option>
                                    <?php foreach ($data['leden'] as $lid): ?>
                                        <option value="<?= $lid['id'] ?>">
                                            <?= e($lid['fullname']) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="role" class="form-label">Rol</label>
                                <input type="text" id="role" name="role" class="form-control"
                                    placeholder="Bijv. Voorzitter, Secretaris" required>
                            </div>
                        </div>
                        <!-- Periode -->
                        <h5 class="mb-3">Periode</h5>
                        <div class="row g-3 mb-4">
                            <div class="col-sm-12 col-md-6">
                                <label for="start_date" class="form-label">Startdatum</label>
                                <input type="date" id="start_date" name="start_date" class="form-control" required>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <label for="end_date" class="form-label">Einddatum</label>
                                <input type="date" id="end_date" name="end_date" class="form-control">
                                <div class="form-text">
                                    Laat leeg indien nog actief
                                </div>
                            </div>
                        </div>
                        <!-- Acties -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                Opslaan
                            </button>
                            <a href="/admin/bestuursleden" class="btn btn-outline-secondary btn-lg ms-2">
                                Annuleren
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
