<div class="container" style="min-height: 80vh;">
    <div class="row justify-content-center align-items-start mt-5">
        <div class="col-12 text-center mb-3">
            <h3 class="fw-bold">Welkom terug</h3>
        </div>

        <div class="col-12 col-md-8 col-lg-6">
            <div class="card shadow-sm w-100" style="border-radius: .75rem; overflow: hidden;">
                <div class="card-body p-4 p-md-5 bg-white">
                    <!-- shared form errors partial -->
                    <?php \View::Partial('Layout.errors'); ?>

                    <form method="post" action="/login" novalidate>
                        <div class="row g-2">
                            <div class="col-12 col-md-6">
                                <label for="email" class="form-label small">E-mailadres</label>
                                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="je@voorbeeld.nl" required autofocus>
                            </div>
                            <div class="col-12 col-md-6">
                                <label for="password" class="form-label small">Wachtwoord</label>
                                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Wachtwoord" required>
                            </div>
                        </div>

                        <div class="d-flex align-items-center justify-content-between mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" id="remember" name="remember">
                                <label class="form-check-label small" for="remember">Onthouden</label>
                            </div>
                            <a href="#" class="small text-decoration-none">Wachtwoord vergeten?</a>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary btn-lg w-100">Inloggen</button>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <p class="small text-muted mb-2">Nog geen account?</p>
                        <a href="/" class="btn btn-outline-secondary btn-sm">Terug naar home</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    body { background: #f4f6f8; }
    .card { border: none; }
</style>
