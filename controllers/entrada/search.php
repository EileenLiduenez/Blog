<?php
require 'blg.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $busqueda = trim($_POST['busqueda']);
    $query = "SELECT * FROM entradas WHERE titulo LIKE ? OR contenido LIKE ?";
    $stmt = $conn->prepare($query);
    $param = "%$busqueda%";
    $stmt->bind_param("ss", $param, $param);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($entrada = $result->fetch_assoc()) {
        echo "<h2>" . $entrada['titulo'] . "</h2><p>" . $entrada['contenido'] . "</p>";
    }
}
?>