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


