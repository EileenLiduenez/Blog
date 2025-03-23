<?php require_once "views/layout/header.php"; ?>

<h2>Registro de Usuario</h2>
<form action="index.php?controller=usuario&action=registro" method="POST">
    <label>Nombre:</label>
    <input type="text" name="nombre" required>
    
    <label>Email:</label>
    <input type="email" name="email" required>
    
    <label>Contraseña:</label>
    <input type="password" name="password" required>
    
    <input type="submit" value="Registrarse">
</form>

<?php require_once "views/layout/footer.php"; ?>
