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
                            <form method="POST" action="/admin/contact/${row.id}/force" class="d-inline force-delete-form">
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-sm btn-danger me-1 force-delete-link"><i class="bi bi-trash-fill"></i></button>
                            </form>
                        `;
                    } else {
                        deletedAt = `
                            <form method="POST" action="/admin/contact/${row.id}" class="d-inline delete-form">
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
