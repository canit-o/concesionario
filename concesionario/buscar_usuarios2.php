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

    /* Estilo de la tabla de resultados */
    .result-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
        background-color: white;
        border-radius: 8px;
    }

    .result-table th, .result-table td {
        text-align: left;
        padding: 12px;
        border-bottom: 1px solid #ddd;
    }

    .result-table th {
        background-color: #666; /* Gris oscuro */
        color: white;
        font-weight: bold;
    }

    .result-table tr:nth-child(even) {
        background-color: #f4f4f4; /* Gris claro */
    }

    .result-table tr:hover {
        background-color: #ddd; /* Gris intermedio */
    }

    .back-button {
        text-decoration: none;
        color: white;
        background-color: #555;
        padding: 10px 20px;
        border-radius: 5px;
        text-align: center;
        display: inline-block;
        margin-top: 20px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .back-button:hover {
        background-color: #777;
    }

</style>
";

$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "concesionario";

// Recoger el valor del nombre
$nombre = trim(strip_tags($_POST["nombre"])); // Sanitizar la entrada

// Conectar a la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Sanitizar la entrada para evitar inyecciones SQL
$nombre = mysqli_real_escape_string($conn, $nombre);

// Ejecutar la consulta para buscar el usuario por nombre
$sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$nombre%'";
$result = mysqli_query($conn, $sql);

// Mostrar resultados
echo "<div class='container'>"; // Contenedor para los resultados y el botón

if (mysqli_num_rows($result) > 0) {
    // Imprimir los resultados del usuario encontrado
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<h2>Información del Usuario: " . $row['nombre'] . "</h2>";
        echo "<table class='result-table'>";
        echo "<thead><tr><th>ID</th><th>Nombre</th><th>Apellidos</th><th>DNI</th><th>Saldo</th><th>Contraseña</th></tr></thead><tbody>";
        echo "<tr>";
        echo "<td>" . $row['id_usuario'] . "</td>";
        echo "<td>" . $row['nombre'] . "</td>";
        echo "<td>" . $row['apellidos'] . "</td>";
        echo "<td>" . $row['dni'] . "</td>";
        echo "<td>" . $row['saldo'] . "</td>";
        echo "<td>" . $row['password'] . "</td>";
        echo "</tr>";
        echo "</tbody></table>";
    }
} else {
    echo "<p>No se encontraron resultados para '$nombre'.</p>";
}

// Botón de regreso
echo "<a href='index.html' class='back-button'>Volver</a>"; // Redirige al formulario de búsqueda

echo "</div>"; // Cerrar contenedor principal

mysqli_close($conn); // Cerrar la conexión
?>
