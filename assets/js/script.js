function abrirModalEditar(id) {
    document.getElementById(id).style.display = "block";
}

function cerrarModalEditar(id) {
    document.getElementById(id).style.display = "none";
}

function abrirModalEliminar(id) {
    document.getElementById(id).style.display = "block";
}

function cerrarModalEliminar(id) {
    document.getElementById(id).style.display = "none";
}

window.onclick = function(event) {
    const modales = document.querySelectorAll('.modal-custom');
    modales.forEach(modal => {
        if (event.target === modal) {
            modal.style.display = "none";
        }
    });
};
