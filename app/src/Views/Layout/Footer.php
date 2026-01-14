<footer class="bg-dark text-light pt-5 pb-3 border-top shadow-sm mt-auto">
    <div class="container">
        <div class="row align-items-center">
            <section class="col-md-4 mb-4 mb-md-0">
                <h5 class="fw-bold text-uppercase mb-3">Alvoco</h5>
                <p class="small mb-2">Volleybalvereniging Alvoco<br>
                Sportlaan 1, 1234 AB Alvostad<br>
                info@alvoco.nl<br>
                KvK: 12345678</p>
            </section>
            <section class="col-md-4 mb-4 mb-md-0">
                <h6 class="fw-bold mb-3">Navigatie</h6>
                <nav aria-label="Footer navigation">
                    <ul class="list-unstyled">
                        <li><a href="/" class="text-light text-decoration-none">Home</a></li>
                        <li><a href="/teams" class="text-light text-decoration-none">Teams</a></li>
                        <li><a href="/wedstrijden" class="text-light text-decoration-none">Wedstrijden</a></li>
                        <li><a href="/nieuwsberichten" class="text-light text-decoration-none">Nieuwsberichten</a></li>
                        <li><a href="/contact" class="text-light text-decoration-none">Contact</a></li>
                    </ul>
                </nav>
            </section>
            <section class="col-md-4 text-md-end">
                <h6 class="fw-bold mb-3">Volg ons</h6>
                <a href="#" class="text-light me-3 fs-5"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-light me-3 fs-5"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-light fs-5"><i class="bi bi-twitter-x"></i></a>
                <div class="mt-3">
                    <span class="small">&copy; <?= date('Y') ?> Alvoco. Alle rechten voorbehouden.</span>
                </div>
            </section>
        </div>
    </div>
</footer>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<?php
    unset($_SESSION["form_errors"], $_SESSION["form_old"]);
?>
</body>
</html>
