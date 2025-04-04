<!-- includes/modales_editar_eliminar.php -->

<?php if (isset($_SESSION['usuario'])): ?>
    <!-- Modal Editar -->
    <div id="modalEditarEntrada" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalEditar()">&times;</span>
            <h2>✏️ Editar Entrada</h2>
            <form id="formEditarEntrada" action="index.php?controller=entrada&action=editar" method="POST">
                <input type="hidden" name="id" id="editar-id">
                <label for="editar-titulo">Título:</label>
                <input type="text" name="titulo" id="editar-titulo" required>
                <label for="editar-descripcion">Descripción:</label>
                <textarea name="descripcion" id="editar-descripcion" required></textarea>
                <input type="submit" value="Actualizar">
            </form>
        </div>
    </div>

    <!-- Modal Eliminar -->
    <div id="modalEliminarEntrada" class="modal">
        <div class="modal-contenido">
            <span class="cerrar" onclick="cerrarModalEliminar()">&times;</span>
            <h2>🗑️ Eliminar Entrada</h2>
            <p>¿Estás segura de eliminar esta entrada?</p>
            <form id="formEliminarEntrada" action="index.php?controller=entrada&action=eliminar" method="POST">
                <input type="hidden" name="id" id="eliminar-id">
                <input type="submit" value="Sí, eliminar">
                <button type="button" onclick="cerrarModalEliminar()">Cancelar</button>
            </form>
        </div>
    </div>


    <script>
    function abrirModalEditar(id, titulo, descripcion) {
        document.getElementById("modalEditarEntrada").style.display = "block";
        document.getElementById("editar-id").value = id;
        document.getElementById("editar-titulo").value = titulo;
        document.getElementById("editar-descripcion").value = descripcion;
    }

    function cerrarModalEditar() {
        document.getElementById("modalEditarEntrada").style.display = "none";
    }

    function abrirModalEliminar(id) {
        document.getElementById("modalEliminarEntrada").style.display = "block";
        document.getElementById("eliminar-id").value = id;
    }

    function cerrarModalEliminar() {
        document.getElementById("modalEliminarEntrada").style.display = "none";
    }
    </script>
<?php endif; ?>
