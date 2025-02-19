<?php
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);

    // Verificar si el correo ya existe
    $sql = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "El correo electrónico ya está registrado.";
    } else {
        // Insertar el nuevo usuario en la base de datos
        $sql = "INSERT INTO usuarios (nombre, email, contrasena) VALUES ('$nombre', '$email', '$contrasena')";

        if ($conn->query($sql) === TRUE) {
            echo "Registro exitoso. <a href='login.php'>Iniciar sesión</a>";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <style>
        /* Estilos generales */
        body {
            margin: 0;
            font-family: 'Arial', sans-serif;
            background: linear-gradient(to right,rgb(80, 44, 44),rgb(221, 108, 3));
            color: #fff;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }

        h2 {
            font-size: 2rem;
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        form {
            background: rgba(0, 0, 0, 0.7);
            padding: 30px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.4);
        }

        label {
            font-size: 1.1rem;
            margin-bottom: 10px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 1rem;
            background-color: #fff;
            color: #333;
        }

        input[type="submit"] {
            background-color:rgb(219, 152, 52);
            color: white;
            font-size: 1.2rem;
            padding: 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color:rgb(182, 115, 15);
        }

        .footer {
            margin-top: 20px;
            font-size: 1rem;
        }

        .footer a {
            color:rgb(219, 152, 52);
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Estilos para hacer la página responsive */
        @media (max-width: 768px) {
            form {
                width: 90%;
                padding: 20px;
            }

            h2 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>

<h2>¡Regístrate!</h2>

<form method="post" action="registro.php">
    <label for="nombre">Nombre:</label>
    <input type="text" id="nombre" name="nombre" required>
    
    <label for="email">Correo Electrónico:</label>
    <input type="email" id="email" name="email" required>
    
    <label for="contrasena">Contraseña:</label>
    <input type="password" id="contrasena" name="contrasena" required>
    
    <input type="submit" value="Registrar">
</form>

<div class="footer">
    <p>¿Ya tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
</div>

</body>
</html>
