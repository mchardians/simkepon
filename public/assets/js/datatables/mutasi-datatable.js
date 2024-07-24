$(document).ready(function () {
    $("#mutasi-table").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        autoWidth: true,
        responsive: true,
        ajax: {
            'url': $("#mutasi-table").data("url"),
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false},
            {data: 'iuran', name: 'iuran', orderable: false, searchable: false},
            {data: 'amount', name: 'amount'},
            {data: 'date', name: 'source_iuran'},
            {data: 'source_iuran', name: 'source_iuran', orderable: false, searchable: false},
        ],
        columnDefs: [

        ]
    });
});
