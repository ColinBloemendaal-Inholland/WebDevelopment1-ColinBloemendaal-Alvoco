<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container m-0">
            <h1 class="mb-4">Teams</h1>
            <div class="row">
                <!-- Name search -->
                <div class="form-group col-4">
                    <label for="searchName">Zoek op naam:</label>
                    <input type="text" class="form-control" id="searchName" name="searchName"
                        placeholder="Voer een naam in:">
                </div>
                <div class="form-group col-8 d-flex align-items-end justify-content-end">
                    <a href="/admin/teams/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>
            <table id="teamsTable" class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <td colspan="5" style="text-align:center;">Loading…</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Load datatables
        var teamsTable = $('#teamsTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            info: true,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: '/api/teams',
                type: 'POST',
                data: function (d) {
                    d.name = $('#searchName').val();
                    d.trashed = $('#searchTrashed').prop('checked') ? 1 : 0;
                },
                dataSrc: 'data',
                error: function (xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            },
            language: {
                zeroRecords: "Geen teams gevonden die voldoen aan je zoekopdracht",
                emptyTable: "Er zijn nog geen teams toegevoegd aan de database.",
                info: "Showing _START_ to _END_ of _TOTAL_ filtered entries (from _MAX_ total)"
            },
            columns: [
                { data: 'name', title: 'Naam', render: $.fn.dataTable.render.text() },
                { data: 'class', title: 'Klasse', render: $.fn.dataTable.render.text() },
                {
                    data: null,
                    title: 'Acties',
                    orderable: false,
                    render: function (data, type, row) {
                        let deletedAt;
                        if (row['deleted_at'] !== null) {
                            deletedAt = `
                                <form method="POST" action="/admin/teams/${row.id}/force" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger me-1"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        } else {
                            deletedAt = `
                                <form method="POST" action="/admin/teams/${row.id}" class="d-inline delete-form" data-id="${row.id}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger delete-link"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        }
                        return `
                            <a href="/admin/teams/${row.id}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye-fill"></i></a>
                            <a href="/admin/teams/${row.id}/edit" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-fill"></i></a>
                        ` + deletedAt;
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
                teamsTable.ajax.reload();
            }, 1000);
        };

        // Text inputs: reload after 1 second of inactivity
        $('#searchName').on('input', timeout);

        // Multi-select: reload immediately on change
        $('#searchTrashed').on('change', function () {
            teamsTable.ajax.reload();
        });
    });

</script>
