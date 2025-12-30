<div class="bg-light bg-gradient py-5" style="min-height:100vh;">
	<div class="container">
		<div class="row mb-4 align-items-center">
			<div class="col-lg-8 col-md-7 col-12">
				<h1 class="display-5 fw-bold mb-2 text-primary">
					<i class="bi bi-people-fill me-2"></i> <?= e($data['team']['name']) ?>
				</h1>
				<p class="lead text-muted mb-0">Categorie: <span class="badge bg-primary"><?= e($data['team']->Category ?? '-') ?></span> &nbsp; Klasse: <span class="badge bg-secondary"><?= e($data['team']->class ?? '-') ?></span></p>
			</div>
		</div>
		<div class="row g-4">
			<div class="col-md-6">
				<div class="card mb-4">
					<div class="card-header bg-primary text-white">
						<i class="bi bi-person-lines-fill me-2"></i> Spelers
					</div>
					<ul class="list-group list-group-flush">
						<?php if (!empty($data['team']->spelers)): foreach ($data['team']->spelers as $speler): ?>
							<li class="list-group-item">
								<?php if (!empty($speler->number)): ?>
									<span class="badge bg-info ms-2">#<?= e($speler->number) ?></span>
								<?php endif; ?>
                                <?= e($speler->lid->fullname ?? '') ?>
							</li>
						<?php endforeach; else: ?>
							<li class="list-group-item text-muted">Geen spelers gevonden.</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
			<div class="col-md-6">
				<div class="card mb-4">
					<div class="card-header bg-success text-white">
						<i class="bi bi-person-badge me-2"></i> Coaches
					</div>
					<ul class="list-group list-group-flush">
						<?php if (!empty($data['team']->coaches)): foreach ($data['team']->coaches as $coach): ?>
							<li class="list-group-item">
								<?= e($coach->lid->fullname ?? '') ?> - <?= e($coach->role ?? 'Coach') ?>
							</li>
						<?php endforeach; else: ?>
							<li class="list-group-item text-muted">Geen coaches gevonden.</li>
						<?php endif; ?>
					</ul>
				</div>
				<div class="card mb-4">
					<div class="card-header bg-warning text-dark">
						<i class="bi bi-person-workspace me-2"></i> Trainers
					</div>
					<ul class="list-group list-group-flush">
						<?php if (!empty($data['team']->trainers)): foreach ($data['team']->trainers as $trainer): ?>
							<li class="list-group-item">
								<?= e($trainer->lid->fullname ?? '') ?> - <?= e($trainer->role ?? 'Trainer') ?>
							</li>
						<?php endforeach; else: ?>
							<li class="list-group-item text-muted">Geen trainers gevonden.</li>
						<?php endif; ?>
					</ul>
				</div>
			</div>
		</div>

		<div class="row mt-4">
			<div class="col-12">
				<div class="card">
					<div class="card-header bg-secondary text-white">
						<i class="bi bi-calendar-event me-2"></i> Wedstrijden
					</div>
					<div class="table-responsive">
						<table class="table table-striped table-hover mb-0">
							<thead>
								<tr>
									<th>Datum</th>
									<th>Thuisteam</th>
									<th>Uitteam</th>
									<th>Uitslag</th>
								</tr>
							</thead>
							<tbody>
								<?php if (!empty($data['team']->wedstrijden)): foreach ($data['team']->wedstrijden as $wedstrijd): ?>
									<tr onclick="window.location.href='/wedstrijden/<?= e($wedstrijd->id) ?>'" class="cursor-pointer">
										<td><?= e($wedstrijd->date ?? '-') ?></td>
										<td><?= e($wedstrijd->hometeam->name ?? '-') ?></td>
										<td><?= e($wedstrijd->awayteam->name ?? '-') ?></td>
										<td><?= e($wedstrijd->score ?? '-') ?></td>
									</tr>
								<?php endforeach; else: ?>
									<tr>
										<td colspan="4" class="text-muted">Geen wedstrijden gevonden.</td>
									</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
<style>
	.cursor-pointer { cursor: pointer; }
</style>
</div>
