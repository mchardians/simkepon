$(document).ready(function () {
    $("#keuangan-keluar-table").DataTable({
        dom: '<"row"<"col-sm-12 col-md-4"l><"#filter.col-sm-12 col-md-4"><"col-sm-12 col-md-4"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        ordering: true,
        serverSide: true,
        processing: true,
        autoWidth: true,
        responsive: true,
        ajax: {
            'url': $("#keuangan-keluar-table").data("url"),
            'data': function (d) {
                d.startDate = new URLSearchParams(window.location.search).get('start_date');
                d.endDate = new URLSearchParams(window.location.search).get('end_date');
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false},
            {data: 'date', name: 'date'},
            {data: 'amount', name: 'amount'},
            {data: 'iuran', name: 'iuran'},
            {data: 'description', name: 'description'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [

        ]
    })
});