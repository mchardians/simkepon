$(document).ready(function () {
    $("#walisantri-table").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        autoWidth: true,
        responsive: true,
        ajax: {
            'url': $("#walisantri-table").data("url"),
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false},
            {data: 'nik', name: 'nik', orderable: false, width: '100px'},
            {data: 'name', name: 'name'},
            {data: 'job', name: 'job'},
            {data: 'phone', name: 'phone'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [

        ]
    });
});
