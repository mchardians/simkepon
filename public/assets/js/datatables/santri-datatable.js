$(document).ready(function () {
    $("#santri-table").DataTable({
        dom: '<"row"<"col-sm-12 col-md-4"l><"#filter.col-sm-12 col-md-4"><"col-sm-12 col-md-4"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        ordering: true,
        serverSide: true,
        processing: true,
        autoWidth: true,
        responsive: true,
        ajax: {
            'url': $("#santri-table").data("url"),
            'data': function(d) {
                d.gender = new URLSearchParams(window.location.search).get('gender');
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false},
            {data: 'nis', name: 'nis', width: '100px'},
            {data: 'name', name: 'name'},
            {data: 'gender', name: 'gender', width: '85px'},
            {data: 'birth_place', name: 'birth_place'},
            {data: 'birth_date', name: 'birth_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false}
        ],
        columnDefs: [

        ],
    });
});
