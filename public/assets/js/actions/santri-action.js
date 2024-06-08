$("#wali_santri_id").load($("#wali_santri_id").data("url"), function (response, status, request) {
    $(this).append(new Option("Pilih Wali Santri", "", true, true)).trigger("change");

    if(status === "success") {
        const walisantri = JSON.parse(response);

        walisantri.wali_santri.forEach((walisantri) => {
            $(this).append(new Option(`${walisantri.name} (${walisantri.nik})`, walisantri.id, false, false)).trigger("change");
        });
    }
});

$("#wali_santri_id-update").load($("#wali_santri_id-update").data("url"), "data", function (response, status, request) {
    $(this).append(new Option("Pilih Wali Santri", "", true, true)).trigger("change");

    if(status === "success") {
        const walisantri = JSON.parse(response);

        walisantri.wali_santri.forEach((walisantri) => {
            $(this).append(new Option(`${walisantri.name} (${walisantri.nik})`, walisantri.id, false, false)).trigger("change");
        });
    }
});

$("#form-create-santri").submit(function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {

            const inputs = ["nis", "name", "gender", "birth_place", "birth_date", "wali_santri_id", "picture", "address"];

            if('errors' in response) {
                const errors = response.errors;

                inputs.forEach((input) => {
                    if(input in errors) {
                        $(`#${input}`).addClass("is-invalid");

                        if(input === "gender") {
                            $("#error-gender").text(errors[input][0]).show();
                            return;
                        }

                        if(input === "wali_santri_id") {
                            $("#error-wali_santri_id").text(errors[input][0]).show();
                            return;
                        }

                        $(`#${input}`).next().text(errors[input][0]);
                    }else {
                        $(`#${input}`).removeClass("is-invalid");

                        if(input === "gender") {
                            $("#error-gender").text("").hide();
                            return;
                        }

                        if(input === "wali_santri_id") {
                            $("#error-wali_santri_id").text("").hide();
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
                    $("#santri-table").DataTable().ajax.reload();
                    $("#form-create-santri")[0].reset();
                    $("#gender").selectric('refresh');
                    $('#wali_santri_id').val(null).trigger('change');
                    $(".close").click();

                    inputs.forEach((input) => {
                        if($(`#${input}`).next().text() !== "") {
                            $(`#${input}`).removeClass("is-invalid");
                        }

                        if(input === "gender") {
                            if($("#error-gender").text() !== "") {
                                $("#error-gender").text("").hide();
                            }
                            return;
                        }

                        if(input === "wali_santri_id") {
                            if($("#error-wali_santri_id").text() !== "") {
                                $("#error-wali_santri_id").text("").hide();
                            }
                            return;
                        }
                    });

                    $("#image-preview").removeAttr("style");
                }
            });
        }
    });
});

$("#btn-save").click(function (e) {
    e.preventDefault();

    $("#form-create-santri").submit();
});

let id = null;

$("table").on("click", ".btn-edit", function (e) {
    e.preventDefault();

    id = this.id;

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "GET",
        url: `${$("#form-update-santri").data("url")}/${id}/edit`,
        dataType: "JSON",
        success: function (response) {
            $("#form-update-santri")[0].reset();
            $("#nis-update").val(response.data.nis);
            $("#name-update").val(response.data.name);
            $("#gender-update").val(response.data.gender).change().selectric('refresh');
            $("#birth_place-update").val(response.data.birth_place);
            $("#birth_date-update").val(response.data.birth_date.split('-').reverse().join('-'));
            $("#wali_santri_id-update").val(response.data.wali_santri_id).trigger('change');
            $("#address-update").val(response.data.address);
            if(('picture' in response.data && response.data.picture !== null) && response.data.url !== null) {
                $("#image-preview-update").css({
                    "background-image": "url(" + response.data.url + ")",
                    "background-size": "cover",
                    "background-position": "center center"
                });
                $("#image-label-update").text("CHANGE FILE");

                return;
            }

            $("#image-preview-update").removeAttr("style");
            $("#image-label-update").text("CHOOSE FILE");
        }
    });
});

$("#form-update-santri").submit(function (e) {
    e.preventDefault();

    const formData = new FormData(this);
    formData.append("_method", "PUT");

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: `${$(this).data("url")}/${id}`,
        data: formData,
        contentType: false,
        processData: false,
        success: function (response) {

            const inputs = ["nis", "name", "gender", "birth_place", "birth_date", "wali_santri_id", "picture", "address"];

            if('errors' in response) {
                const errors = response.errors;

                inputs.forEach((input) => {
                    if(input in errors) {
                        $(`#${input}-update`).addClass("is-invalid");

                        if(input === "gender") {
                            $("#error-gender-update").text(errors[input][0]).show();
                            return;
                        }

                        if(input === "wali_santri_id") {
                            $("#error-wali_santri_id-update").text(errors[input][0]).show();
                            return;
                        }

                        $(`#${input}-update`).next().text(errors[input][0]);
                    }else {
                        $(`#${input}-update`).removeClass("is-invalid");

                        if(input === "gender") {
                            $("#error-gender-update").text("").hide();
                            return;
                        }

                        if(input === "wali_santri_id") {
                            $("#error-wali_santri_id-update").text("").hide();
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
                    $("#santri-table").DataTable().ajax.reload();
                    $("#form-create-santri")[0].reset();
                    $("#gender-update").selectric('refresh');
                    $('#wali_santri_id-update').val(null).trigger('change');
                    $(".close").click();

                    inputs.forEach((input) => {
                        if($(`#${input}-update`).next().text() !== "") {
                            $(`#${input}-update`).removeClass("is-invalid");
                        }

                        if(input === "gender") {
                            $("#error-gender-update").text("").hide();
                            return;
                        }

                        if(input === "wali_santri_id") {
                            $("#error-wali_santri_id-update").text("").hide();
                            return;
                        }
                    });
                }
            })
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
            $("#form-update-santri").submit();
        }
    });
});

$("table").on("click", ".btn-delete", function (e) {
    e.preventDefault();

    id = this.id;

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
          });

          $.ajax({
            type: "DELETE",
            url: `${$("#santri-table").data("url")}/${id}`,
            dataType: "JSON",
            success: function (response) {
                Swal.fire({
                    title: "Success!",
                    text: response.message,
                    allowOutsideClick: false,
                    allowEscapeKey: false,
                    icon: "success"
                }).then((result) => {
                    if(result.isConfirmed) {
                        $("#santri-table").DataTable().ajax.reload();
                    }
                });
            }
          });
        }
      });
});