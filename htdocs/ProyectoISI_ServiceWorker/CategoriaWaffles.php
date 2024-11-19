<!DOCTYPE HTML>
<html>
<head>
    <title>Precios de Waffles</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="manifest" href="/manifest.json">
    <meta name="theme-color" content="#000000">
    <style>
        /* Estilos CSS aquí */
        .restaurant-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
        }

        .restaurant-list li {
            margin: 10px;
            width: 250px;
            text-align: center;
            max-width: 100%;
        }

        .promediomoda-list {
            list-style-type: none;
            padding: 0;
            margin: 0;
            width: 100%; /* Ajusta el ancho al 100% del contenedor */
        }

        .promediomoda-list li {
            margin: 10px;
            width: 90%; /* Ajusta el ancho de cada elemento al 90% del contenedor */
            text-align: center;
            max-width: 100%;
            background: rgba(255, 255, 255, 0.7);
            padding: 10px;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .promediomoda-list li img,
        .restaurant-list li img {
            width: 100%;
            height: auto;
            max-width: 100%; /* Asegura que la imagen no exceda el tamaño del contenedor */
            border-radius: 10px;
        }

        .promediomoda-list li h3,
        .promediomoda-list li p,
        .restaurant-list li h3,
        .restaurant-list li p {
            margin: 0;
        }

        /* Tabla de conversión */
        .conversion-table {
            margin-top: 2em;
            text-align: center;
        }

        .conversion-table table {
            margin: 0 auto;
            border-collapse: collapse;
        }

        .conversion-table td {
            padding: 10px 20px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
    <div id="page-wrapper">

        <!-- Header -->
        <div id="header-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <header id="header">
                            <h1 style="text-transform: uppercase"><a href="Categorias.html" id="logo">Categorias</a></h1>
                        </header>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main -->
        <div id="main">
            <div class="container">
                <section>
                    <h2 style="text-transform: uppercase;">Precios promedio y moda de Waffles</h2>
                    <ul class="promediomoda-list">
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

                            $sql = "SELECT nombrecategoria, preciopromedio, modaprecio FROM categorias WHERE nombrecategoria = 'Waffles'";
                            $result = $conn->query($sql);

                            if ($result->num_rows > 0) {
                                while ($row = $result->fetch_assoc()) {
                                    $precioColombiano = $row["preciopromedio"];
                                    $precioDolar = $row["preciopromedio"] / 4000;
                                    $precioEuro = $row["preciopromedio"] / 5000;

                                    echo "<li>";
                                    echo "<div>";
                                    echo "<p><strong>Precio Promedio:</strong></p>";
                                    echo "<p>" . number_format($row["preciopromedio"], 0, ",", ".") . " Pesos Colombianos</p>";
                                    echo "<p>" . number_format($precioDolar, 2) . " Dólares</p>";
                                    echo "<p>" . number_format($precioEuro, 2) . " Euros</p>";

                                    echo "<p><strong>Moda de Precio:</strong></p>";
                                    echo "<p>" . number_format($row["modaprecio"], 0, ",", ".") . " Pesos Colombianos</p>";
                                    $modaDolar = $row["modaprecio"] / 4000;
                                    echo "<p>" . number_format($modaDolar, 2) . " Dólares</p>";
                                    $modaEuro = $row["modaprecio"] / 5000;
                                    echo "<p>" . number_format($modaEuro, 2) . " Euros</p>";

                                    echo "</div>";
                                    echo "</li>";
                                }
                            } else {
                                echo "0 resultados.";
                            }

                            // Cerrar conexión
                            $conn->close();
                        ?>
                    </ul>
                </section>
                <section>
                    <h2 style="text-transform: uppercase;">Precios de Waffles en restaurante Creppes And Waffles</h2>
                    <ul class="restaurant-list">
                        <li>
                            <div>
                                <h3>Waffle arequipe</h3>
                                <p>Precio: $10.000 Pesos colombianos</p>
                                <p>Precio: $2.5 Dolares</p>
                                <p>Precio: $2 Euros</p>
                            </div>
                            <img src="images/Waffle arequipe.jpg" alt="Waffle arequipe">
                        </li>
                        <li>
                            <div>
                                <h3>Waffle frutos del bosque</h3>
                                <p>Precio: $16.000 Pesos colombianos</p>
                                <p>Precio: $4 Dolares</p>
                                <p>Precio: $3.2 Euros</p>
                            </div>
                            <img src="images/Waffle frutos del bosque.jpg" alt="Waffle frutos del bosque">
                        </li>
                        <!-- Agregar más productos según sea necesario -->
                    </ul>
                </section>
            </div>
        </div>

        <!-- Footer -->
        <div id="footer-wrapper">
            <div class="container">
                <footer id="footer">
                    <div class="row">
                        <div class="col-12">
                            <div class="conversion-table">
                                <h3>Tabla de Conversión</h3>
                                <table>
                                    <tr>
                                        <td>1 Dólar</td>
                                        <td>=</td>
                                        <td>4.000 Pesos Colombianos</td>
                                    </tr>
                                    <tr>
                                        <td>1 Euro</td>
                                        <td>=</td>
                                        <td>5.000 Pesos Colombianos</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div id="copyright">
                                &copy; Untitled. All rights reserved. | Design: <a href="http://html5up.net">HTML5 UP</a>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

    </div>

    <!-- Scripts -->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/browser.min.js"></script>
    <script src="assets/js/breakpoints.min.js"></script>
    <script src="assets/js/util.js"></script>
    <script src="assets/js/main.js"></script>
    <script>
    if ('serviceWorker' in navigator) {
        window.addEventListener('load', () => {
            navigator.serviceWorker.register('/service-worker.js')
                .then(registration => {
                    console.log('Service Worker registrado con éxito:', registration);
                })
                .catch(error => {
                    console.log('Error al registrar el Service Worker:', error);
                });
        });
    }
    </script>
</body>
</html>
