$(document).ready(function () {
    $("#yearpicker").datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years",
        autoclose: true,
    }).on('changeDate', function(e) {
        $("#yearpicker").datepicker('hide');

        $.ajax({
            type: "GET",
            url: new URL(location).href,
            data: {
                year: $("#yearpicker").val()
            },
            dataType: "JSON",
            success: function (response) {
                const masak = document.querySelectorAll("[data-iuran='masak']");
                const gasMinyak = document.querySelectorAll("[data-iuran='gas_minyak']");
                const kas = document.querySelectorAll("[data-iuran='kas']");
                const tabungan = document.querySelectorAll("[data-iuran='tabungan']");
                const bisaroh = document.querySelectorAll("[data-iuran='bisaroh']");
                const transport = document.querySelectorAll("[data-iuran='transport']");
                const darurat = document.querySelectorAll("[data-iuran='darurat']");
                const year = $("#yearpicker").val();

                masak.forEach(card => {
                    const attrMonth = card.closest(".card").querySelector("[data-month]").dataset.month;
                    const attrAmount = card.closest(".card").querySelector("[data-amount]").dataset.amount;
                    const payButton = card.closest(".card").querySelector(".btn-pay");

                    const isLunas = response.isLunas.some(res => {
                        return res.month === attrMonth && res.year.toString() === year &&
                        res.amount === parseInt(attrAmount) &&
                        res.iuran === card.dataset.iuran
                    });

                    if (isLunas) {
                        payButton.classList.remove('btn-primary');
                        payButton.classList.add('btn-success', 'disabled');
                        payButton.type = 'button';
                        payButton.textContent = 'Lunas';
                        payButton.disabled = true;
                    } else {
                        payButton.classList.remove('btn-success', 'disabled');
                        payButton.classList.add('btn-primary');
                        payButton.type = 'button';
                        payButton.textContent = 'Bayar';
                        payButton.disabled = false;
                    }
                });

                gasMinyak.forEach(card => {
                    const attrMonth = card.closest(".card").querySelector("[data-month]").dataset.month;
                    const attrAmount = card.closest(".card").querySelector("[data-amount]").dataset.amount;
                    const payButton = card.closest(".card").querySelector(".btn-pay");

                    const isLunas = response.isLunas.some(res => {
                        return res.month === attrMonth && res.year.toString() === year &&
                        res.amount === parseInt(attrAmount) &&
                        res.iuran === card.dataset.iuran
                    });

                    if (isLunas) {
                        payButton.classList.remove('btn-primary');
                        payButton.classList.add('btn-success', 'disabled');
                        payButton.type = 'button';
                        payButton.textContent = 'Lunas';
                        payButton.disabled = true;
                    } else {
                        payButton.classList.remove('btn-success', 'disabled');
                        payButton.classList.add('btn-primary');
                        payButton.type = 'button';
                        payButton.textContent = 'Bayar';
                        payButton.disabled = false;
                    }
                });

                kas.forEach(card => {
                    const attrMonth = card.closest(".card").querySelector("[data-month]").dataset.month;
                    const attrAmount = card.closest(".card").querySelector("[data-amount]").dataset.amount;
                    const payButton = card.closest(".card").querySelector(".btn-pay");

                    const isLunas = response.isLunas.some(res => {
                        return res.month === attrMonth && res.year.toString() === year &&
                        res.amount === parseInt(attrAmount) &&
                        res.iuran === card.dataset.iuran
                    });

                    if (isLunas) {
                        payButton.classList.remove('btn-primary');
                        payButton.classList.add('btn-success', 'disabled');
                        payButton.type = 'button';
                        payButton.textContent = 'Lunas';
                        payButton.disabled = true;
                    } else {
                        payButton.classList.remove('btn-success', 'disabled');
                        payButton.classList.add('btn-primary');
                        payButton.type = 'button';
                        payButton.textContent = 'Bayar';
                        payButton.disabled = false;
                    }
                });

                tabungan.forEach(card => {
                    const attrMonth = card.closest(".card").querySelector("[data-month]").dataset.month;
                    const attrAmount = card.closest(".card").querySelector("[data-amount]").dataset.amount;
                    const payButton = card.closest(".card").querySelector(".btn-pay");

                    const isLunas = response.isLunas.some(res => {
                        return res.month === attrMonth && res.year.toString() === year &&
                        res.amount === parseInt(attrAmount) &&
                        res.iuran === card.dataset.iuran
                    });

                    if (isLunas) {
                        payButton.classList.remove('btn-primary');
                        payButton.classList.add('btn-success', 'disabled');
                        payButton.type = 'button';
                        payButton.textContent = 'Lunas';
                        payButton.disabled = true;
                    } else {
                        payButton.classList.remove('btn-success', 'disabled');
                        payButton.classList.add('btn-primary');
                        payButton.type = 'button';
                        payButton.textContent = 'Bayar';
                        payButton.disabled = false;
                    }
                });

                bisaroh.forEach(card => {
                    const attrMonth = card.closest(".card").querySelector("[data-month]").dataset.month;
                    const attrAmount = card.closest(".card").querySelector("[data-amount]").dataset.amount;
                    const payButton = card.closest(".card").querySelector(".btn-pay");

                    const isLunas = response.isLunas.some(res => {
                        return res.month === attrMonth && res.year.toString() === year &&
                        res.amount === parseInt(attrAmount) &&
                        res.iuran === card.dataset.iuran
                    });

                    if (isLunas) {
                        payButton.classList.remove('btn-primary');
                        payButton.classList.add('btn-success', 'disabled');
                        payButton.type = 'button';
                        payButton.textContent = 'Lunas';
                        payButton.disabled = true;
                    } else {
                        payButton.classList.remove('btn-success', 'disabled');
                        payButton.classList.add('btn-primary');
                        payButton.type = 'button';
                        payButton.textContent = 'Bayar';
                        payButton.disabled = false;
                    }
                });

                transport.forEach(card => {
                    const attrMonth = card.closest(".card").querySelector("[data-month]").dataset.month;
                    const attrAmount = card.closest(".card").querySelector("[data-amount]").dataset.amount;
                    const payButton = card.closest(".card").querySelector(".btn-pay");

                    const isLunas = response.isLunas.some(res => {
                        return res.month === attrMonth && res.year.toString() === year &&
                        res.amount === parseInt(attrAmount) &&
                        res.iuran === card.dataset.iuran
                    });

                    if (isLunas) {
                        payButton.classList.remove('btn-primary');
                        payButton.classList.add('btn-success', 'disabled');
                        payButton.type = 'button';
                        payButton.textContent = 'Lunas';
                        payButton.disabled = true;
                    } else {
                        payButton.classList.remove('btn-success', 'disabled');
                        payButton.classList.add('btn-primary');
                        payButton.type = 'button';
                        payButton.textContent = 'Bayar';
                        payButton.disabled = false;
                    }
                });

                darurat.forEach(card => {
                    const attrMonth = card.closest(".card").querySelector("[data-month]").dataset.month;
                    const attrAmount = card.closest(".card").querySelector("[data-amount]").dataset.amount;
                    const payButton = card.closest(".card").querySelector(".btn-pay");

                    const isLunas = response.isLunas.some(res => {
                        return res.month === attrMonth && res.year.toString() === year &&
                        res.amount === parseInt(attrAmount) &&
                        res.iuran === card.dataset.iuran
                    });

                    if (isLunas) {
                        payButton.classList.remove('btn-primary');
                        payButton.classList.add('btn-success', 'disabled');
                        payButton.type = 'button';
                        payButton.textContent = 'Lunas';
                        payButton.disabled = true;
                    } else {
                        payButton.classList.remove('btn-success', 'disabled');
                        payButton.classList.add('btn-primary');
                        payButton.type = 'button';
                        payButton.textContent = 'Bayar';
                        payButton.disabled = false;
                    }
                });

                changePaidButtonState();
            }
        });

        $(".year").text($("#yearpicker").val());
    });

    $("#yearpicker").datepicker('setDate', new Date());

    $("#previousYear").click(function(e) {
        e.preventDefault();

        const currentYear = parseInt($("#yearpicker").val(), 10);

        if (!isNaN(currentYear)) {
            $("#yearpicker").datepicker('update', new Date(currentYear - 1, 0, 1));
            $('#yearpicker').datepicker('hide').trigger('changeDate');
        }
    });

    $("#nextYear").click(function(e) {
        e.preventDefault();

        const currentYear = parseInt($("#yearpicker").val(), 10);

        if (!isNaN(currentYear)) {
            $("#yearpicker").datepicker('update', new Date(currentYear + 1, 0, 1));
            $('#yearpicker').datepicker('hide').trigger('changeDate');
        }
    });

    function changePaidButtonState() {
        const buttonState = JSON.parse(localStorage.getItem("selected"));

        if(buttonState) {
            buttonState.forEach((item, index) => {
                if (item.disabled) {
                    const iuran = item.iuran;

                    switch(iuran) {
                        case "masak":
                            const masak = document.querySelectorAll("[data-iuran='masak']");

                            masak.forEach(card => {
                                const masakButton = card.closest(".card").querySelector(`button[data-index="${item.index}"`) || document.createElement("button");
                                masakButton.classList.remove('btn-primary');
                                masakButton.classList.add('btn-warning', 'disabled');
                                masakButton.type = 'button';
                                masakButton.textContent = 'Dipilih';
                                masakButton.disabled = true;
                            });

                            break;
                        case "gas_minyak":
                            const gasMinyak = document.querySelectorAll("[data-iuran='gas_minyak']");

                            gasMinyak.forEach(card => {
                                const gasMinyakButton = card.closest(".card").querySelector(`button[data-index="${item.index}"`) || document.createElement("button");
                                gasMinyakButton.classList.remove('btn-primary');
                                gasMinyakButton.classList.add('btn-warning', 'disabled');
                                gasMinyakButton.type = 'button';
                                gasMinyakButton.textContent = 'Dipilih';
                                gasMinyakButton.disabled = true;
                            });

                            break;
                        case "kas":
                            const kas = document.querySelectorAll("[data-iuran='kas']");

                            kas.forEach(card => {
                                const kasButton = card.closest(".card").querySelector(`button[data-index="${item.index}"`) || document.createElement("button");
                                kasButton.classList.remove('btn-primary');
                                kasButton.classList.add('btn-warning', 'disabled');
                                kasButton.type = 'button';
                                kasButton.textContent = 'Dipilih';
                                kasButton.disabled = true;
                            });

                            break;
                        case "tabungan":
                            const tabungan = document.querySelectorAll("[data-iuran='tabungan']");

                            tabungan.forEach(card => {
                                const tabunganButton = card.closest(".card").querySelector(`button[data-index="${item.index}"`) || document.createElement("button");
                                tabunganButton.classList.remove('btn-primary');
                                tabunganButton.classList.add('btn-warning', 'disabled');
                                tabunganButton.type = 'button';
                                tabunganButton.textContent = 'Dipilih';
                                tabunganButton.disabled = true;
                            });

                            break;
                        case "bisaroh":
                            const bisaroh = document.querySelectorAll("[data-iuran='bisaroh']");

                            bisaroh.forEach(card => {
                                const bisarohButton = card.closest(".card").querySelector(`button[data-index="${item.index}"`) || document.createElement("button");
                                bisarohButton.classList.remove('btn-primary');
                                bisarohButton.classList.add('btn-warning', 'disabled');
                                bisarohButton.type = 'button';
                                bisarohButton.textContent = 'Dipilih';
                                bisarohButton.disabled = true;
                            });

                            break;

                        case "transport":
                            const transport = document.querySelectorAll("[data-iuran='transport']");

                            transport.forEach(card => {
                                const transportButton = card.closest(".card").querySelector(`button[data-index="${item.index}"`) || document.createElement("button");
                                transportButton.classList.remove('btn-primary');
                                transportButton.classList.add('btn-warning', 'disabled');
                                transportButton.type = 'button';
                                transportButton.textContent = 'Dipilih';
                                transportButton.disabled = true;
                            });

                            break;
                        case "darurat":
                            const darurat = document.querySelectorAll("[data-iuran='darurat']");

                            darurat.forEach(card => {
                                const daruratButton = card.closest(".card").querySelector(`button[data-index="${item.index}"`) || document.createElement("button");
                                daruratButton.classList.remove('btn-primary');
                                daruratButton.classList.add('btn-warning', 'disabled');
                                daruratButton.type = 'button';
                                daruratButton.textContent = 'Dipilih';
                                daruratButton.disabled = true;
                            });

                            break;
                    }
                }
            });
        }
    }

    function renderIuran() {
        const detailIuran = localStorage.getItem(document.querySelector("span[data-nis]").dataset.nis);

        if (detailIuran) {
            let data = JSON.parse(detailIuran);
            const tbody = document.querySelector("#iuran-table tbody");

            tbody.innerHTML = "";

            let totalTagihan = 0;

            data.forEach((item, index) => {

                if(item.iuran === 'gas_minyak') {
                    item.iuran = 'Gas Minyak';
                }

                item.iuran = item.iuran.charAt(0).toUpperCase() + item.iuran.slice(1);

                const tr1 = document.createElement('tr');

                const thIuran = document.createElement('th');
                thIuran.textContent = item.iuran;
                thIuran.classList.add('border-top', 'border-dark');
                tr1.appendChild(thIuran);

                const tdAction = document.createElement('td');
                tdAction.classList.add('text-center', 'border-bottom', 'border-top', 'border-dark');
                tdAction.rowSpan = 3;
                tdAction.width = "20%";

                const actionButton = document.createElement('button');
                actionButton.classList.add('btn', 'btn-icon', 'btn-danger', 'btn-circle');
                actionButton.id = "btn-delete";
                actionButton.value = index;

                const icon = document.createElement('i');
                icon.classList.add('fas', 'fa-times');

                actionButton.appendChild(icon);
                tdAction.appendChild(actionButton);
                tr1.appendChild(tdAction);

                tbody.appendChild(tr1);

                const tr2 = document.createElement('tr');

                const tdTempo = document.createElement('td');
                tdTempo.textContent = item.month + ' ' + item.year;
                tr2.appendChild(tdTempo);

                tbody.appendChild(tr2);

                const tr3 = document.createElement('tr');

                const tdAmount = document.createElement('td');
                tdAmount.textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(item.amount);
                tdAmount.classList.add('border-bottom', 'border-dark');
                tr3.appendChild(tdAmount);

                tbody.appendChild(tr3);

                totalTagihan += parseInt(item.amount);
            });

            document.querySelector("#total").textContent = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(totalTagihan);
        }

    }

    $(document).on("click", ".btn-pay", function (e) {
        e.preventDefault();

        const nis = document.querySelector("span[data-nis]").dataset.nis;

        const card = this.closest(".card");

        const month = card.querySelector("[data-month]").dataset.month;
        const year = card.querySelector(".year").textContent.trim();
        const amount = card.querySelector("[data-amount]").dataset.amount;
        const iuran = card.querySelector("[data-iuran]").dataset.iuran;

        const data = JSON.parse(localStorage.getItem(nis)) || [];

        data.push({
            "month": month,
            "year": year,
            "amount": amount,
            "iuran": iuran,
        });

        localStorage.setItem(nis, JSON.stringify(data));

        const state = JSON.parse(localStorage.getItem("selected")) || [];

        state.push({
            "iuran": iuran,
            "index": $(this).data("index"),
            "disabled": true
        });

        localStorage.setItem("selected", JSON.stringify(state));

        renderIuran();
        changePaidButtonState();
    });

    $(document).on("click", "#btn-confirm", function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Konfirmasi Pembayaran?",
            text: "Anda yakin ingin mengkonfirmasi pembayaran?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            cancelButtonText: "Batal",
            confirmButtonText: "Konfirmasi"
        }).then((result) => {
            if (result.isConfirmed) {
                if(localStorage.getItem(document.querySelector("span[data-nis]").dataset.nis) !== null) {
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });

                    $.ajax({
                        type: "POST",
                        url: `${new URL(location).href}`,
                        data: {
                            "datas": JSON.parse(localStorage.getItem(document.querySelector("span[data-nis]").dataset.nis))
                        },
                        dataType: "JSON",
                        success: function (response) {
                            Swal.fire({
                                title: "Success!",
                                text: response.message,
                                allowOutsideClick: false,
                                allowEscapeKey: false,
                                icon: "success"
                            }).then(function(result) {
                                if(result.isConfirmed) {
                                    localStorage.removeItem(document.querySelector("span[data-nis]").dataset.nis);
                                    localStorage.removeItem("selected");
                                    window.location.href = response.redirect;
                                }
                            });
                        },
                        error: function (xhr) {
                            console.log(xhr.responseJSON);
                        }
                    });
                }else {
                    Swal.fire({
                        title: "Error!",
                        text: "Iuran tidak boleh kosong!",
                        icon: "error"
                    });
                }
            }
        });
    });

    $(document).on("click", "#btn-delete", function (e) {
        e.preventDefault();

        const nis = document.querySelector("span[data-nis]").dataset.nis;
        const data = JSON.parse(localStorage.getItem(nis)) || [];
        const buttonState = JSON.parse(localStorage.getItem("selected")) || [];

        const index = buttonState.splice($(this).val(), 1);
        data.splice($(this).val(), 1);

        localStorage.setItem(nis, JSON.stringify(data));
        localStorage.setItem("selected", JSON.stringify(buttonState));

        const iuran = document.querySelectorAll(`[data-iuran="${index[0].iuran}"]`);

        iuran.forEach(card => {
            const paidButton = card.closest(".card").querySelector(`button[data-index="${index[0].index}"]`) || document.createElement('button');

            paidButton.classList.add('btn-primary');
            paidButton.classList.remove('btn-warning', 'disabled');
            paidButton.type = 'button';
            paidButton.textContent = 'Bayar';
            paidButton.disabled = false;
        });

        renderIuran();
    });

    renderIuran();
});