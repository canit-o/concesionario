<?php

echo "<style>
    body {
        font-family: Arial, sans-serif;
        background-image: url('logo2.jpg'); /* Imagen de fondo */
        background-size: cover; /* Asegura que la imagen cubra toda el área */
        background-position: center; /* Centra la imagen */
        background-attachment: fixed; /* Hace que la imagen no se mueva cuando se hace scroll */
        color: #333; /* Gris oscuro para el texto */
        margin: 0;
        padding: 0;
    }

    .container {
        width: 80%;
        margin: 20px auto;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con opacidad */
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #555; /* Gris medio para el encabezado */
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    table, th, td {
        border: 1px solid #ccc; /* Gris claro para el borde */
    }

    th, td {
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #dcdcdc; /* Gris claro para el fondo del encabezado */
        color: #333; /* Gris oscuro para el texto del encabezado */
    }

    tr:nth-child(even) {
        background-color: #f5f5f5; /* Gris muy claro para las filas pares */
    }

    tr:nth-child(odd) {
        background-color: #fff; /* Blanco para las filas impares */
    }

    tr:hover {
        background-color: #e0e0e0; /* Gris claro cuando se pasa el ratón */
    }

    img {
        width: 100px;
        height: auto;
        border-radius: 5px;
    }

    .back-button {
        display: block;
        width: 200px;
        margin: 20px auto;
        padding: 10px;
        background-color: #888; /* Gris intermedio para el botón */
        color: white;
        text-align: center;
        border: none;
        border-radius: 5px;
        text-decoration: none;
    }

    .back-button:hover {
        background-color: #666; /* Gris más oscuro para el hover */
    }
</style>";

echo "<div class='container'>";
echo "<h1>Listado de Coches</h1>";
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "concesionario";

// Conectar a la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Ejecutar la consulta
$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);

// Verificar si la consulta ha devuelto resultados
if (mysqli_num_rows($result) > 0) {
    // Imprimir los resultados en una tabla HTML
    echo "<table>";
    echo "<tr>
            <th>ID</th><th>Nombre</th><th>Apellidos</th><th>Contraseña</th><th>DNI</th><th>Saldo</th>
        </tr>"; // Encabezados de la tabla
    
    // Recorrer los resultados y mostrar cada fila
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_usuario'] . "</td>";  // Asegúrate de que los nombres de las columnas coincidan con los de tu base de datos
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['apellidos'] . "</td>";
        echo "<td>" . $row['passwd'] . "</td>";
        echo "<td>" . $row['dni'] . "</td>";
        echo "<td>" . $row['saldo'] . "</td>";
    }

    echo "</table>";
} else {
    echo "<p>No se encontraron resultados.</p>";
}

echo "<a href='usuarios.php' class='back-button'>Volver</a>"; // Botón de volver

echo "</div>";

mysqli_close($conn); // Cerrar la conexión
?>
