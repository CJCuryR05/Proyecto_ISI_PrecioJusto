<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado de Consulta</title>
</head>
<body>
    <h1>Resultado de Consulta</h1>
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "precio justo";

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $database);

        // Verificar conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $sql = "SELECT nombrecategoria, preciopromedio, modaprecio FROM categorias WHERE nombrecategoria = 'Creppes'";
        $result = $conn->query($sql);

        $categoria = "";
        $precioPromedio = "";
        $modaPrecio = "";

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $categoria = $row["nombrecategoria"];
                $precioPromedio = $row["preciopromedio"];
                $modaPrecio = $row["modaprecio"];
            }
        }

        // Cerrar conexión
        $conn->close();
    ?>
    <table>
        <tr>
            <th>Categoría</th>
            <th>Precio Promedio</th>
            <th>Moda de Precio</th>
        </tr>
        <tr>
            <td><?php echo $categoria; ?></td>
            <td><?php echo $precioPromedio; ?></td>
            <td><?php echo $modaPrecio; ?></td>
        </tr>
    </table>
</body>
</html>