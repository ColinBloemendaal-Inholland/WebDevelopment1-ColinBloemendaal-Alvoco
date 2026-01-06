
<div class="container py-5">
	<div class="row mb-4">
		<div class="col-12 text-center">
			<h1 class="display-4 fw-bold">Komende Wedstrijden</h1>
			<p class="lead">Hier zie je alle aankomende wedstrijden, gesorteerd per dag.</p>
		</div>
	</div>
	<div class="row justify-content-center">
		<div class="col-lg-8">
			<?php if (!empty($data['wedstrijdenByDate']) && is_array($data['wedstrijdenByDate'])): ?>
				<?php foreach ($data['wedstrijdenByDate'] as $date => $wedstrijden): ?>
					<div class="mb-5">
						<h2 class="mb-4 pb-2 border-bottom">
							<i class="bi bi-calendar-check me-2"></i>
							<?= date('l, d F Y', strtotime($date)) ?>
						</h2>
						<?php foreach ($wedstrijden as $wedstrijd): ?>
							<article class="card shadow-sm border-0 mb-3">
								<div class="card-body">
									<div class="d-flex justify-content-between align-items-center mb-2">
										<h5 class="card-title mb-0">
											<a href="/wedstrijden/<?= e($wedstrijd['id']) ?>" class="text-decoration-none">
												<?= e($wedstrijd['team_home']) ?> vs <?= e($wedstrijd['team_away']) ?>
											</a>
										</h5>
										<span class="badge bg-primary fs-6">
											<?= date('H:i', strtotime($wedstrijd['time'] ?? $wedstrijd['date'])) ?>
										</span>
									</div>
									<p class="card-text small text-muted mb-2">
										<i class="bi bi-geo-alt me-1"></i>
										<?= e($wedstrijd['location'] ?? 'Locatie onbekend') ?>
									</p>
									<?php if (isset($wedstrijd['score_home']) && isset($wedstrijd['score_away'])): ?>
										<p class="card-text mt-2">
											<strong>Uitslag:</strong> <?= e($wedstrijd['score_home'] . ' - ' . $wedstrijd['score_away']) ?>
										</p>
									<?php endif; ?>
									<a href="/wedstrijden/<?= e($wedstrijd['id']) ?>" class="btn btn-outline-primary mt-2">Bekijk details</a>
								</div>
							</article>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div class="alert alert-info text-center">
					<i class="bi bi-info-circle me-2"></i>Geen aankomende wedstrijden gevonden.
				</div>
			<?php endif; ?>
		</div>
	</div>
</div>
