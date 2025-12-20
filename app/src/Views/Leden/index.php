<div class="container">
    <table id="ledenTable" class="table table-striped table-hover"></table>
</div>

<script>
$(document).ready(function() {
    $('#ledenTable').DataTable({
        processing: true,
        serverSide: false,
        searching: false,
        pageLength: 50,
        lengthMenu: [ [10, 25, 50, 100], [10, 25, 50, 100] ],
        ajax: {
            url: '/api/leden',
            dataSrc: 'data',
            error: function (xhr) {
                console.error("AJAX Error:", xhr.responseText);
            }
        },
        columns: [
            { data: 'fullname', title: 'Naam', render: $.fn.dataTable.render.text() },
            { data: 'email', title: 'Email', render: $.fn.dataTable.render.text() },
            { data: 'phone', title: 'Telefoon', render: $.fn.dataTable.render.text() },
            { data: 'adres', title: 'Adres', render: $.fn.dataTable.render.text() },
            { data: 'postal', title: 'Postcode', render: $.fn.dataTable.render.text() },
            { data: 'city', title: 'Stad', render: $.fn.dataTable.render.text() },
            { data: 'emergencyFullname', title: 'Noodcontact', render: $.fn.dataTable.render.text() },
            { data: 'emergencyNumber', title: 'Noodnummer', render: $.fn.dataTable.render.text() },

        ],
        dom: '<"top">rt<"bottom"lp><"clear">',
    });
});
</script>