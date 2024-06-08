$("#form-create-walisantri").submit(function (e) {
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
            const inputs = ["nik", "name", "email", "education", "job", "phone", "address"];

            if('errors' in response) {
                const errors = response.errors;

                inputs.forEach((input) => {
                    if(input in errors) {
                        $(`#${input}`).addClass("is-invalid");
                        $(`#${input}`).next().text(errors[input][0]);

                        if(input === "education") {
                            $("#error-education").text(errors[input][0]).show();
                        }
                    }else {
                        $(`#${input}`).removeClass("is-invalid");
                        $(`#${input}`).next().text("");

                        if(input === "education") {
                            $("#error-education").text("").hide();
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
                icon: "success"
            }).then(function(result) {
                if(result.isConfirmed) {
                    $("#walisantri-table").DataTable().ajax.reload();
                    $("#form-create-walisantri")[0].reset();
                    $(".close").click();

                    inputs.forEach((input) => {
                        $(`#${input}`).removeClass("is-invalid");

                        if(input === "education") {
                            $("#error-education").text("").hide();
                            return;
                        }

                        $(`#${input}`).next().text("");
                    });
                }
            });
        }
    });
});

$("#btn-save").click(function (e) {
    e.preventDefault();

    $("#form-create-walisantri").submit();
});

let id = null;

$("table").on("click", ".btn-edit", function (e) {
    e.preventDefault();

    id = this.id;

    const phoneInputUpdate = new Cleave('#phone-update', {
        phone: true,
        phoneRegionCode: 'ID',
    });

    $.ajax({
        type: "GET",
        url: `${$('#form-update-walisantri').data('url')}/${id}/edit`,
        dataType: "JSON",
        success: function (response) {
            $("#form-update-walisantri")[0].reset();
            $("#nik-update").val(response.data.nik);
            $("#name-update").val(response.data.name);
            $("#email-update").val(response.data.email);
            $("#education-update").val(response.data.education).change().selectric('refresh');
            $("#job-update").val(response.data.job);
            phoneInputUpdate.setRawValue(response.data.phone);
            $("#address-update").val(response.data.address);
        }
    });
});

$("#form-update-walisantri").submit(function (e) {
    e.preventDefault();

    const formData = $(this).serialize();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "PUT",
        url: `${$(this).data('url')}/${id}`,
        data: formData,
        dataType: "JSON",
        success: function (response) {

            const inputs = ["nik", "name", "email", "education", "job", "phone", "address"];

            if('errors' in response) {
                const errors = response.errors;

                inputs.forEach((input) => {
                    if(input in errors) {
                        $(`#${input}-update`).addClass("is-invalid");
                        $(`#${input}-update`).next().text(errors[input][0]);

                        if(input === "education") {
                            $("#error-education-update").text(errors[input][0]).show();
                        }
                    }else {
                        $(`#${input}-update`).removeClass("is-invalid");
                        $(`#${input}-update`).next().text("");

                        if(input === "education") {
                            $("#error-education-update").text("").hide();
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
                icon: "success"
            }).then(function(result) {
                if(result.isConfirmed) {
                    $("#walisantri-table").DataTable().ajax.reload();
                    $("#form-update-walisantri")[0].reset();
                    $(".close").click();

                    inputs.forEach((input) => {
                        if($(`${`#${input}-update`}`).next().text() !== "") {
                            $(`#${input}-update`).removeClass("is-invalid");
                        }

                        if(input === "education") {
                            $("#error-education-update").text("").hide();
                        }
                    });
                }
            });
        },
        error: function(xhr) {
            console.log(xhr);
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
            $("#form-update-walisantri").submit();
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
                url: `${$("#walisantri-table").data('url')}/${id}`,
                dataType: "JSON",
                success: function (response) {
                    Swal.fire({
                        title: "Success!",
                        text: response.message,
                        icon: "success",
                        allowEscapeKey: false,
                        allowOutsideClick: false
                    }).then((result) => {
                        if(result.isConfirmed) {
                            $("#walisantri-table").DataTable().ajax.reload();
                        }
                    });
                },
                error: function(xhr) {
                    console.log(xhr.responseJSON.message);
                    Swal.fire({
                        icon: "error",
                        title: "Oops...",
                        html: `
                                <div>Gagal menghapus Wali Santri!</div>
                                <div>Silahkan hapus data santri terkait terlebih dahulu.</div>
                        `,
                        footer: '<a href="#">Why do I have this issue?</a>'
                    });
                }
            });
        }
    });
});