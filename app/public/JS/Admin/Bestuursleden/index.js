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
        dom: '<"top">rt<"bottom"lp><"clear">'
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
