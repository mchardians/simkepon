$(document).ready(function () {
    $("#rekapitulasi-table").DataTable({
        dom: '<"row"<"col-sm-12 col-md-4"l><"#filter.col-sm-12 col-md-4"><"col-sm-12 col-md-4"f>><"row"<"col-sm-12"tr>><"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        ordering: true,
        serverSide: true,
        processing: true,
        autoWidth: true,
        responsive: true,
        ajax: {
            'url': $("#rekapitulasi-table").data("url"),
            'data': function (d) {
                d.date = new URLSearchParams(window.location.search).get('date');
            }
        },
        columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex', width: '10px', orderable: false, searchable: false},
            {data: 'name', name: 'name', orderable: false},
            {data: 'masak', name: 'masak', orderable: false},
            {data: 'gas_minyak', name: 'gas_minyak', orderable: false},
            {data: 'kas', name: 'kas', orderable: false},
            {data: 'tabungan', name: 'tabungan', orderable: false},
            {data: 'bisaroh', name: 'bisaroh', orderable: false},
            {data: 'transport', name: 'transport', orderable: false},
            {data: 'darurat', name: 'darurat', orderable: false},
            {data: 'total', name: 'total', orderable: false}
        ],
        columnDefs: [

        ],
        footerCallback: function(row, data, start, end, display) {
            let api = this.api();

            let intVal = function(i) {
                if(typeof i === "string") {
                    let match = i.match(/[\d,]+(?:\.\d+)?/);

                    if(match) {
                        return parseFloat(match[0].replace(/,/g, ''));
                    }
                }else if(typeof i === "number") {
                    return i;
                }

                return 0;
            }

            const totalMasak = api.column(2).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const pageTotalMasak = api.column(2, {page: 'current'}).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const totalGasMinyak = api.column(3).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const pageTotalGasMinyak = api.column(3, {page: 'current'}).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const totalKas = api.column(4).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const pageTotalKas = api.column(4, {page: 'current'}).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const totalTabungan = api.column(5).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const pageTotalTabungan = api.column(5, {page: 'current'}).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const totalBisaroh = api.column(6).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const pageTotalBisaroh = api.column(6, {page: 'current'}).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const totalTransport = api.column(7).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const pageTotalTransport = api.column(7, {page: 'current'}).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const totalDarurat = api.column(8).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const pageTotalDarurat = api.column(8, {page: 'current'}).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const totalIuran = api.column(9).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            const pageTotalIuran = api.column(9, {page: 'current'}).data().reduce(function(a, b) {
                return intVal(a) + intVal(b);
            }, 0);

            api.column(2).footer().innerHTML = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalMasak);
            api.column(3).footer().innerHTML = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalGasMinyak);
            api.column(4).footer().innerHTML = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalKas);
            api.column(5).footer().innerHTML = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalTabungan);
            api.column(6).footer().innerHTML = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalBisaroh);
            api.column(7).footer().innerHTML = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalTransport);
            api.column(8).footer().innerHTML = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalDarurat);
            api.column(9).footer().innerHTML = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalIuran);
        }
    });
});