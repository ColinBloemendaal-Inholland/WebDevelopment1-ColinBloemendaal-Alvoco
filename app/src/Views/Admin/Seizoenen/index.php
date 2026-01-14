<div class="d-flex flex-grow-1">
	<?php \View::partial('Layout.NavAdmin'); ?>
	<main class="flex-grow-1 p-4">
		<section class="container m-0">
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
							aria-label="Met verwijderde contacten checkbox" value="1">
						<label class="form-check-label" for="searchTrashed">Met verwijderde contacten</label>
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

<script>
	$(document).ready(function () {
		var seizoenenTable = $('#seizoenenTable').DataTable({
			processing: true,
			serverSide: true,
			searching: false,
			info: true,
			pageLength: 25,
			lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
			ajax: {
				url: '/api/seizoenen',
				type: 'POST',
				data: function (d) {
					d.title = $('#searchTitle').val();
					d.trashed = $('#searchTrashed').is(':checked') ? 1 : 0;
				},
				dataSrc: 'data',
				error: function (xhr) {
					console.error("AJAX Error:", xhr.responseText);
				}
			},
			language: {
				zeroRecords: "Geen seizoenen gevonden die voldoen aan je zoekopdracht",
				emptyTable: "Er zijn nog geen seizoenen toegevoegd aan de database.",
				info: "Showing _START_ to _END_ of _TOTAL_ filtered entries (from _MAX_ total)"
			},
			columns: [
				{ data: 'title', title: 'Titel', render: $.fn.dataTable.render.text() },
				{ data: 'is_current', title: 'Huidig', render: function (data) { return data ? 'Ja' : 'Nee'; } },
				{
					data: null,
					title: 'Acties',
					orderable: false,
					render: function (data, type, row) {
						return `
							<a href="/admin/seizoenen/${row.id}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye-fill"></i></a>
							<a href="/admin/seizoenen/${row.id}/edit" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-fill"></i></a>
							<form method="POST" action="/admin/seizoenen/${row.id}" class="d-inline delete-form" data-id="${row.id}">
								<input type="hidden" name="_method" value="DELETE">
								<button type="submit" class="btn btn-sm btn-danger delete-link"><i class="bi bi-trash-fill"></i></button>
							</form>
						`;
					},
				}
			],
			dom: '<"top">rt<"bottom"lp><"clear">',
			columnDefs: [
				{
					targets: -1,
					className: 'dt-body-right dt-head-right',
					orderable: false
				}
			]
		});

		let reloadTimeout;
		function timeout() {
			clearTimeout(reloadTimeout);
			reloadTimeout = setTimeout(function () {
				seizoenenTable.ajax.reload();
			}, 1000);
		};

		$('#searchTitle').on('input', timeout);

		$('#searchTrashed').on('change', function () {
            seizoenenTable.ajax.reload();
        });
	});
</script>