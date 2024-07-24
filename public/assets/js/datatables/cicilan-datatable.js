$(document).ready(function () {
    $("#cicilan-table").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        autoWidth: true,
        responsive: true,
        ajax: {
            'url': $("#cicilan-table").data("url"),
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'amount', name: 'amount'},
            {data: 'iuran', name: 'iuran'},
            {data: 'tempo', name: 'tempo'},
            {data: 'cicilan_date', name: 'cicilan_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [

        ]
    });
});