<div class="d-flex flex-column min-vh-100">
    <div class="d-flex flex-grow-1">
        <?php \View::partial('Layout.NavAdmin'); ?>
        <main class="flex-grow-1 p-4">
            <section class="container m-0">
                <header>
                    <h1 class="mb-4">Nieuwsberichten</h1>
                </header>
                <div class="row">
                    <!-- Name of authur search -->
                    <div class="form-group col-4">
                        <label for="searchAuthur">Zoek op authur</label>
                        <input type="text" class="form-control" id="searchAuthur" placeholder="Voer een naam in"
                            aria-label="Zoek op auteur invoerveld">
                    </div>
                    <!-- Title search -->
                    <div class="form-group col-4">
                        <label for="searchTitle">Zoek op titel:</label>
                        <input type="text" class="form-control" id="searchTitle" name="searchTitle"
                            placeholder="Voor een titel in:" aria-label="Zoek op titel invoerveld">
                    </div>
                </div>
                <div class="row">
                    <!-- From date search -->
                    <div class="form-group col-3">
                        <label for="searchFrom">Vanaf:</label>
                        <input type="date" class="form-control" id="searchFrom" name="searchFrom"
                            aria-label="Zoek vanaf datum invoerveld">
                    </div>
                    <!-- Till date search -->
                    <div class="form-group col-3">
                        <label for="searchTill">Tot:</label>
                        <input type="date" class="form-control" id="searchTill" name="searchTill"
                            aria-label="Zoek tot datum invoerveld">
                    </div>
                    <!-- With or without soft deleted leden -->
                    <div class="form-group col-3 d-flex align-items-end justify-content-end">
                        <div class="form-check form-switch float-right">
                            <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
                                value="1" aria-label="Met verwijderde nieuwsberichten checkbox">
                            <label class="form-check-label" for="searchTrashed">Met verwijderde nieuwsberichten</label>
                        </div>
                    </div>
                    <div class="form-group col-3 d-flex align-items-end justify-content-end">
                        <a href="/admin/nieuwsberichten/create" class="btn btn-primary">Toevoegen</a>
                    </div>
                </div>
                <table id="nieuwsberichtenTable" class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Titel</th>
                            <th>Authur</th>
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
</div>
<script>
    $(document).ready(function () {
        // Load datatables
        var nieuwsberichtenTable = $('#nieuwsberichtenTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            info: true,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: '/api/nieuwsberichten',
                type: 'POST',
                data: function (d) {
                    d.authur = $('#searchAuthur').val();
                    d.title = $('#searchTitle').val();
                    d.dateFrom = $('#searchFrom').val();
                    d.dateTill = $('#searchTill').val();
                    d.trashed = $('#searchTrashed').prop('checked') ? 1 : 0;
                },
                dataSrc: 'data',
                error: function (xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            },
            language: {
                zeroRecords: "Geen nieuwsberichten gevonden die voldoen aan je zoekopdracht",
                emptyTable: "Er zijn nog geen nieuwsberichten toegevoegd aan de database.",
                info: "Showing _START_ to _END_ of _TOTAL_ filtered entries (from _MAX_ total)"
            },
            columns: [
                { data: 'title', title: 'Title', render: $.fn.dataTable.render.text() },
                { data: 'fullname', title: 'Authur', render: $.fn.dataTable.render.text() },
                {
                    data: null,
                    title: 'Acties',
                    orderable: false,
                    render: function (data, type, row) {
                        let deletedAt;
                        if (row['deleted_at'] !== null) {
                            deletedAt = `
                                <form method="POST" action="/admin/nieuwsberichten/${row.id}/force" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger me-1"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        } else {
                            deletedAt = `
                                <form method="POST" action="/admin/nieuwsberichten/${row.id}" class="d-inline delete-form" data-id="${row.id}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger delete-link"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        }
                        return `
                            <a href="/admin/nieuwsberichten/${row.id}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye-fill"></i></a>
                            <a href="/admin/nieuwsberichten/${row.id}/edit" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-fill"></i></a>
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
                nieuwsberichtenTable.ajax.reload();
            }, 1000);
        };

        // Text inputs: reload after 1 second of inactivity
        $('#searchAuthur, #searchTitle').on('input', timeout);

        // Multi-select: reload immediately on change
        $('#searchFrom, #searchTill, #searchTrashed').on('change', function () {
            nieuwsberichtenTable.ajax.reload();
        });
    });
</script>
