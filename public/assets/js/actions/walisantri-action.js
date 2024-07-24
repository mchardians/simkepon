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

$("table").on("click", ".btn-detail", function (e) {
    e.preventDefault();

    id = this.id;

    $.ajax({
        type: "GET",
        url: `${$("#walisantri-table").data("url")}/${id}`,
        dataType: "JSON",
        success: function (response) {
            const data = response.data;
            const tbody = document.querySelector("#info-table tbody");

            tbody.innerHTML = "";

            const tr1 = document.createElement('tr');

            const th1 = document.createElement("th");
            th1.textContent = "NIK";
            tr1.appendChild(th1);
            const td1 = document.createElement("td");
            td1.textContent = ":";
            tr1.appendChild(td1);
            const td2 = document.createElement("td");
            td2.textContent = data.nik;
            tr1.appendChild(td2);

            tbody.appendChild(tr1);

            const tr2 = document.createElement('tr');

            const th2 = document.createElement("th");
            th2.textContent = "Nama";
            tr2.appendChild(th2);
            const td3 = document.createElement("td");
            td3.textContent = ":";
            tr2.appendChild(td3);
            const td4 = document.createElement("td");
            td4.textContent = data.name;
            tr2.appendChild(td4);

            tbody.appendChild(tr2);

            const tr3 = document.createElement('tr');

            const th3 = document.createElement("th");
            th3.textContent = "Email";
            tr3.appendChild(th3);
            const td5 = document.createElement("td");
            td5.textContent = ":";
            tr3.appendChild(td5);
            const td6 = document.createElement("td");
            td6.textContent = data.email;
            tr3.appendChild(td6);

            tbody.appendChild(tr3);

            const tr4 = document.createElement('tr');

            const th4 = document.createElement("th");
            th4.textContent = "Pendidikan";
            tr4.appendChild(th4);
            const td7 = document.createElement("td");
            td7.textContent = ":";
            tr4.appendChild(td7);
            const td8 = document.createElement("td");

            switch(data.education) {
                case "sd":
                    data.education = "SD/ Sederajat";
                    break;
                case "smp":
                    data.education = "SMP/ Sederajat";
                    break;
                case "sma":
                    data.education = "SMA/ Sederajat";
                    break;
                case "diploma":
                    data.education = "Diploma I-III";
                    break;
                case "sarjana":
                    data.education = "Diploma IV/ Strata I";
                    break;
                case "magister":
                    data.education = "Strata II";
                    break;
                case "doktor":
                    data.education = "Strata III";
                    break;
                default:
                    data.education = "Belum Sekolah";
            }

            td8.textContent = data.education;
            tr4.appendChild(td8);

            tbody.appendChild(tr4);

            const tr5 = document.createElement('tr');

            const th5 = document.createElement("th");
            th5.textContent = "Pekerjaan";
            tr5.appendChild(th5);
            const td9 = document.createElement("td");
            td9.textContent = ":";
            tr5.appendChild(td9);
            const td10 = document.createElement("td");
            td10.textContent = data.job;
            tr5.appendChild(td10);

            tbody.appendChild(tr5);

            const tr6 = document.createElement('tr');

            const th6 = document.createElement("th");
            th6.textContent = "Telepon";
            tr6.appendChild(th6);
            const td11 = document.createElement("td");
            td11.textContent = ":";
            tr6.appendChild(td11);
            const td12 = document.createElement("td");
            td12.textContent = data.phone;
            tr6.appendChild(td12);

            tbody.appendChild(tr6);

            const tr7 = document.createElement('tr');

            const th7 = document.createElement("th");
            th7.textContent = "Alamat";
            tr7.appendChild(th7);
            const td13 = document.createElement("td");
            td13.textContent = ":";
            tr7.appendChild(td13);
            const td14 = document.createElement("td");
            td14.textContent = data.address;
            tr7.appendChild(td14);

            tbody.appendChild(tr7);
        }
    });
});