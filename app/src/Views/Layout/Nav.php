<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/">Alvoco</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample07"
            aria-controls="navbarsExample07" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarsExample07">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/teams">Teams</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/wedstrijden">Wedstrijden</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/nieuwsberichten">Nieuwsberichten</a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                <?php if (\Auth::isLoggedIn()): ?>
                    <!-- User is logged in -->
                    <li class="nav-item dropdown">
                        <button class="nav-link dropdown-toggle" id="userDropdown" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="bi bi-person-circle"></i> <?= htmlspecialchars(\Auth::email()); ?>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="/admin">
                                    <i class="bi bi-speedometer2"></i> Dashboard
                                </a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item text-danger" href="/logout">
                                    <i class="bi bi-box-arrow-right"></i> Uitloggen
                                </a></li>
                        </ul>
                    </li>
                <?php else: ?>
                    <!-- User is not logged in -->
                    <li class="nav-item">
                        <a class="nav-link" href="/login">
                            <i class="bi bi-box-arrow-in-right"></i> Inloggen
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>