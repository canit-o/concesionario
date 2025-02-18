<?php
echo "<style>
    /* Estilos generales de la página */
    body {
        background-image: url('logo2.jpg');
        background-size: cover;
        background-position: center;
        color: #333;
        font-family: Arial, sans-serif;
        margin: 0;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    /* Estilos del contenedor principal */
    .container {
        background-color: rgba(255, 255, 255, 0.9); /* Fondo translúcido para el contenedor */
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Sombra sutil */
        width: 80%;
        max-width: 1000px;
    }

    /* Estilos de la tabla */
    .styled-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: white;
        border-radius: 8px;
    }

    .styled-table th, .styled-table td {
        text-align: left;
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }

    .styled-table th {
        background-color: #666; /* Gris oscuro */
        color: white;
        font-weight: bold;
    }

    .styled-table tr:nth-child(even) {
        background-color: #f4f4f4; /* Gris claro */
    }

    .styled-table tr:hover {
        background-color: #ddd; /* Gris intermedio */
    }

    .styled-table td img {
        width: 100px;
        height: auto;
        border-radius: 5px;
    }

    /* Estilo del botón de regreso */
    .back-button {
        text-decoration: none;
        color: white;
        background-color: #555; /* Gris oscuro */
        padding: 10px 20px;
        border-radius: 5px;
        text-align: center;
        display: inline-block;
        margin-top: 20px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1); /* Sombra sutil */
    }

    .back-button:hover {
        background-color: #777; /* Gris más claro para el hover */
    }

    /* Estilos para pantallas pequeñas */
    @media (max-width: 768px) {
        .styled-table {
            max-width: 100%;
        }

        .styled-table td img {
            width: 80px; /* Reducir tamaño de las imágenes en móviles */
        }
    }

</style>
";

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "concesionario";
$modelo = trim(strip_tags($_REQUEST["modelo"])); // Sanitizar la entrada

// Conectar a la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Sanitizar la entrada para evitar inyecciones SQL
$modelo = mysqli_real_escape_string($conn, $modelo);

// Ejecutar la consulta
$sql = "SELECT * FROM coches WHERE modelo LIKE '%$modelo%'";
$result = mysqli_query($conn, $sql);

// Verificar si la consulta ha devuelto resultados
echo "<div class='container'>"; // Contenedor para la tabla y el botón

if (mysqli_num_rows($result) > 0) {
    // Imprimir los resultados en una tabla HTML
    echo "<table class='styled-table'>";
    echo "<thead>
            <tr>
                <th>ID</th><th>Modelo</th><th>Marca</th><th>Color</th><th>Precio</th><th>Alquilado</th><th>Foto</th>
            </tr>
          </thead><tbody>"; // Encabezados de la tabla
    
    // Recorrer los resultados y mostrar cada fila
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>" . $row['id_coche'] . "</td>";  // Asegúrate de que los nombres de las columnas coincidan con los de tu base de datos
        echo "<td>" . $row['modelo'] . "</td>";
        echo "<td>" . $row['marca'] . "</td>";
        echo "<td>" . $row['color'] . "</td>";
        echo "<td>" . $row['precio'] . "</td>";
        echo "<td>" . ($row['alquilado'] ? 'Sí' : 'No') . "</td>";  // Mostrar Si/No según el estado de alquilado

        // Mostrar la imagen de forma estética
        if (!empty($row['foto'])) {
            echo "<td><img src='" . $row['foto'] . "' alt='Foto del coche' class='car-image'></td>";
        } else {
            echo "<td>No disponible</td>";
        }
        
        echo "</tr>";
    }

    echo "</tbody></table>";
} else {
    echo "<p>No se encontraron resultados para el modelo '$modelo'.</p>";
}

// Botón de regreso debajo de la tabla
echo "<a href='coches.php' class='back-button'>Volver</a>"; // Botón de volver

echo "</div>"; // Cerrar contenedor principal

mysqli_close($conn); // Cerrar la conexión
?>
