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
                d.seizoen_id = $('#searchSeizoen').val();
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
            { data: 'seizoen', title: 'Seizoen', render: $.fn.dataTable.render.text() },
            {
                data: null,
                title: 'Acties',
                orderable: false,
                render: function (data, type, row) {
                    let deletedAt;
                    if (row['deleted_at'] !== null) {
                        deletedAt = `
                            <form method=\"POST\" action=\"/admin/teams/${row.id}/force\" class=\"d-inline force-delete-form\">
                                <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                                <button type=\"button\" class=\"btn btn-sm btn-danger force-delete-link me-1\"><i class=\"bi bi-trash-fill\"></i></button>
                            </form>
                        `;
                    } else {
                        deletedAt = `
                            <form method=\"POST\" action=\"/admin/teams/${row.id}\" class=\"d-inline delete-form\">
                                <input type=\"hidden\" name=\"_method\" value=\"DELETE\">
                                <button type=\"button\" class=\"btn btn-sm btn-danger delete-link\"><i class=\"bi bi-trash-fill\"></i></button>
                            </form>
                        `;
                    }
                    return `
                        <a href=\"/admin/teams/${row.id}\" class=\"btn btn-sm btn-primary me-1\"><i class=\"bi bi-eye-fill\"></i></a>
                        <a href=\"/admin/teams/${row.id}/edit\" class=\"btn btn-sm btn-warning me-1\"><i class=\"bi bi-pencil-fill\"></i></a>
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
    $('#searchTrashed, #searchSeizoen').on('change', function () {
        teamsTable.ajax.reload();
    });
});
