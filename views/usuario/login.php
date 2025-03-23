<?php require_once "views/layout/header.php"; ?>

<h2>Iniciar Sesión</h2>
<form action="index.php?controller=usuario&action=login" method="POST">
    <label>Email:</label>
    <input type="email" name="email" required>
    
    <label>Contraseña:</label>
    <input type="password" name="password" required>
    
    <input type="submit" value="Ingresar">
</form>

<?php require_once "views/layout/footer.php"; ?>
