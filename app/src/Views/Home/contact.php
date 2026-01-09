<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 text-center">
            <h1 class="display-4 fw-bold">Contact</h1>
            <p class="lead">Neem contact op met een bestuurslid via onderstaand formulier.</p>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-lg-7 col-md-9">
            <div class="card shadow-sm border-0">
                <div class="card-body p-4">
                    <h2 class="h4 mb-4">Contactformulier</h2>
                    <?php \View::Partial('Layout.errors'); ?>
                    <?php if(isset($_GET['success'])): ?>
                        <div class="alert alert-success">Bericht succesvol verzonden!</div>
                    <?php endif; ?>
                    <form method="POST" action="/contact">
                        <div class="mb-3">
                            <label for="naam" class="form-label">Naam</label>
                            <input type="text" name="naam" id="naam" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="bestuurslid_id" class="form-label">Bestuurslid</label>
                            <select name="bestuurslid_id" id="bestuurslid_id" class="form-select" required>
                                <option value="">Kies een bestuurslid</option>
                                <?php foreach($data['bestuursleden'] as $bestuurslid): ?>
                                    <option value="<?= $bestuurslid->id ?>">
                                        <?= e($bestuurslid->lid->fullname . ' - ' . $bestuurslid->role) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="bericht" class="form-label">Bericht</label>
                            <textarea name="bericht" id="bericht" class="form-control" rows="5" required></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Verstuur</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
