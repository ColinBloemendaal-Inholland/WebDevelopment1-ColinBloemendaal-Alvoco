$(document).ready(function () {
    var seizoenenTable = $('#seizoenenTable').DataTable({
        processing: true,
        serverSide: true,
        searching: false,
        info: true,
        pageLength: 25,
        lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
        ajax: {
            url: '/api/seizoenen',
            type: 'POST',
            data: function (d) {
                d.title = $('#searchTitle').val();
                d.trashed = $('#searchTrashed').is(':checked') ? 1 : 0;
            },
            dataSrc: 'data',
            error: function (xhr) {
                console.error("AJAX Error:", xhr.responseText);
            }
        },
        language: {
            zeroRecords: "Geen seizoenen gevonden die voldoen aan je zoekopdracht",
            emptyTable: "Er zijn nog geen seizoenen toegevoegd aan de database.",
            info: "Showing _START_ to _END_ of _TOTAL_ filtered entries (from _MAX_ total)"
        },
        columns: [
            { data: 'title', title: 'Titel', render: $.fn.dataTable.render.text() },
            { data: 'is_current', title: 'Huidig', render: function (data) { return data ? 'Ja' : 'Nee'; } },
            {
                data: null,
                title: 'Acties',
                orderable: false,
                render: function (data, type, row) {
                    let deletedAt = '';
                    if(!row['is_current']) {
                        if (row['deleted_at'] !== null) {
                            deletedAt = `
                                <form method="POST" action="/admin/seizoenen/${row.id}/force" class="d-inline force-delete-form">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger me-1 force-delete-link"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        } else {
                            deletedAt = `
                                <form method="POST" action="/admin/seizoenen/${row.id}" class="d-inline delete-form">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <button type="submit" class="btn btn-sm btn-danger delete-link"><i class="bi bi-trash-fill"></i></button>
                                </form>
                            `;
                        }
                    }


                    return `
                        <a href="/admin/seizoenen/${row.id}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye-fill"></i></a>
                        <a href="/admin/seizoenen/${row.id}/edit" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-fill"></i></a>
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
            seizoenenTable.ajax.reload();
        }, 1000);
    };

    $('#searchTitle').on('input', timeout);

    $('#searchTrashed').on('change', function () {
        seizoenenTable.ajax.reload();
    });
});
