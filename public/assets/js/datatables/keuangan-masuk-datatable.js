$(document).ready(function () {
    $("#keuangan-masuk-table").DataTable({
        dom: '<"row"<"col-sm-12 col-md-4"l><"#filter.col-sm-12 col-md-4"><"col-sm-12 col-md-4"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        ordering: true,
        serverSide: true,
        processing: true,
        autoWidth: true,
        responsive: true,
        ajax: {
            'url': $("#keuangan-masuk-table").data("url"),
            'data': function(d) {
                d.status = new URLSearchParams(window.location.search).get('status');
                d.startDate = new URLSearchParams(window.location.search).get('start_date');
                d.endDate = new URLSearchParams(window.location.search).get('end_date');
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'payment_code', name: 'payment_code'},
            {data: 'total_payment', name: 'total_payment'},
            {data: 'payment_date', name: 'payment_date'},
            {data: 'status', name: 'status', width: '80px'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [

        ],
    });
});