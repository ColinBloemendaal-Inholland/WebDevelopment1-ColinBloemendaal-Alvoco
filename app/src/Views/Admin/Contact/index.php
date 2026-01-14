<div class="d-flex flex-grow-1">
    <?php \View::partial('Layout.NavAdmin'); ?>
    <main class="flex-grow-1 p-4">
        <section class="container m-0">
            <header>
                <h1 class="mb-4">Contacten</h1>
            </header>
            <div class="row pb-3">
                <div class="form-group col-3">
                    <label for="searchNaam">Zoek op naam:</label>
                    <input type="text" class="form-control" id="searchNaam" name="searchNaam"
                        aria-label="Zoek op naam invoerveld" placeholder="Voer een naam in:">
                </div>
                <div class="form-group col-3">
                    <label for="searchEmail">Zoek op email:</label>
                    <input type="text" class="form-control" id="searchEmail" name="searchEmail"
                        aria-label="Zoek op e-mail invoerveld" placeholder="Voer een email in:">
                </div>
                <div class="form-group col-3">
                    <label for="searchBestuurslid">Filter op bestuurslid:</label>
                    <select id="searchBestuurslid" name="bestuurslid_id" class="form-select">
                        <option value="" selected disabled hidden>Alle bestuursleden</option>
                        <?php if (!empty($data['bestuursleden'])): ?>
                            <?php foreach ($data['bestuursleden'] as $bestuurslid): ?>
                                <option value="<?= e($bestuurslid['id']) ?>"><?= e($bestuurslid['lid']['fullname']) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="form-group col-3 d-flex align-items-end">
                    <div class="form-check form-switch float-right">
                        <input class="form-check-input" type="checkbox" id="searchTrashed" name="searchTrashed"
                            aria-label="Met verwijderde contacten checkbox" value="1">
                        <label class="form-check-label" for="searchTrashed">Met verwijderde contacten</label>
                    </div>
                </div>
            </div>
            <table id="contactTable" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>Naam</th>
                        <th>Email</th>
                        <th>Bestuurslid</th>
                        <th>Acties</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="4" class="text-center">Loading…</td>
                    </tr>
                </tbody>
            </table>
        </section>
    </main>
</div>
<script>
    $(document).ready(function () {
        var contactTable = $('#contactTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            info: true,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: '/api/contact',
                type: 'POST',
                data: function (d) {
                    d.naam = $('#searchNaam').val();
                    d.email = $('#searchEmail').val();
                    d.bestuurslid_id = $('#searchBestuurslid').val();
                    d.trashed = $('#searchTrashed').prop('checked') ? 1 : 0;
                },
                dataSrc: 'data',
                error: function (xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            },
            language: {
                zeroRecords: "Geen contacten gevonden die voldoen aan je zoekopdracht",
                emptyTable: "Er zijn nog geen contacten toegevoegd aan de database.",
                info: "Showing _START_ to _END_ of _TOTAL_ filtered entries (from _MAX_ total)"
            },
            columns: [
                { data: 'naam', title: 'Naam', render: $.fn.dataTable.render.text() },
                { data: 'email', title: 'Email', render: $.fn.dataTable.render.text() },
                { data: 'bestuurslid', title: 'Bestuurslid', render: $.fn.dataTable.render.text() },
                {
                    data: null,
                    title: 'Acties',
                    orderable: false,
                    render: function (data, type, row) {
                        let deletedAt;
                        if (row['deleted_at'] !== null) {
                            deletedAt = `
                                <form method="POST" action="/admin/contact/${row.id}/force" class="d-inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger me-1"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        } else {
                            deletedAt = `
                                <form method="POST" action="/admin/contact/${row.id}" class="d-inline delete-form" data-id="${row.id}">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger delete-link"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        }
                        return `
                            <a href="/admin/contact/${row.id}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye-fill"></i></a>
                            <a href="/admin/contact/${row.id}/edit" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-fill"></i></a>
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
                contactTable.ajax.reload();
            }, 1000);
        };
        $('#searchNaam, #searchEmail').on('input', timeout);
        $('#searchBestuurslid').on('change', function () {
            contactTable.ajax.reload();
        });
        $('#searchTrashed').on('change', function () {
            contactTable.ajax.reload();
        });

        new TomSelect('#searchBestuurslid', {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            },
            plugins: ['remove_button']
        });
    });
</script>
