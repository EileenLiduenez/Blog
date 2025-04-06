<?php /*
if (!isset($_SESSION["usuario"])) {
    echo "<script>alert('Debes iniciar sesión para ver tus datos.'); window.location.href='index.php';</script>";
    exit();
} ?>

<h1>👤 Mis Datos</h1>

<div class="perfil-usuario">
    <p><strong>Nombre:</strong> <?= htmlspecialchars($_SESSION["usuario"]["nombre"]) ?></p>
    <p><strong>Apellidos:</strong> <?= htmlspecialchars($_SESSION["usuario"]["apellidos"]) ?></p>
    <p><strong>Email:</strong> <?= htmlspecialchars($_SESSION["usuario"]["email"]) ?></p>
    <p><strong>Fecha de Registro:</strong> <?= $_SESSION["usuario"]["fecha"] ?></p>
</div>

<h2>✏️ Editar Datos</h2>
<form action="index.php?view=usuarios/editar" method="POST">
    <label for="nombre">Nombre:</label>
    <input type="text" name="nombre" value="<?= htmlspecialchars($_SESSION["usuario"]["nombre"]) ?>" required>

    <label for="apellidos">Apellidos:</label>
    <input type="text" name="apellidos" value="<?= htmlspecialchars($_SESSION["usuario"]["apellidos"]) ?>" required>

    <label for="password">Nueva Contraseña (dejar en blanco para no cambiar):</label>
    <input type="password" name="password">

    <input type="submit" value="Actualizar" class="boton">
</form>
*/