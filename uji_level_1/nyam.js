// SIDEBAR
let btn     = document.querySelector("#btn");
let btn1    = document.querySelector("#btn1");
let btn2    = document.querySelector("#btn2");
let sidebar = document.querySelector(".sidebar");

btn.onclick = function () {
    sidebar.classList.toggle("active");
}

btn1.onclick = function () {
    sidebar.classList.toggle("active");
}

btn2.onclick = function () {
    sidebar.classList.toggle("active");
}

// MODAL

var tambah = document.getElementById('tambah');
var modalcontainer = document.getElementById('modalcontainer');
var modalresi = document.getElementById('modalresi');

tambah.onclick = function() {
    modalcontainer.style.display = "block";
};

window.onclick = function(event) {
    if (event.target == modalcontainer | event.target == modalresi) {
        modalcontainer.style.display = "none";
        modalresi.style.display = "none";
    }
}

