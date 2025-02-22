<?php
session_start();

// Verificar si el usuario está logueado
if (!isset($_SESSION['id'])) {
    header('Location: login.php');
    exit;
}

// Conectar a la base de datos
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "concesionario";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener los coches disponibles
$sql = "SELECT * FROM coches WHERE estado = 'disponible'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alquilar Coche</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <style>
     body {
    margin: 0;
    font-family: Arial, sans-serif;
    color: white;
    background-image: url('logo2.jpg');
    background-size: cover;
    background-position: center;
    height: 100vh;
    display: flex;
    flex-direction: row;
}

nav {
    width: 100%;
    background-color: rgba(0, 0, 0, 0.7);
    position: absolute;
    top: 0;
    left: 0;
    padding: 10px 0;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
}

nav ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    text-align: center;
    border-bottom: 2px solid white;
}

nav ul li {
    display: inline-block;
    margin-right: 30px;
}

nav ul li a {
    text-decoration: none;
    color: white;
    font-size: 18px;
    font-weight: bold;
    padding: 10px 20px;
    display: inline-block;
}

nav ul li a:hover {
    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 5px;
}

.sidebar {
    width: 250px;
    background-color: #000000;
    padding: 20px;
    height: 100vh;
    position: fixed;
    top: 0;
    left: 0;
    display: flex;
    flex-direction: column;
    justify-content: flex-start;
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.3);
}

.sidebar h2 {
    color: white;
    font-size: 24px;
    margin-bottom: 30px;
    text-align: center;
}

.option-button {
    background-color: #000000;
    color: white;
    font-size: 18px;
    font-weight: bold;
    padding: 15px;
    margin: 10px 0;
    border: 2px solid #34495E;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s, border 0.3s;
    width: 100%;
}

.option-button:hover {
    background-color: #34495E;
    border: 2px solid #1ABC9C;
}

.option-button:active {
    background-color: #2C3E50;
    border: 2px solid #16A085;
}

.content {
    margin-left: 250px;
    padding: 20px;
    color: white;
    text-align: center;
    background-color: rgba(0, 0, 0, 0.5);
    flex-grow: 1;
}

h1 {
    font-size: 3rem;
    margin-bottom: 30px;
}

.form-container {
    margin-top: 30px;
    text-align: left;
    display: flex;
    justify-content: center;
}

.form-container form {
    background-color: rgba(0, 0, 0, 0.7);
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    width: 400px;
}

.form-container label {
    color: white;
    font-size: 18px;
    display: block;
    margin-bottom: 10px;
}

.form-container select, 
.form-container input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box; /* Asegura que el padding no afecte al tamaño total */
}

.form-container button {
    background-color: #1ABC9C;
    color: white;
    font-size: 18px;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    width: 100%;
}

.form-container button:hover {
    background-color: #16A085;
}

    </style>
</head>
<body>

<div class="sidebar">
    <h2>Opciones</h2>
    <button class="option-button" onclick="location.href='index.php'">Inicio</button>
    
</div>

<div class="content">
    <h1>Alquilar un Coche</h1>
    <p>Selecciona el coche que deseas alquilar:</p>
    
    <!-- Formulario de alquiler -->
    <div class="form-container">
        <form action="procesar_alquiler.php" method="POST">
            <label for="coche">Coche</label>
            <select name="coche_id" id="coche" required>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<option value='" . $row['id'] . "'>" . $row['nombre'] . " - " . $row['marca'] . " " . $row['modelo'] . "</option>";
                    }
                } else {
                    echo "<option disabled>No hay coches disponibles</option>";
                }
                ?>
            </select>

            <label for="fecha_alquiler">Fecha de Alquiler</label>
            <input type="datetime-local" name="fecha_alquiler" id="fecha_alquiler" required>

            <label for="fecha_devolucion">Fecha de Devolución</label>
            <input type="datetime-local" name="fecha_devolucion" id="fecha_devolucion">

            <button type="submit">Alquilar</button>
        </form>
    </div>
</div>

</body>
</html>

<?php
$conn->close();
?>
