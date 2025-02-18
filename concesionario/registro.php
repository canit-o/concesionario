<?php
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

$nombre_usuario = trim(strip_tags($_REQUEST['username']));
$correo = trim(strip_tags($_REQUEST['email']));
$dni = trim(strip_tags($_REQUEST['DNI']));
$contrasena = trim(strip_tags($_REQUEST['password']));

// Ejecutar la consulta
$sql = "INSERT INTO usuarios(nombre_usuario, correo, dni, password)
        VALUES('$nombre_usuario', '$correo', '$dni', '$contrasena')";

// Verificar si la consulta fue exitosa
if (mysqli_query($conn, $sql)) {
    echo "Usuario registrado con éxito";
} else {
    echo "ERROR: error al registrar el usuario. " . mysqli_error($conn);
}

// Cerrar la conexión
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Login</title>
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: white;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background-color: black;
            position: relative;
            overflow: hidden;
        }

        .background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: black;
            z-index: -1;
        }

        h2 {
            font-size: 2.5rem;
            text-align: center;
            color: white;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        form {
            background-color: rgba(0, 0, 0, 0.8);
            padding: 30px;
            border-radius: 10px;
            width: 300px;
            text-align: center;
            border: 3px solid #f39c12; /* Borde naranja */
        }

        label {
            font-size: 1rem;
            margin-bottom: 10px;
            display: block;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
            border: 2px solid #f39c12;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        button {
            background-color: #f39c12;
            color: white;
            font-size: 1rem;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #e67e22;
        }

        p {
            color: white;
            font-size: 1rem;
            margin-top: 20px;
        }

        a {
            color: #f39c12;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

    <div class="background-overlay"></div>

    <h2>Formulario de Registro</h2>
    <form action="login.php" method="POST">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required><br>

        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required><br>

        <label for="password">DNI:</label>
        <input type="text" id="DNI" name="DNI" required><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br>

        <button type="submit">Regístrate</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>

</body>
</html>

