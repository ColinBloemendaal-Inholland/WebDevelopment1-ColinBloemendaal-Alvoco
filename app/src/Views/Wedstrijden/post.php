<div class="container py-5">
	<?php if (!empty($data['wedstrijd'])): ?>
		<?php $wedstrijd = $data['wedstrijd']; ?>
		<div class="row mb-4">
			<div class="col-12 text-center">
				   <h1 class="display-5 fw-bold">
					   <a href="/teams/<?= e($wedstrijd->hometeam->id) ?>" class="link-primary text-decoration-none">
						   <?= e($wedstrijd->hometeam->name ?? 'Onbekend') ?>
					   </a>
					   <span class="text-primary">vs</span>
					   <a href="/teams/<?= e($wedstrijd->awayTeam->id) ?>" class="link-danger text-decoration-none">
						   <?= e($wedstrijd->awayTeam->name ?? 'Onbekend') ?>
					   </a>
				   </h1>
				<div class="mb-2 text-muted">
					<?= e(date('d-m-Y', strtotime($wedstrijd->date))) ?> om <?= e(substr($wedstrijd->time, 0, 5)) ?>
					| Locatie: <?= e($wedstrijd->location) ?>
				</div>
				<div class="mb-3">
					<span class="badge bg-secondary">Stand: <?= e($wedstrijd->score_home) ?> - <?= e($wedstrijd->score_away) ?></span>
				</div>
			</div>
		</div>
		<div class="row g-4">
			<div class="col-md-6">
				<div class="card h-100">
					   <div class="card-header bg-primary text-white">
						   <a href="/teams/<?= e($wedstrijd->hometeam->id) ?>" class="text-white text-decoration-underline">
							   <?= e($wedstrijd->hometeam->name ?? 'Thuisteam') ?>
						   </a>
					   </div>
					<div class="card-body">
						<h6>Spelers</h6>
						<ul class="list-group mb-3">
							<?php foreach ($wedstrijd->hometeam->spelers ?? [] as $speler): ?>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									#<?= e($speler->number) ?> <?= e($speler->lid->firstname . ' ' . ($speler->lid->middlename ?? '') . ' ' . $speler->lid->lastname) ?>
									<span class="badge bg-light text-dark"><?= e($speler->position) ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
						<h6>Coaches</h6>
						<ul class="list-group">
							<?php foreach ($wedstrijd->hometeam->coaches ?? [] as $coach): ?>
								<li class="list-group-item">
									<?= e($coach->lid->firstname . ' ' . ($coach->lid->middlename ?? '') . ' ' . $coach->lid->lastname) ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card h-100">
					   <div class="card-header bg-danger text-white">
						   <a href="/teams/<?= e($wedstrijd->awayTeam->id) ?>" class="text-white text-decoration-underline">
							   <?= e($wedstrijd->awayTeam->name ?? 'Uitteam') ?>
						   </a>
					   </div>
					<div class="card-body">
						<h6>Spelers</h6>
						<ul class="list-group mb-3">
							<?php foreach ($wedstrijd->awayTeam->spelers ?? [] as $speler): ?>
								<li class="list-group-item d-flex justify-content-between align-items-center">
									#<?= e($speler->number) ?> <?= e($speler->lid->firstname . ' ' . ($speler->lid->middlename ?? '') . ' ' . $speler->lid->lastname) ?>
									<span class="badge bg-light text-dark"><?= e($speler->position) ?></span>
								</li>
							<?php endforeach; ?>
						</ul>
						<h6>Coaches</h6>
						<ul class="list-group">
							<?php foreach ($wedstrijd->awayTeam->coaches ?? [] as $coach): ?>
								<li class="list-group-item">
									<?= e($coach->lid->firstname . ' ' . ($coach->lid->middlename ?? '') . ' ' . $coach->lid->lastname) ?>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	<?php else: ?>
		<div class="alert alert-warning text-center">Wedstrijd niet gevonden.</div>
	<?php endif; ?>
</div>
