<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container m-0">
            <header>
                <h1 class="mb-4">Coaches</h1>
            </header>
            <div class="row">
                <!-- Name search -->
                <div class="form-group col-3">
                    <label for="searchName">Zoek op naam:</label>
                    <input type="text" class="form-control" id="searchName" name="searchName"
                        aria-label="Zoek op naam invoerveld" placeholder="Voer een naam in:">
                </div>
                <div class="form-group col-3">
                    <label for="searchRole">Zoek op rol:</label>
                    <input type="text" class="form-control" id="searchRole" name="searchRole"
                        aria-label="Zoek op rol invoerveld" placeholder="Voer een rol in:">
                </div>
                <div class="form-group col-3 d-flex align-items-end">
                    <div class="form-check form-switch float-right">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
                            aria-label="Met verwijderde contacten checkbox" value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde contacten</label>
                    </div>
                </div>

                <div class="form-group col-3 d-flex align-items-end justify-content-end">
                    <a href="/admin/coaches/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>
            <table id="coachesTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Rol</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="5" style="text-align:center;">Loading…</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</div>

<script>
    $(document).ready(function () {
        // Load datatables
        var coachesTable = $('#coachesTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            info: true,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: '/api/coaches',
                type: 'POST',
                data: function (d) {
                    d.name = $('#searchName').val();
                    d.role = $('#searchRole').val();
                    d.trashed = $('#searchTrashed').prop('checked') ? 1 : 0;
                },
                dataSrc: 'data',
                error: function (xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            },
            language: {
                zeroRecords: "Geen coaches gevonden die voldoen aan je zoekopdracht",
                emptyTable: "Er zijn nog geen coaches toegevoegd aan de database.",
                info: "Showing _START_ to _END_ of _TOTAL_ filtered entries (from _MAX_ total)"
            },
            columns: [
                { data: 'name', title: 'Naam', render: $.fn.dataTable.render.text() },
                { data: 'role', title: 'Rol', render: $.fn.dataTable.render.text() },
                {
                    data: null,
                    title: 'Acties',
                    orderable: false,
                    render: function (data, type, row) {
                        let deletedAt;
                        if (row['deleted_at'] !== null) {
                            deletedAt = `
                            <form method="POST" action="/admin/coaches/${row.id}/force" class="d-inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger me-1"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        `;
                        } else {
                            deletedAt = `
                            <form method="POST" action="/admin/coaches/${row.id}" class="d-inline delete-form" data-id="${row.id}">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger delete-link"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        `;
                        }
                        return `
                        <a href="/admin/coaches/${row.id}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye-fill"></i></a>
                        <a href="/admin/coaches/${row.id}/edit" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-fill"></i></a>
                    ` + deletedAt;
                    }
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
                coachesTable.ajax.reload();
            }, 1000);
        };
        // Text inputs: reload after 1 second of inactivity
        $('#searchName, #searchRole').on('input', timeout);

        // Multi-select: reload immediately on change
        $('#searchTrashed').on('change', function () {
            coachesTable.ajax.reload();
        });
    });
</script>