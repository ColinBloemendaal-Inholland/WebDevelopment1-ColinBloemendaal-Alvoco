<div class="d-flex flex-grow-1">
	<?php \View::partial('Layout.NavAdmin'); ?>
	<div class="flex-grow-1 p-4">
		<div class="container-fluid m-0 py-5">
			<div class="row">
				<div class="col-12">
					<div class="d-flex justify-content-between align-items-center mb-3">
						<h2 class="h4"><?= e($data['seizoen']['title']) ?></h2>
						<div>
							<a href="/admin/seizoenen/<?= e($data['seizoen']['id']) ?>/edit"
								class="btn btn-primary btn-sm">Bewerken</a>
							<a href="/admin/seizoenen/<?= e($data['seizoen']['id']) ?>/delete" class="btn btn-danger btn-sm"
								onclick="return confirm('Weet je het zeker?')">Verwijderen</a>
						</div>
					</div>

					<div class="card shadow-sm mb-4">
						<div class="card-body">
							<h5 class="mb-3">Eigenschappen</h5>
							<dl class="row">
								<dt class="col-sm-4">Titel</dt>
								<dd class="col-sm-8"><?= e($data['seizoen']['title']) ?></dd>

								<dt class="col-sm-4">Huidig seizoen</dt>
								<dd class="col-sm-8"><?= !empty($data['seizoen']['is_current']) ? 'Ja' : 'Nee' ?></dd>

								<dt class="col-sm-4">Aangemaakt op</dt>
								<dd class="col-sm-8"><?= e($data['seizoen']['created_at'] ?? '-') ?></dd>

								<dt class="col-sm-4">Laatste wijziging</dt>
								<dd class="col-sm-8"><?= e($data['seizoen']['updated_at'] ?? '-') ?></dd>
							</dl>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
