// 📌 Función para manejar el buscador
document.querySelector('#buscador form').addEventListener('submit', function (e) {
    e.preventDefault(); // Evita el envío por defecto
    const busqueda = document.querySelector('input[name="busqueda"]').value.trim();
    if (busqueda === '') {
        alert('Por favor, escribe algo para buscar.');
    } else {
        // Redirigir al backend con el término de búsqueda
        window.location.href = `buscar.php?query=${encodeURIComponent(busqueda)}`;
    }
});

// 📌 Función para validar el formulario de login
document.querySelector('#login form').addEventListener('submit', function (e) {
    const email = document.querySelector('#email').value.trim();
    const password = document.querySelector('#password').value.trim();

    if (email === '' || password === '') {
        e.preventDefault(); // Evita el envío si hay campos vacíos
        alert('Por favor, completa todos los campos.');
    }
});

// 📌 Función para validar el formulario de registro
document.querySelector('#register form').addEventListener('submit', function (e) {
    const nombre = document.querySelector('#nombre').value.trim();
    const apellidos = document.querySelector('#apellidos').value.trim();
    const email = document.querySelector('#email_registro').value.trim();
    const password = document.querySelector('#password_registro').value.trim();

    if (nombre === '' || apellidos === '' || email === '' || password === '') {
        e.preventDefault(); // Evita el envío si hay campos vacíos
        alert('Por favor, completa todos los campos.');
    } else {
        // Mostrar mensaje de éxito (simulado)
        document.querySelector('.alerta-exito').style.display = 'block';
        document.querySelector('.alerta-error').style.display = 'none';
    }
});

// 📌 Llenar el modal de edición con los datos de la entrada
function llenarModal(id, titulo, contenido, categoria) {
    document.getElementById("edit-id").value = id;
    document.getElementById("edit-titulo").value = titulo;
    document.getElementById("edit-contenido").value = contenido;
    document.getElementById("edit-categoria").value = categoria;

    // Cambia la acción del formulario para enviar la edición correcta
    document.getElementById("form-editar").action = "index.php?view=entradas/editar&id=" + id;

    // Abre el modal con Bootstrap
    let modal = new bootstrap.Modal(document.getElementById("modalEditar"));
    modal.show();
}

// 📌 Confirmar eliminación de entrada
function confirmarEliminar(id) {
    if (confirm("¿Estás seguro de que quieres eliminar esta entrada?")) {
        window.location.href = "index.php?view=entradas/eliminar&id=" + id;
    }
}
