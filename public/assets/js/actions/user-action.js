$("#form-create-user").submit(function (e) {
    e.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const formData = $(this).serialize();


    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: formData,
        dataType: "JSON",
        success: function (response) {

            if('errors' in response) {
                const errors = response.errors;
                const inputs = ["name", "email", "password"];

                inputs.forEach((input) => {
                    if(input in errors) {
                        $(`#${input}`).addClass("is-invalid").next().text(errors[input][0]);
                    }else {
                        $(`#${input}`).removeClass("is-invalid")
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
                    $("#user-table").DataTable().ajax.reload();
                    $("#form-create-user")[0].reset();
                    $(".close").click();
                }
            });
        },
        error: function(xhr) {
            console.log(xhr);
        }
    });
});

$("#btn-save").click(function (e) {
    e.preventDefault();

    $("#form-create-user").submit();

});

let id = null;

$("table").on("click", ".btn-edit", function (e) {
    e.preventDefault();

    id = this.id;

    $.ajax({
        type: "GET",
        url: `${$('#form-update-user').data('url')}/${id}/edit`,
        dataType: "JSON",
        success: function (response) {
            $("#form-update-user")[0].reset();
            $("#name-update").val(response.data.name);
            $("#email-update").val(response.data.email);
        },
        error: function(xhr) {
            console.log(xhr);
        }
    });
});


$("#form-update-user").submit(function (e) {
    e.preventDefault();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    const formData = $(this).serialize();

    $.ajax({
        type: "PUT",
        url: `${$(this).data('url')}/${id}`,
        data: formData,
        dataType: "JSON",
        success: function (response) {

            const inputs = ["name", "email", "password"];

            if('errors' in response) {
                const errors = response.errors;

                inputs.forEach((input) => {
                    if(input in errors) {
                        $(`#${input}-update`).addClass("is-invalid").next().text(errors[input][0]);
                    }else {
                        $(`#${input}-update`).removeClass("is-invalid")
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
                    $("#user-table").DataTable().ajax.reload();
                    $("#form-update-user")[0].reset();
                    $(".close").click();

                    inputs.forEach((input) => {
                        $(`${`#${input}-update`}`).next().text() !== "" ? $(`#${input}-update`).removeClass("is-invalid") : "";
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
            $("#form-update-user").submit();
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
                url: `${$("#user-table").data('url')}/${id}`,
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
                            $("#user-table").DataTable().ajax.reload();
                        }
                    });
                },
                error: function(xhr) {
                    console.log(xhr);
                }
            });
        }
    });
});