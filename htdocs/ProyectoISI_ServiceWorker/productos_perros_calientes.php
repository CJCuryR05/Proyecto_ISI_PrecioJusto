<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "precio justo"; // Nombre de la base de datos

try {
    $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
    // Establecer el modo de error de PDO a excepción
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Consulta para obtener los precios de los productos de la categoría "Perros Calientes"
    $sql = "SELECT precio_pesos, precio_dolares, precio_euros FROM productos WHERE nombrecategoria = 'Perros Calientes (Hot Dogs)'";

    $stmt = $conn->query($sql);
    $precios_perros_calientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    // Si ocurre un error, imprimir el mensaje de error
    echo "Error: " . $e->getMessage();
}

// Cerrar la conexión a la base de datos
$conn = null;
?>