$(document).ready(function () {
    $("table").on("click", ".btn-detail", function (e) {
        e.preventDefault();

        $.ajax({
            type: "GET",
            url: `${$("#keuangan-masuk-table").data("url")}/${this.id}/detail`,
            data: {
                "id": this.id
            },
            dataType: "JSON",
            success: function (response) {
                const data = response.data;
                const tbody = document.querySelector("#detail-pemasukan-table tbody");
                tbody.innerHTML = "";

                data.forEach((item, index) => {
                    const tr = document.createElement('tr');

                    const tdNo = document.createElement('td');
                    tdNo.classList.add('text-center');
                    tdNo.textContent = index + 1;
                    tr.appendChild(tdNo);

                    const tdTempo = document.createElement('td');
                    tdTempo.textContent = item.month + ' ' + item.year;
                    tr.appendChild(tdTempo);

                    if(item.iuran === 'gas_minyak') {
                        item.iuran = 'Gas & Minyak';
                    }else {
                        item.iuran = item.iuran.charAt(0).toUpperCase() + item.iuran.slice(1);
                    }

                    const tdIuran = document.createElement('td');
                    tdIuran.textContent = item.iuran;
                    tr.appendChild(tdIuran);

                    const tdAmount = document.createElement('td');
                    tdAmount.textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(item.amount);
                    tr.appendChild(tdAmount);

                    tbody.appendChild(tr);
                });
            }
        });
    });
});