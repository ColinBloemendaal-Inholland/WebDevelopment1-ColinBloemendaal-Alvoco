<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="container my-5">
                <div class="text-center py-4">
                    <h1 class="display-4 fw-bold mb-0"><?= $data['team']['name'] ?></h1>
                    <p class="lead text-muted">Team overzicht & wedstrijden</p>
                </div>
                <div class="row">
                    <!-- Speler -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h2 class="h4 fw-bold">Spelers </h2>
                        </div>
                        <div class="table-responsive mb-5">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Nr</th>
                                        <th>Naam</th>
                                        <th>Positie</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['team']['spelers'] as $speler) { ?>
                                        <tr>
                                            <td><?= e($speler['number']) ?></td>
                                            <td><?= e($speler['lid']['fullname']) ?></td>
                                            <td><?= e($speler['position']) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Coaches & Trainers -->
                    <div class="col-md-6">
                        <div class="mb-3">
                            <h2 class="h4 fw-bold">Teamfoto</h2>
                        </div>
                        <div class="text-center mb-5">
                            <img src="teamfoto.jpg" class="img-fluid rounded" alt="<?= e($data['team']['name']) ?> Teamfoto">
                        </div>
                        <div class="mb-3">
                            <h2 class="h4 fw-bold">Coaches</h2>
                        </div>
                        <div class="table-responsive mb-5">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Rol</th>
                                        <th>Naam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['team']['coaches'] as $coach) { ?>
                                        <tr>
                                            <td><?= e($coach['role']) ?></td>
                                            <td><?= e($coach['lid']['fullname']) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="mb-3">
                            <h2 class="h4 fw-bold">Trainers</h2>
                        </div>
                        <div class="table-responsive mb-5">
                            <table class="table table-striped table-bordered">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Rol</th>
                                        <th>Naam</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($data['team']['trainers'] as $trainer) { ?>
                                        <tr>
                                            <td><?= e($trainer['role']) ?></td>
                                            <td><?= e($trainer['lid']['fullname']) ?></td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="mb-5">
                    <h3>Wedstrijden</h3>
                    <?php foreach ($data['team']['wedstrijden'] as $wedstrijd) { ?>
                        <div class="card mb-3">
                            <div class="card-body">
                                <h5 class="card-title"><?= e($wedstrijd->hometeam['name']) ?> vs
                                    <?= e($wedstrijd->awayTeam['name']) ?></h5>
                                <p class="card-text">
                                    <strong>Datum:</strong> <?= e($wedstrijd['date']) ?><br>
                                    <strong>Tijd:</strong> <?= e($wedstrijd['time']) ?><br>
                                    <strong>Adres:</strong> <a
                                        href="https://maps.google.com/?q=Vondelstraat+35,+1833AA+Alkmaar"
                                        target="_blank">Vondelstraat 35, 1833AA Alkmaar</a>
                                </p>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>