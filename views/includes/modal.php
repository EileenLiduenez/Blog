<!-- Modal Editar por cada entrada -->
<div id="modalEditar<?= $entrada['id'] ?>" class="modal-custom">
    <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarModalEditar('modalEditar<?= $entrada['id'] ?>')">&times;</span>
        <h2>✏️ Editar Entrada</h2>

        <form action="index.php?controller=entrada&action=editar" method="POST">
            <input type="hidden" name="id" value="<?= $entrada['id'] ?>">
            <label for="titulo">Título:</label>
            <input type="text" name="titulo" value="<?= htmlspecialchars($entrada['titulo']) ?>" required>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" required><?= htmlspecialchars($entrada['descripcion']) ?></textarea>
            <input type="submit" value="Actualizar">
        </form>

    </div>
</div>

<!-- Modal Eliminar por cada entrada -->
<div id="modalEliminar<?= $entrada['id'] ?>" class="modal-custom">
    <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarModalEliminar('modalEliminar<?= $entrada['id'] ?>')">&times;</span>
        <h2>🗑️ Eliminar Entrada</h2>
        <p>¿Estás seguro de eliminar esta entrada?</p>

        <form action="index.php?controller=entrada&action=eliminar" method="POST">
            <input type="hidden" name="id" value="<?= $entrada['id'] ?>">
            <input type="submit" value="Sí, eliminar">
            <button type="button" onclick="cerrarModalEliminar('modalEliminar<?= $entrada['id'] ?>')">Cancelar</button>
        </form>
        
    </div>
</div>
