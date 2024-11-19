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
} catch(PDOException $e) {
    die("Error en la conexión: " . $e->getMessage());
}

// Verificar si se han enviado datos mediante POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recuperar los datos del formulario
    $nombre = $_POST["firstName"];
    $segundoNombre = $_POST["secondName"];
    $nombreUsuario = $_POST["userName"];
    $correo = $_POST["userEmail"];
    $contrasena = $_POST["userPassword"];

    // Preparar la consulta SQL para insertar los datos en la tabla usuarios
    $sql = "INSERT INTO usuarios (nombreusuario, nombre, segundo_nombre, correo, contrasena) VALUES (:nombreusuario, :nombre, :segundo_nombre, :correo, :contrasena)";

    try {
        // Preparar y ejecutar la consulta
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':nombreusuario', $nombreUsuario);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':segundo_nombre', $segundoNombre);
        $stmt->bindParam(':correo', $correo);
        $stmt->bindParam(':contrasena', $contrasena);
        $stmt->execute();

        // Si la ejecución es exitosa, enviar una respuesta JSON con éxito
        $response = ["success" => true];
        echo json_encode($response);
    } catch(PDOException $e) {
        // Si ocurre un error, enviar una respuesta JSON con el error
        $response = ["success" => false, "error" => $e->getMessage()];
        echo json_encode($response);
    }
} else {
    // Si no se han enviado datos mediante POST, enviar una respuesta JSON con un mensaje de error
    $response = ["success" => false, "error" => "No se han enviado datos mediante POST"];
    echo json_encode($response);
}

// Cerrar la conexión a la base de datos
$conn = null;
?>