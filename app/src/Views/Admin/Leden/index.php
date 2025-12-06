<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container m-0">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="searchNameOrEmail">Zoek op naam of email:</label>
                    <input type="text" class="form-control" id="searchNameOrEmail"
                        placeholder="Voer een naam of email in:">
                </div>
                <div class="form-group col-md-4">
                    <label for="searchAdress">Zoek op adres:</label>
                    <input type="text" class="form-control" id="searchAdress" placeholder="Voor een adres in:">
                </div>
                <div class="form-group col-md-4">
                    <label for="searchRole">Zoek op rol:</label>
                    <select name="role" id="searchRole" class="form-control" multiple>
                        <option value="" selected disabled hidden>Selecteer een rol</option>
                        <?php foreach ($data['rolen'] as $rol) { ?>
                            <option value="<?= $rol->id ?>"><?= $rol->name ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="searchPhone">Zoek op telefoon nummer:</label>
                    <input type="tel" class="form-control" id="searchPhone" placeholder="Voer een telefoon nummer in:">
                </div>
                <div class="form-group col-md-6 d-flex align-items-end justify-content-end">
                    <div class="form-check form-switch float-right">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde leden</label>
                    </div>
                </div>
            </div>
            <table id="ledenTable" class="table table-striped table-hover"></table>
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
            pageLength: 50,
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
                { data: 'fullname', title: 'Naam' },
                { data: 'email', title: 'Email' },
                { data: 'phone', title: 'Telefoon' },
                { data: 'adres', title: 'Adres' },
                {
                    data: null,
                    title: 'Acties',
                    orderable: false,
                    render: function (data, type, row) {
                        return `
                        <a href="/admin/leden/${row.id}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye-fill"></i></a>
                        <a href="/admin/leden/${row.id}/edit" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-fill"></i></a>
                        <a href="/admin/leden/${row.id}/delete" class="btn btn-sm btn-danger delete-link" data-id="${row.id}"><i class="bi bi-trash-fill"></i></a>
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
                ledenTable.ajax.reload();
            }, 1000);
        };

        // Text inputs: reload after 1 second of inactivity
        $('#searchNameOrEmail, #searchAdress, #searchPhone').on('input', timeout);

        // Multi-select: reload immediately on change
        $('#searchRole, #searchTrashed').on('change', function () {
            console.log($('#searchTrashed').prop('checked'))
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