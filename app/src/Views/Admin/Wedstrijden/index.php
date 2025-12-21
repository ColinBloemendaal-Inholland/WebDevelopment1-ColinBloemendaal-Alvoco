<div class="d-flex flex-grow-1">
    <?php \View::Partial('Layout.NavAdmin'); ?>
    <div class="flex-grow-1 p-4">
        <div class="container m-0">
            <h1 class="mb-4">Wedstrijden</h1>
            <div class="form-row">
                <!-- Home team select -->
                <div class="form-group col-md-4">
                    <label for="searchHomeTeam">Zoek op thuisteam:</label>
                    <select name="homeTeam" id="searchHomeTeam" class="form-control" multiple>
                        <option value="" selected disabled hidden>Selecteer een team</option>
                        <?php foreach ($data['teams'] as $team) { ?>
                            <option value="<?= e($team->id) ?>"><?= e($team->name) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- Away team select -->
                <div class="form-group col-md-4">
                    <label for="searchAwayTeam">Zoek op uitteam:</label>
                    <select name="awayTeam" id="searchAwayTeam" class="form-control" multiple>
                        <option value="" selected disabled hidden>Selecteer een team</option>
                        <?php foreach ($data['teams'] as $team) { ?>
                            <option value="<?= e($team->id) ?>"><?= e($team->name) ?></option>
                        <?php } ?>
                    </select>
                </div>
                <!-- Score search -->
                <div class="form-group col-md-2">
                    <label for="searchScore">Zoek op score</label>
                    <input type="text" name="searchScore" class="form-control" id="searchScore" placeholder="Bijv. 3 - 2">
                </div>
            </div>
            <table id="wedstrijdenTable" class="table table-striped table-hover">
                <tbody>
                    <tr>
                        <td colspan="7" style="text-align:center;">Loading…</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {
        // Load datatables
        var wedstrijdenTable = $('#wedstrijdenTable').DataTable({
            processing: true,
            serverSide: true,
            searching: false,
            info: true,
            pageLength: 25,
            lengthMenu: [[10, 25, 50, 100], [10, 25, 50, 100]],
            ajax: {
                url: '/api/wedstrijden',
                type: 'POST',
                data: function (d) {
                    d.homeTeam = $('#searchHomeTeam').val();
                    d.awayTeam = $('#searchAwayTeam').val();
                    d.score = $('#searchScore').val();
                },
                dataSrc: 'data',
                error: function (xhr) {
                    console.error("AJAX Error:", xhr.responseText);
                }
            },
            language: {
                zeroRecords: "Geen wedstrijden gevonden die voldoen aan je zoekopdracht",
                emptyTable: "Er zijn nog geen wedstrijden toegevoegd aan de database.",
                info: "Showing _START_ to _END_ of _TOTAL_ filtered entries (from _MAX_ total)"
            },
            columns: [
                { data: 'teamHome', title: 'Thuis', render: $.fn.dataTable.render.text() },
                { data: 'teamAway', title: 'Uit', render: $.fn.dataTable.render.text() },
                {
                    data: 'date', title: 'Datum',
                    render: function (data, type, row) {
                        const date = new Date(data);
                        const options = { year: 'numeric', month: '2-digit', day: '2-digit' };
                        return date.toLocaleDateString('nl-NL', options);
                    },
                },
                {
                    data: 'time', title: 'Tijd', render: function (data, type) {
                        if (!data) return '';
                        if (type !== 'display') return data;
                        const [hour, minute] = data.split(':');
                        return `${hour.padStart(2, '0')}:${minute.padStart(2, '0')}`;
                    }
                },
                { data: 'location', title: 'Locatie', render: $.fn.dataTable.render.text() },
                { data: 'score', title: 'Score', render: $.fn.dataTable.render.text() },
                {
                    data: null,
                    title: 'Acties',
                    orderable: false,
                    render: function (data, type, row) {
                        return `
                        <a href="/admin/wedstrijden/${row.id}" class="btn btn-sm btn-primary me-1"><i class="bi bi-eye-fill"></i></a>
                        <a href="/admin/wedstrijden/${row.id}/edit" class="btn btn-sm btn-warning me-1"><i class="bi bi-pencil-fill"></i></a>
                        <a href="/admin/wedstrijden/${row.id}/delete" class="btn btn-sm btn-danger me-1"><i class="bi bi-trash-fill"></i></a>
                        `;
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
                wedstrijdenTable.ajax.reload();
            }, 1000);
        };
        // Text inputs: reload after 1 second of inactivity
        $('#searchScore').on('input', timeout);

        $('#searchHomeTeam, #searchAwayTeam').on('change', function () {
            wedstrijdenTable.ajax.reload();
        });

        // Tom select
        new TomSelect('#searchHomeTeam', {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            },
            plugins: ['remove_button']
        });
        // Tom select
        new TomSelect('#searchAwayTeam', {
            create: true,
            sortField: {
                field: "text",
                direction: "asc"
            },
            plugins: ['remove_button']
        });
    });
</script>