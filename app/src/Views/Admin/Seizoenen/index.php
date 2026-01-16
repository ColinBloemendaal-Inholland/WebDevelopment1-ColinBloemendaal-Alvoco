<div class="d-flex flex-grow-1">
	<?php \View::partial('Layout.NavAdmin'); ?>
	<main class="flex-grow-1 p-4">
		<section class="container m-0">
						<?php \View::partial('Partials.DeleteModal', ['type' => 'seizoen']); ?>
						<?php \View::partial('Partials.ForceDeleteModal', ['type' => 'seizoen']); ?>
			<header>
				<h1 class="mb-4">Seizoenen</h1>
			</header>
			<div class="row">
				<!-- Titel search -->
				<div class="form-group col-4">
					<label for="searchTitle">Zoek op titel:</label>
					<input type="text" class="form-control" id="searchTitle" name="searchTitle"
						aria-label="Zoek op seizoen titel invoerveld" placeholder="Voer een titel in:">
				</div>
				<div class="form-group col-4 d-flex align-items-end">
					<div class="form-check form-switch float-right">
						<input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
							aria-label="Met verwijderde seizoenen checkbox" value="1">
						<label class="form-check-label" for="searchTrashed">Met verwijderde seizoenen</label>
					</div>
				</div>
				<div class="form-group col-4 d-flex align-items-end justify-content-end">
					<a href="/admin/seizoenen/create" class="btn btn-primary">Toevoegen</a>
				</div>
			</div>
			<table id="seizoenenTable" class="table table-striped table-hover">
				<thead>
					<tr>
						<th>Titel</th>
						<th>Huidig</th>
						<th>Acties</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td colspan="5" class="text-center">Loading…</td>
					</tr>
				</tbody>
			</table>
		</section>
	</main>
</div>

<script src="/JS/Admin/Seizoenen/index.js"></script>