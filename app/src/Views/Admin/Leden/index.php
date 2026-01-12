<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container m-0">
            <h1 class="mb-4">Leden</h1>
            <div class="row">
                <!-- Name or email search -->
                <div class="form-group col-4">
                    <label for="searchNameOrEmail">Zoek op naam of email:</label>
                    <input type="text" class="form-control" id="searchNameOrEmail" aria-label="Zoek op naam of e-mail invoerveld"
                        placeholder="Voer een naam of email in:">
                </div>
                <!-- Adress search -->
                <div class="form-group col-4">
                    <label for="searchAdress">Zoek op adres:</label>
                    <input type="text" class="form-control" id="searchAdress" name="searchAdress" aria-label="Zoek op adres invoerveld"
                        placeholder="Voor een adres in:">
                </div>
                <!-- Role filter -->
                <div class="form-group col-4">
                    <label for="searchRole">Zoek op rol:</label>
                    <select name="role" id="searchRole" class="form-control" multiple>
                        <option value="" selected disabled hidden>Selecteer een rol</option>
                        <?php foreach ($data['rolen'] as $rol) { ?>
                            <option value="<?= e($rol->id) ?>"><?= e($rol->name) ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <!-- Phone search -->
                <div class="form-group col-6">
                    <label for="searchPhone">Zoek op telefoon nummer:</label>
                    <input type="tel" class="form-control" id="searchPhone" name="searchPhone" aria-label="Zoek op telefoonnummer invoerveld"
                        placeholder="Voer een telefoon nummer in:">
                </div>
                <!-- With or without soft deleted leden -->
                <div class="form-group col-3 d-flex align-items-end justify-content-end">
                    <div class="form-check form-switch float-right">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed" aria-label="Met verwijderde leden checkbox"
                            value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde leden</label>
                    </div>
                </div>
                <div class="form-group col-3 d-flex align-items-end justify-content-end">
                    <a href="/admin/leden/create" class="btn btn-primary">Toevoegen</a>
                </div>
            </div>
            <table id="ledenTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Telefoon</th>
                        <th>Adres</th>
                        <th>Acties</th>
                    </tr>
                </thead>
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
        var ledenTable = $('#ledenTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            info: true,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: '/api/leden',
                type: 'POST',
                data: function (d) {
                    d.name = $('#searchNameOrEmail').val();
                    d.adress = $('#searchAdress').val();
                    d.role = $('#searchRole').val() || [];
                    d.phone = $('#searchPhone').val();
                    d.trashed = $('#searchTrashed').prop('checked') ? 1 : 0;
                },
                dataSrc: 'data',
                error: function (xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            },
            language: {
                zeroRecords: "Geen leden gevonden die voldoen aan je zoekopdracht",
                emptyTable: "Er zijn nog geen leden toegevoegd aan de database.",
                info: "Showing _START_ to _END_ of _TOTAL_ filtered entries (from _MAX_ total)"
            },
            columns: [
                { data: 'fullname', title: 'Naam', render: $.fn.dataTable.render.text() },
                { data: 'email', title: 'Email', render: $.fn.dataTable.render.text() },
                { data: 'phone', title: 'Telefoon', render: $.fn.dataTable.render.text() },
                { data: 'adres', title: 'Adres', render: $.fn.dataTable.render.text() },
                {
                    data: null,
                    title: 'Acties',
                    orderable: false,
                    render: function (data, type, row) {
                        let deletedAt;
                        if (row['deleted_at'] !== null) {
                            deletedAt = `
                                <form method="POST" action="/admin/leden/${row.id}/force" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger me-1"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        } else {
                            deletedAt = `
                                <form method="POST" action="/admin/leden/${row.id}" class="d-inline delete-form" data-id="${row.id}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger delete-link"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        }
                        return `
                            <a href="/admin/leden/${row.id}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye-fill"></i></a>
                            <a href="/admin/leden/${row.id}/edit" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-fill"></i></a>
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
            }, 1000);
        };

        // Text inputs: reload after 1 second of inactivity
        $('#searchNameOrEmail, #searchAdress, #searchPhone').on('input', timeout);

        // Multi-select: reload immediately on change
        $('#searchRole, #searchTrashed').on('change', function () {
            ledenTable.ajax.reload();
        });

        // Tom select
        new TomSelect('#searchRole', {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            },
            plugins: ['remove_button']
        });
    });
</script>
