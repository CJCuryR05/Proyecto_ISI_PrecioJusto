<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "tu_usuario";
$password = "tu_contraseña";
$dbname = "tu_base_de_datos";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Consulta SQL para obtener el promedio y la moda de precios
$sql = "SELECT AVG(precio_pesos) AS promedio, 
               precio_pesos AS moda 
        FROM productos";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Convertir el resultado a formato JSON
    $row = $result->fetch_assoc();
    $json_response = json_encode($row);
    echo $json_response;
} else {
    echo "No se encontraron resultados";
}

$conn->close();
?>
?>