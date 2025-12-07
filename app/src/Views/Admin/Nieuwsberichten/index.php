<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container m-0">
            <div class="form-row">
                <!-- Name of authur search -->
                <div class="form-group col-md-4">
                    <label for="searchAuthur">Zoek op authur</label>
                    <input type="text" class="form-control" id="searchAuthur"
                        placeholder="Voer een naam in">
                </div>
                <!-- Title search -->
                <div class="form-group col-md-4">
                    <label for="searchTitle">Zoek op titel:</label>
                    <input type="text" class="form-control" id="searchTitle" placeholder="Voor een titel in:">
                </div>
            </div>
            <div class="form-row">
                <!-- From date search -->
                <div class="form-group col-md-3">
                    <label for="searchFrom">Vanaf:</label>
                    <input type="date" class="form-control" id="searchFrom">
                </div>
                <!-- Till date search -->
                <div class="form-group col-md-3">
                    <label for="searchTill">Tot:</label>
                    <input type="date" class="form-control" id="searchTill">
                </div>
                <!-- With or without soft deleted leden -->
                <div class="form-group col-md-3 d-flex align-items-end justify-content-end">
                    <div class="form-check form-switch float-right">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde nieuwsberichten</label>
                    </div>
                </div>
                <div class="form-group col-md-3 d-flex align-items-end justify-content-end">
                    <a href="/admin/nieuwsberichten/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>
            <table id="nieuwsberichtenTable" class="table table-striped table-hover">
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
                { data: 'title', title: 'Title' },
                { data: 'fullname', title: 'Authur' },
                {
                    data: null,
                    title: 'Acties',
                    orderable: false,
                    render: function (data, type, row) {
                        return `
                        <a href="/admin/nieuwsberichten/${row.id}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye-fill"></i></a>
                        <a href="/admin/nieuwsberichten/${row.id}/edit" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-fill"></i></a>
                        <a href="/admin/nieuwsberichten/${row.id}/delete" class="btn btn-sm btn-danger delete-link" data-id="${row.id}"><i class="bi bi-trash-fill"></i></a>
                    `;
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
        $('#searchFrom, #searchTill, searchTrashed').on('change', function () {
            nieuwsberichtenTable.ajax.reload();
        });
    });
</script>