$(document).ready(function () {
    $("#user-table").DataTable({
        ordering: true,
        serverSide: true,
        processing: true,
        autoWidth: true,
        responsive: true,
        ajax: {
            'url': $("#user-table").data("url"),
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false},
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'role', name: 'role'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [

        ]
    });
});
