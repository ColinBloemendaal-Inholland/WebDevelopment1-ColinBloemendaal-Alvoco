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
            { data: 'fullname', title: 'Naam' },
            { data: 'email', title: 'Email'},
            { data: 'phone', title: 'Telefoon'},
            { data: 'adres', title: 'Adres'},
            { data: 'postal', title: 'Postcode'},
            { data: 'city', title: 'Stad'},
            { data: 'emergencyFullname', title: 'Noodcontact'},
            { data: 'emergencyNumber', title: 'Noodnummer'},

        ],
        dom: '<"top">rt<"bottom"lp><"clear">',
    });
});
</script>