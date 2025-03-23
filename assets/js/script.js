document.addEventListener("DOMContentLoaded", function () {
    // 📌 Manejo del menú desplegable 
    const categorias = document.getElementById("categorias");
    const submenu = document.getElementById("submenu");

    submenu.style.display = "none"; // Mantiene el menú oculto

    categorias.addEventListener("click", function (event) {
        event.preventDefault();
        submenu.style.display = submenu.style.display === "block" ? "none" : "block";
    });

    document.addEventListener("click", function (event) {
        if (!categorias.contains(event.target) && !submenu.contains(event.target)) {
            submenu.style.display = "none";
        }
    });

    // 📌 Manejo de comentarios 
    const comentarios = document.querySelectorAll(".comentario");

    comentarios.forEach(comentario => {
        const botonEliminar = document.createElement("button");
        botonEliminar.textContent = "Eliminar";
        botonEliminar.classList.add("boton-eliminar");

        comentario.appendChild(botonEliminar);

        botonEliminar.addEventListener("click", function () {
            comentario.remove();
        });
    });

    // 📌 Validación de formularios
    function validarFormulario(formulario) {
        const inputs = formulario.querySelectorAll("input");
        let valido = true;

        inputs.forEach(input => {
            if (input.value.trim() === "") {
                input.style.border = "2px solid red";
                valido = false;
            } else {
                input.style.border = "2px solid green";
            }
        });

        return valido;
    }

    document.querySelectorAll("form").forEach(form => {
        form.addEventListener("submit", function (event) {
            if (!validarFormulario(this)) {
                event.preventDefault();
                alert("Por favor, completa todos los campos correctamente.");
            }
        });
    });


    async function cargarCategorias() {
        try {
            const response = await fetch("/api/categorias");
            const data = await response.json();

            window.categoriasData = data;
        } catch (error) {
            console.error("Error al cargar categorías:", error);
        }
    }

    async function cargarPublicaciones() {
        try {
            const response = await fetch("/api/publicaciones");
            const data = await response.json();

           window.publicacionesData = data;
        } catch (error) {
            console.error("Error al cargar publicaciones:", error);
        }
    }

    async function enviarPublicacion(titulo, contenido, categoria) {
        try {
            const response = await fetch("/api/publicaciones", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ titulo, contenido, categoria })
            });

            if (response.ok) {
                alert("Publicación creada con éxito");
                cargarPublicaciones(); // Recarga datos sin tocar el nav
            } else {
                alert("Error al crear publicación");
            }
        } catch (error) {
            console.error("Error al enviar publicación:", error);
        }
    }

    // Llamar a las funciones para obtener los datos
    cargarCategorias();
    cargarPublicaciones();
});