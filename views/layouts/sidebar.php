

<!-- 🔍 Buscador -->
<div id="buscador" class="bloque">
    <h3>🔍 Buscar</h3>
    <form action="buscar.php" method="POST"> 
        <input type="text" name="busqueda" placeholder="Busca en la oscuridad..." required>
        <input type="submit" value="Buscar">
    </form>
</div>

<?php if (!isset($_SESSION['usuario'])) : ?>
    <!-- 🔒 Login -->
    <div id="login" class="bloque">
        <h3>🔒 Inicia Sesión</h3>
        <form action="login.php" method="POST"> 
            <label for="email">Correo</label>
            <input type="email" name="email" required>
            
            <label for="password">Contraseña</label>
            <input type="password" name="password" required>
            
            <input type="submit" value="Entrar">
        </form>
    </div>

    <!-- 📜 Registro -->
<div id="register" class="bloque">
    <h3>📜 Registro</h3>
    <form action="register.php" method="POST"> 
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" required>
        
        <label for="apellidos">Apellidos</label>  <!-- Agregar campo apellido -->
        <input type="text" name="apellidos" required>
        
        <label for="email">Email</label>
        <input type="email" name="email" required>
        
        <label for="password">Contraseña</label>
        <input type="password" name="password" required>
        
        <input type="submit" value="Registrar">
    </form>
</div>


<?php else : ?>
        <!-- Usuario logueado -->
    <div id="usuario" class="bloque">
        <h3>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></h3>
        <div class="botones-login">
            <button onclick="abrirModalCrearEntrada()">➕ Crear Entrada</button> <!-- Abre el modal -->
            <li><a href="index.php?controller=usuario&action=misDatos">Mis datos</a></li>
            <a href="logout.php">🚪 Cerrar Sesión</a>
        </div>
    </div>

<!-- Modal para crear una entrada -->
<div id="modalEntrada" class="modal">
    <div class="modal-contenido">
        <span class="cerrar" onclick="cerrarModalCrearEntrada()">&times;</span>
        <h2>➕ Crear Nueva Entrada</h2>

        <form action="crear_entrada.php" method="POST">
            <label for="titulo">Título</label>
            <input type="text" id="titulo" name="titulo" required>

            <label for="descripcion">Descripción</label>
            <textarea id="descripcion" name="descripcion" required></textarea>

            <label for="categoria">Categoría</label>
            <select id="categoria" name="categoria" required>
                <?php
                require_once "config/database.php";
                $db = new Database();
                $conn = $db->conectar();
                $query = "SELECT * FROM categorias";
                $categorias = $conn->query($query);
                while ($categoria = $categorias->fetch_assoc()) :
                ?>
                    <option value="<?= $categoria['id'] ?>"><?= $categoria['nombre'] ?></option>
                <?php endwhile; ?>
            </select>

            <input type="submit" value="Guardar">
        </form>
    </div>
</div>

<!-- Estilos para el modal -->
<style>
.modal {
    display: none;
    position: fixed;
    z-index: 1000;
    padding-top: 60px;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.5);
}
.modal-contenido {
    background-color: #fff;
    margin: auto;
    padding: 20px;
    border-radius: 8px;
    width: 90%;
    max-width: 500px;
    position: relative;
}
.cerrar {
    color: #aaa;
    position: absolute;
    top: 10px;
    right: 15px;
    font-size: 28px;
    font-weight: bold;
    cursor: pointer;
}
.cerrar:hover {
    color: #000;
}
</style>

<!-- JavaScript para abrir/cerrar modal de crear entrada -->
<script>
function abrirModalCrearEntrada() {
    document.getElementById("modalEntrada").style.display = "block";
}
function cerrarModalCrearEntrada() {
    document.getElementById("modalEntrada").style.display = "none";
}
</script>


<?php endif; ?>


