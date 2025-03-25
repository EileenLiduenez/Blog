<aside id="sidebar">
    <!-- 🔍 Buscador -->
    <div id="buscador" class="bloque">
        <h3>🔍 Buscar</h3>
        <form action="index.php?view=buscar" method="POST"> 
            <input type="text" name="busqueda" placeholder="Busca en la oscuridad..." required>
            <input type="submit" value="Buscar">
        </form>
    </div>

    <?php if (!isset($_SESSION['usuario'])) : ?>
        <!-- 🔒 Login -->
        <div id="login" class="bloque">
            <h3>🔒 Inicia Sesión</h3>
            <form action="index.php?view=usuarios/login" method="POST"> 
                <label for="email">Correo</label>
                <input type="email" id="email" name="email" required>
                
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
                
                <input type="submit" value="Entrar">
            </form>
        </div>

        <!-- 📜 Registro -->
        <div id="register" class="bloque">
            <h3>📜 Registro</h3>
            <form action="index.php?view=usuarios/registro" method="POST"> 
                <label for="nombre">Nombre</label>
                <input type="text" id="nombre" name="nombre" required>
                
                <label for="apellidos">Apellidos</label>
                <input type="text" id="apellidos" name="apellidos" required>
                
                <label for="email">Email</label>
                <input type="email" id="email_registro" name="email" required>
                
                <label for="password">Contraseña</label>
                <input type="password" id="password_registro" name="password" required>
                
                <input type="submit" name="submit" value="Registrar">
            </form>
        </div>

    <?php else : ?>
        <?php
session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
?>
        <!-- 👤 Usuario logueado -->
        <div id="usuario" class="bloque">
            <h3>Bienvenido, <?= $_SESSION['usuario']['nombre'] ?></h3>
            <div class="botones-login">
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCrear">Crear Entrada</button>
                <a href="index.php?view=usuarios/mis-datos" class="btn btn-info">Mis Datos</a>
                <a href="index.php?view=usuarios/logout" class="btn btn-danger">Cerrar Sesión</a>
            </div>
        </div>
    <?php endif; ?>
</aside>
