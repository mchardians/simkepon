$(document).ready(function () {
    const cleaveAmountUpdate = new Cleave('#amount-update', {
        numeral: true,
        numeralThousandsGroupStyle: 'thousand'
    });

    $("#form-create-keuangan-keluar").submit(function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: formData,
            dataType: "JSON",
            success: function (response) {
                const inputs = ["date", "amount", "iuran", "description"];

                if('errors' in response) {
                    const errors = response.errors;

                    inputs.forEach((input) => {
                        if(input in errors) {
                            $(`#${input}`).addClass("is-invalid");

                            if(input === "iuran") {
                                $("#error-iuran").text(errors[input][0]).show();
                                return;
                            }

                            $(`#${input}`).next().text(errors[input][0]);
                        }else {
                            $(`#${input}`).removeClass("is-invalid");

                            if(input === "iuran") {
                                $("#error-iuran").text("").hide();
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
                }).then((result) => {
                    if(result.isConfirmed) {
                        $("#keuangan-keluar-table").DataTable().ajax.reload();
                        $("#form-create-keuangan-keluar")[0].reset();
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
                        });
                    }
                });
            },
            error: function(xhr) {
                $("#mutasiModal").modal('show')
            }
        });
    });

    $("#btn-save").click(function (e) {
        e.preventDefault();

        $("#form-create-keuangan-keluar").submit();
    });

    let id = null;

    $("table").on("click", ".btn-edit", function (e) {
        e.preventDefault();

        id = this.id;

        $.ajax({
            type: "GET",
            url: `${$("#form-update-keuangan-keluar").data("url")}/${this.id}/edit`,
            dataType: "JSON",
            success: function (response) {
                $("#date-update").val(moment(response.data.payment_date).format("DD-MM-YYYY"));
                cleaveAmountUpdate.setRawValue(response.data.amount);
                $("#address-update").val(response.data.address);
                $("#iuran-update").val(response.data.iuran).trigger('change');
                $("#description-update").val(response.data.description);
            }
        });
    });

    $("#form-update-keuangan-keluar").submit(function (e) {
        e.preventDefault();

        const formData = $(this).serialize();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "PUT",
            url: `${$(this).data("url")}/${id}`,
            data: formData,
            dataType: "JSON",
            success: function (response) {
                const inputs = ["date", "amount", "iuran", "description"];

                if('errors' in response) {
                    const errors = response.errors;

                    inputs.forEach((input) => {
                        if(input in errors) {
                            $(`#${input}-update`).addClass("is-invalid");

                            if(input === "iuran") {
                                $("#error-iuran-update").text(errors[input][0]).show();
                                return;
                            }

                            $(`#${input}-update`).next().text(errors[input][0]);
                        }else {
                            $(`#${input}-update`).removeClass("is-invalid");

                            if(input === "iuran") {
                                $("#error-iuran-update").text("").hide();
                                return;
                            }

                            $(`#${input}-update`).next().text("");
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
                }).then((result) => {
                    if(result.isConfirmed) {
                        $("#keuangan-keluar-table").DataTable().ajax.reload();
                        $("#form-update-keuangan-keluar")[0].reset();
                        $('#iuran-update').val(null).trigger('change');
                        $(".close").click();
                    }
                });
            },
            error: function(xhr) {
                $("#mutasiModal").modal('show')
            }
        });
    });

    $("#btn-update").click(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, update it!"
          }).then((result) => {
            if (result.isConfirmed) {
                $("#form-update-keuangan-keluar").submit();
            }
        });
    });

    $("#iuran").change(function (e) {
        e.preventDefault();

        $("#iuran-mutasi").val($(this).val()).trigger('change');
        $("#iuran-mutasi").attr("readonly", "readonly");
    });

    $("#source_iuran").selectric().on("change", function () {
        $.ajax({
            type: "GET",
            url: $(this).data("url"),
            data: {
                "source_iuran": $(this).val()
            },
            dataType: "JSON",
            success: function (response) {
                const IDR = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' });

                $("#saldo-source-iuran").text(IDR.format(response.amount));
            }
        });
    });

    $("#form-mutasi").submit(function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append("outcome", $("#amount").val());

        $.ajax({
            type: "POST",
            url: $(this).attr('action'),
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                const inputs = ["iuran", "source_iuran"];

                if('errors' in response) {
                    const errors = response.errors;

                    inputs.forEach((input) => {
                        if(input in errors) {
                            if(input === "source_iuran") {
                                $("#error-source-iuran").text(errors[input]).show();
                                return;
                            }else {
                                if(input === "source_iuran") {
                                    $("#error-source-iuran").text("").hide();
                                    return;
                                }
                            }
                        }
                    });

                    return;
                }

                Swal.fire({
                    title: "Success!",
                    text: response.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    icon: "success",
                }).then((result) => {
                    if(result.isConfirmed) {
                        $("#close-mutasi").click();
                        $("#iuran-mutasi").val(null).trigger('change');
                        $("#source_iuran").selectric('refresh');
                        $("#form-mutasi")[0].reset();
                    }
                });
            }
        });
    });

    $("#btn-transfer").click(function (e) {
        e.preventDefault();

        $("#form-mutasi").submit();
    });
});