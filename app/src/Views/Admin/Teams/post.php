<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container-fluid m-0 py-5">
            <div class="text-center ">
                <h1 class="display-4 fw-bold mb-0"><?= $data['team']['name'] ?></h1>
                <p class="lead text-muted">Team overzicht & wedstrijden</p>
            </div>
            <div class="row">
                <!-- Speler -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <h2 class="h4 fw-bold">Spelers </h2>
                    </div>
                    <div class="list-group">
                        <?php foreach ($data['team']['spelers'] as $speler): ?>
                            <div class="list-group-item">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="text-nowrap fw-semibold">
                                        <?= $speler['number'] ?>
                                    </div>
                                    <div class="flex-grow-1">
                                        <?= $speler['lid']['fullname'] ?>
                                    </div>
                                    <div class="text-nowrap text-muted">
                                        <?= $speler['position'] ?>
                                    </div>
                                    <div>
                                        <a href="/spelers/<?= $speler['id'] ?>" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                    </div>

                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
                <!-- Coaches & Trainers -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <h2 class="h4 fw-bold">Teamfoto</h2>
                    </div>
                    <div class="text-center mb-5">
                        <img src="teamfoto.jpg" class="img-fluid rounded"
                            alt="<?= e($data['team']['name']) ?> Teamfoto">
                    </div>
                    <div class="mb-3">
                        <h2 class="h4 fw-bold">Coaches</h2>
                    </div>
                    <div class="list-group mb-5">
                        <?php foreach ($data['team']['coaches'] as $coach): ?>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <?= e($coach['role']) ?>
                                    </div>

                                    <div class="col">
                                        <?= e($coach['lid']['fullname']) ?>
                                    </div>

                                    <div class="col-auto">
                                        <a href="/admin/coach/<?= e($coach['id']) ?>" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                    <div class="mb-3">
                        <h2 class="h4 fw-bold">Trainers</h2>
                    </div>
                    <div class="list-group mb-5">
                        <?php foreach ($data['team']['trainers'] as $trainer): ?>
                            <div class="list-group-item">
                                <div class="row align-items-center">
                                    <div class="col-auto">
                                        <?= e($trainer['role']) ?>
                                    </div>

                                    <div class="col">
                                        <?= e($trainer['lid']['fullname']) ?>
                                    </div>

                                    <div class="col-auto">
                                        <a href="/admin/trainers/<?= e($trainer['id']) ?>" class="btn btn-sm btn-primary">
                                            <i class="bi bi-eye-fill"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>

                    </div>

                </div>
            </div>

            <div class="mb-5">
                <h3>Wedstrijden</h3>
                <?php foreach ($data['team']['wedstrijden'] as $wedstrijd) { ?>
                    <div class="card mb-3">
                        <div class="card-body">
                            <h5 class="card-title"><?= e($wedstrijd->hometeam['name']) ?> vs
                                <?= e($wedstrijd->awayTeam['name']) ?>
                            </h5>
                            <p class="card-text">
                                <strong>Datum:</strong> <?= e($wedstrijd['date']) ?><br>
                                <strong>Tijd:</strong> <?= e($wedstrijd['time']) ?><br>
                                <strong>Adres:</strong> <a href="https://maps.google.com/?q=Vondelstraat+35,+1833AA+Alkmaar"
                                    target="_blank">Vondelstraat 35, 1833AA Alkmaar</a>
                            </p>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>