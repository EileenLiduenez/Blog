// Función para manejar el buscador
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

// Función para validar el formulario de login
document.querySelector('#login form').addEventListener('submit', function (e) {
    const email = document.querySelector('#email').value.trim();
    const password = document.querySelector('#password').value.trim();

    if (email === '' || password === '') {
        e.preventDefault(); // Evita el envío si hay campos vacíos
        alert('Por favor, completa todos los campos.');
    }
});

// Función para validar el formulario de registro
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