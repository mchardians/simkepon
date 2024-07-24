$(document).ready(function () {
    $("#santri_id").select2({
        dropdownParent: $("#createModal"),
        placeholder: "Pilih Santri",
        ajax: {
            url: $("#santri_id").data("url"),
            dataType: 'json',
            processResults: function (response) {
                return {
                    results: response.data.map(function (item) {
                        return {
                            id: item.id,
                            text: `${item.name} (${item.nis})`
                        };
                    })
                };
            }
        }
    });

    const iuran = $("#iuran").select2({
        dropdownParent: $("#createModal"),
        placeholder: "Pilih Iuran",
    });

    $("#santri_id").on("change", function (e) {
        e.preventDefault();

        $.ajax({
            type: "GET",
            url: `${new URL(location).href}/create`,
            data: {
                'santri': $(this).val(),
            },
            dataType: "JSON",
            success: function (response) {
                const iurans = ['masak', 'gas_minyak', 'kas', 'tabungan', 'bisaroh', 'transport', 'darurat'];
                const data = response.data;
                let cicilableOptions = [];

                if(data !== null) {
                    const cicilables = Object.keys(data).filter(function (key) {
                        return data[key] === 0;
                    });

                    cicilableOptions = cicilables.map(function (key) {
                        return {
                            id: key,
                            text: key.charAt(0).toUpperCase() + key.slice(1)
                        };
                    });
                }else {
                    cicilableOptions = iurans.map(function (key) {
                        return key === 'gas_minyak' ? {
                            id: key,
                            text: 'Gas Minyak'
                        } : {
                            id: key,
                            text: key.charAt(0).toUpperCase() + key.slice(1)
                        };
                    });
                }
                iuran.select2('destroy').empty();

                iuran.select2({
                    placeholder: "Pilih Iuran",
                    data: cicilableOptions,
                });

                iuran.trigger("change");
            }
        });
    });

    $("#iuran").on("change", function (e) {
        e.preventDefault();

        const iurans = {
            'masak': 120000,
            'gas_minyak': 20000,
            'kas': 10000,
            'tabungan': 10000,
            'bisaroh': 15000,
            'transport': 10000,
            'darurat': 15000
        }

        if($(this).val() in iurans) {
            const IDR = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' });

            $("#saldo-iuran").text(IDR.format(iurans[$(this).val()]));
        }

        if($("#santri_id").val() !== null){
            $.ajax({
                type: "GET",
                url: new URL(location).href,
                data: {
                    'santri': $("#santri_id").val(),
                },
                dataType: "JSON",
                success: function (response) {
                    console.log($("#saldo-iuran").text().replace("Rp", "").replace(/\./g, "").replace(/,00/g, "").trim());
                }
            });
        }
    });

    $("#form-create-cicilan").submit(function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: $(this).data("url"),
            data: formData,
            dataType: "JSON",
            success: function (response) {
                const inputs = ['santri_id', 'amount', 'tempo', 'iuran', 'description'];

                if('errors' in response) {
                    const errors = response.errors;

                    inputs.forEach((input) => {
                        if(input in errors) {
                            $(`#${input}`).addClass("is-invalid");

                            if(input === "santri_id") {
                                $("#error-santri_id").text(errors[input][0]).show();
                                return;
                            }

                            if(input === "iuran") {
                                $("#error-iuran").text(errors[input][0]).show();
                                return;
                            }

                            $(`#${input}`).next().text(errors[input][0]);
                        }else {
                            $(`#${input}`).removeClass("is-invalid");

                            if(input === "santri_id") {
                                $("#error-santri_id").text("").hide();
                                return;
                            }

                            if(input === "iuran") {
                                $("#error-iuran").text("").show();
                                return;
                            }

                            $(`#${input}`).next().text("");
                        }
                    });

                    return;
                }

                Swal.fire({
                    title: "Success!",
                    text: response.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    icon: "success"
                }).then(function(result) {
                    if(result.isConfirmed) {
                        $("#cicilan-table").DataTable().ajax.reload();
                        $("#form-create-cicilan")[0].reset();
                        $('#santri_id').val(null).trigger('change');
                        $('#iuran').val(null).trigger('change');
                        $(".close").click();

                        inputs.forEach((input) => {
                            if($(`#${input}`).next().text() !== "") {
                                $(`#${input}`).removeClass("is-invalid");
                            }

                            if(input === "iuran") {
                                if($("#error-iuran").text() !== "") {
                                    $("#error-iuran").text("").hide();
                                }
                                return;
                            }

                            if(input === "santri_id") {
                                if($("#error-santri_id").text() !== "") {
                                    $("#error-santri_id").text("").hide();
                                }
                                return;
                            }
                        });
                    }
                });
            }
        });
    });

    $("#btn-save").click(function (e) {
        e.preventDefault();

        $("#form-create-cicilan").submit();
    });

    let id = null;

    $("table").on("click", ".btn-delete", function (e) {
        e.preventDefault();

        console.log(this.id);
    });
});