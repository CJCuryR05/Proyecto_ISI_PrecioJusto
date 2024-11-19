<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "precio justo"; // Nombre de la base de datos

// Conexión a la base de datos
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Procesar datos del formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST["userName"];
    $password = $_POST["userPassword"];

    // Consulta preparada para verificar las credenciales del usuario
    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE nombreusuario=? AND contrasena=?");
    $stmt->bind_param("ss", $userName, $password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Inicio de sesión exitoso
        echo "Inicio de sesión exitoso";
    } else {
        // Inicio de sesión fallido
        echo "Inicio de sesión fallido. Por favor, verifica tus credenciales.";
    }

    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>