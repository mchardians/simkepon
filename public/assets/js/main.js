const btnStart = document.getElementById("btn-start");
const btnLogout = document.getElementById("btn-logout");
const socket = io("http://127.0.0.1:3000");

btnStart.addEventListener("click", function(e) {
    e.preventDefault();

    socket.emit("start");
});

btnLogout.addEventListener("click", function(e) {
    e.preventDefault();

    socket.emit("logout");

    localStorage.removeItem("qr");
    localStorage.setItem("state", "UNPAIRED");

    showLoaders(unpaired);
    $("#state span").remove();
    $(`<span class="text-warning"> Pending</span>`).appendTo("#state");
});

function QrCodeInit() {
    const qrElement = document.getElementById("qrCode");
    qrElement.innerHTML = "";

    new QRCode(qrElement, {
        text: localStorage.getItem("qr"),
        width: 200,
        height: 200,
        correctLevel: QRCode.CorrectLevel.H,
    });
}

function showLoaders(src) {
    $("#qrCode").css("display", "none");
    $("#loaders").css("display", "block");
    $("#loaders").attr("src", src);
}

function renderQRCode() {
    $("#loaders").css("display", "none");
    $("#qrCode").css({"display": "flex", "justify-content": "center", "align-items": "center"});
}

socket.on("qr", function(qr) {
    QrCodeInit(qr);

    localStorage.setItem("qr", qr);
});

socket.on("change_state", function(state) {

    switch (state) {
        case "UNPAIRED_IDLE":
            QrCodeInit(localStorage.getItem("qr"));
            renderQRCode();

            $("#state span").remove();
            $("<span class='text-danger'> Unpaired</span>").appendTo("#state");
            break;
        case "PAIRED":
            showLoaders(paired);
            $("#state span").remove();
            $("<span class='text-success'> Paired</span>").appendTo("#state");
            break;
        default:
            showLoaders(unpaired);
            $("#state span").remove();
            $("<span class='text-warning'> Pending</span>").appendTo("#state");
            break;
    }

    localStorage.setItem("state", state);
});

const isPageReloaded = () => {
    return (
        (window.performance.navigation && window.performance.navigation.type === 1) ||
        window.performance.getEntriesByType('navigation').map(entry => entry.type).
        includes('reload')
    );
}

document.addEventListener("DOMContentLoaded", function() {
    if(isPageReloaded()) {
        if(localStorage.getItem("qr") !== null && localStorage.getItem("state") === "UNPAIRED_IDLE") {
            QrCodeInit(localStorage.getItem("qr"));
            renderQRCode();

            switch (localStorage.getItem("state")) {
                case "UNPAIRED_IDLE":
                    QrCodeInit(localStorage.getItem("qr"));
                    renderQRCode();

                    $("#state span").remove();
                    $("<span class='text-danger'> Unpaired</span>").appendTo("#state");
                    break;
                case "PAIRED":
                    showLoaders(paired);
                    $("#state span").remove();
                    $("<span class='text-success'> Paired</span>").appendTo("#state");
                    break;
                default:
                    showLoaders(unpaired);
                    $("#state span").remove();
                    $("<span class='text-warning'> Pending</span>").appendTo("#state");
                    break;
            }
            return;
        }
    }

    switch (localStorage.getItem("state")) {
        case "UNPAIRED_IDLE":
            QrCodeInit(localStorage.getItem("qr"));
            renderQRCode();

            $("#state span").remove();
            $("<span class='text-danger'> Unpaired</span>").appendTo("#state");
            break;
        case "PAIRED":
            showLoaders(paired);
            $("#state span").remove();
            $("<span class='text-success'> Unpaired</span>").appendTo("#state");
            break;
        default:
            showLoaders(unpaired);
            $("#state span").remove();
            $("<span class='text-warning'> Pending</span>").appendTo("#state");
            break;
    }
});