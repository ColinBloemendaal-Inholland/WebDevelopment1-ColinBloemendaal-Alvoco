<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container m-0 py-5">
            <?php \View::partial('Partials.DeleteModal', ['type' => 'bestuurslid']); ?>
            <?php \View::partial('Partials.ForceDeleteModal', ['type' => 'bestuurslid']); ?>
            <header>
                <h1 class="mb-4">Bestuursleden</h1>
            </header>
            <div class="row mb-3">
                <!-- Name  search -->
                <div class="form-group col-4">
                    <label for="searchName">Zoek op naam:</label>
                    <input type="text" class="form-control" id="searchName" aria-label="Zoek op naam invoerveld"
                        placeholder="Voer een naam in:">
                </div>
                <!-- Adress search -->
                <div class="form-group col-4">
                    <label for="searchRole">Zoek op rol:</label>
                    <input type="text" class="form-control" id="searchRole" name="searchRole"
                        aria-label="Zoek op rol invoerveld" placeholder="Voer een rol in:">
                </div>
                <div class="form-group col-md-2 d-flex align-items-end">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
                            value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde</label>
                    </div>
                </div>
                <div class="col-md-2 d-flex align-items-end justify-content-end">
                    <a href="/admin/bestuursleden/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>

            <table id="bestuursledenTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Rol</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="3" class="text-center">Loading…</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</div>
<script>
    $(document).ready(function () {
        // Load datatables
        var ledenTable = $('#bestuursledenTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            info: true,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: '/api/bestuursleden',
                type: 'POST',
                data: function (d) {
                    d.naam = $('#searchName').val();
                    d.rol = $('#searchRole').val() || [];
                    d.trashed = $('#searchTrashed').prop('checked') ? 1 : 0;
                },
                dataSrc: 'data',
                error: function (xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            },
            language: {
                zeroRecords: "Geen bestuursleden gevonden die voldoen aan je zoekopdracht",
                emptyTable: "Er zijn nog geen bestuursleden toegevoegd aan de database.",
                info: "Showing _START_ to _END_ of _TOTAL_ filtered entries (from _MAX_ total)"
            },
            columns: [
                { data: 'naam', title: 'Naam', render: $.fn.dataTable.render.text() },
                { data: 'rol', title: 'Rol', render: $.fn.dataTable.render.text() },
                {
                    data: null,
                    title: 'Acties',
                    orderable: false,
                    render: function (data, type, row) {
                        let deletedAt;
                        if (row['deleted_at'] !== null) {
                            deletedAt = `
                                <form method="POST" action="/admin/bestuursleden/${row.id}/force" class="d-inline force-delete-form">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger me-1 force-delete-link"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        } else {
                            deletedAt = `
                                <form method="POST" action="/admin/bestuursleden/${row.id}" class="d-inline delete-form">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger delete-link"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        }
                        return `
                            <a href="/admin/bestuursleden/${row.id}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye-fill"></i></a>
                            <a href="/admin/bestuursleden/${row.id}/edit" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-fill"></i></a>
                        ` + deletedAt;
                    },
                }
            ],
            dom: '<"top">rt<"bottom"lp><"clear">',
        });
        let reloadTimeout;
        function timeout() {
            clearTimeout(reloadTimeout);
            reloadTimeout = setTimeout(function () {
                ledenTable.ajax.reload();
            }, 700);
        }

        // Text input: reload after 700ms of inactivity
        $('#searchName, #searchRole').on('input', timeout);
        // Multi-select and checkbox: reload immediately on change
        $('#searchTrashed').on('change', function () {
            ledenTable.ajax.reload();
        });
    });
</script>
