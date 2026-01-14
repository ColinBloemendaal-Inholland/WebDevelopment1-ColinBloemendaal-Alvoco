<div class="d-flex flex-grow-1">
	<?php \View::partial('Layout.NavAdmin'); ?>
	<main class="flex-grow-1 p-4">
		<section class="container-fluid m-0 py-5">
			<div class="row">
				<div class="col-12">
					<header>
						<h2 class="h4 mb-4">Nieuw Seizoen toevoegen</h2>
					</header>
					<article class="card shadow-sm">
						<div class="card-body">
							<?php \View::partial('Layout.errors'); ?>
							<form method="POST">
								<!-- Titel -->
								<div class="mb-3 row">
									<label for="title" class="col-sm-3 col-form-label">Titel</label>
									<div class="col-sm-9">
										<input type="text" class="form-control" id="title" name="title" placeholder="Bijv. 2025/2026" aria-label="Seizoen titel invoerveld"
											   value="<?= e($_SESSION['form_old']['title'] ?? '') ?>" required>
									</div>
								</div>

								<!-- Huidig seizoen -->
								<div class="mb-3 row">
									<label for="is_current" class="col-sm-3 col-form-label">Huidig seizoen?</label>
									<div class="col-sm-9 d-flex align-items-center">
										<input type="checkbox" class="form-check-input me-2" id="is_current" name="is_current" value="1" <?= !empty($_SESSION['form_old']['is_current']) ? 'checked' : '' ?>>
										<label class="form-check-label" for="is_current">Ja</label>
									</div>
								</div>

								<div class="mb-3 row">
									<div class="col-sm-9 offset-sm-3">
										<button type="submit" class="btn btn-primary">Opslaan</button>
										<a href="/admin/seizoenen" class="btn btn-secondary">Annuleren</a>
									</div>
								</div>
							</form>
						</div>
					</article>
				</div>
			</div>
		</section>
	</main>
