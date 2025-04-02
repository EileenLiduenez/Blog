
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
                <input type="email" id="email" name="email" required>
                
                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>
                
                <input type="submit" value="Entrar">
            </form>
        </div>

        <!-- 📜 Registro -->
        <div id="register" class="bloque">
            <h3>📜 Registro</h3>
            <form action="registro.php" method="POST"> 
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
        <!-- 👤 Usuario logueado -->
        <div id="usuario" class="bloque">
            <h3>Bienvenido, <?= htmlspecialchars($_SESSION['usuario']['nombre']) ?></h3>
            <div class="botones-login">
                <a href="crear-entrada.php">➕ Crear Entrada</a>
                <a href="mis-datos.php">📁 Mis Datos</a>
                <a href="logout.php">🚪 Cerrar Sesión</a>
            </div>
        </div>
    <?php endif; ?>

