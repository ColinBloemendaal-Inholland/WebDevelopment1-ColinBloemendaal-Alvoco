<div class="d-flex flex-column">
    <div class="d-flex flex-grow-1">
        <?php \View::partial('Layout.NavAdmin'); ?>
        <main class="flex-grow-1 p-4">
            <section class="container m-0 py-5">
                <header>
                    <h1 class="mb-4">Bestuursleden</h1>
                </header>
                <div class="row">
                    <div class="col-12 d-flex align-items-end justify-content-end mb-3">
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
                                <form method="POST" action="/admin/bestuursleden/${row.id}/force" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger me-1"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        } else {
                            deletedAt = `
                                <form method="POST" action="/admin/bestuursleden/${row.id}" class="d-inline delete-form" data-id="${row.id}">
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
    });
</script>
