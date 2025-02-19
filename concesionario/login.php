<?php
// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Conectar a la base de datos
    $conexion = mysqli_connect("localhost", "root", "rootroot", "concesionario");

    // Verificar si hay errores de conexión
    if (!$conexion) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
    }

    // Recibir y sanitizar datos del formulario
    $dni = trim(strip_tags($_POST['dni']));
    $password = trim(strip_tags($_POST['password']));

    // Validar si los campos están vacíos
    if (empty($dni) || empty($password)) {
        echo '<script>alert("Por favor complete todos los campos."); window.location = "login.php";</script>';
        exit();
    }

    // Encriptar la contraseña (esto es el mismo hash utilizado al momento del registro)
    $password_encriptada = hash('sha512', $password);

    // Verificar si el DNI y la contraseña coinciden en la base de datos
    $sql = "SELECT * FROM registro_usuarios WHERE dni = ? AND password = ?";
    $stmt = mysqli_prepare($conexion, $sql);

    // Verificar si hubo un error preparando la consulta
    if (!$stmt) {
        echo '<script>alert("Error en la consulta SQL: ' . mysqli_error($conexion) . '"); window.location = "login.php";</script>';
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $dni, $password_encriptada);

    // Ejecutar la consulta y verificar si fue exitosa
    if (!mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Error al ejecutar la consulta SQL: ' . mysqli_error($conexion) . '"); window.location = "login.php";</script>';
        exit();
    }

    // Obtener el resultado de la consulta
    $result = mysqli_stmt_get_result($stmt);

    // Si el DNI y la contraseña coinciden, redirigir al usuario
    if (mysqli_num_rows($result) > 0) {
        header("Location: index.html");
        exit();
    } else {
        echo '<script>alert("DNI o contraseña incorrectos. Por favor, verifique los datos."); window.location = "login.php";</script>';
    }

    // Cerrar la conexión y liberar recursos
    mysqli_free_result($result);
    mysqli_stmt_close($stmt);
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }

        input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
        }

        .form-footer a {
            text-decoration: none;
            color: #007bff;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2>Formulario de Login</h2>
    <form action="login.php" method="POST">
        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Iniciar sesión">
    </form>

    <div class="form-footer">
        <p>¿No tienes cuenta? <a href="registro.php">Regístrate aquí</a></p>
    </div>
</div>

</body>
</html>
