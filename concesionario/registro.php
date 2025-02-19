<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Conectar a la base de datos
    $conexion = mysqli_connect("localhost", "root", "rootroot", "concesionario");

    if (mysqli_connect_errno()) {
        die("Error de conexión a la base de datos: " . mysqli_connect_error());
    }

    // Recibir y sanitizar datos del formulario
    $nombre = trim(strip_tags($_POST['nombre']));
    $email = trim(strip_tags($_POST['email']));
    $dni = trim(strip_tags($_POST['dni']));
    $password = trim(strip_tags($_POST['password']));
    $rango = trim(strip_tags($_POST['rango']));  // Campo de rango

    // Validación de campos
    if (empty($nombre) || empty($email) || empty($dni) || empty($password) || empty($rango)) {
        echo '<script>alert("Por favor complete todos los campos."); window.location = "registro.php";</script>';
        exit();
    }

    // Validar formato de correo electrónico
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo '<script>alert("El correo electrónico no es válido."); window.location = "registro.php";</script>';
        exit();
    }

    // Validar formato de DNI (suponiendo que es numérico, ajusta según el formato específico)
    if (!preg_match("/^[0-9]{8}$/", $dni)) {
        echo '<script>alert("El DNI no es válido. Debe tener 8 dígitos numéricos."); window.location = "registro.php";</script>';
        exit();
    }

    // Verificar si el correo o el DNI ya existen en la base de datos (prevención de inyección SQL con consultas preparadas)
    $sql_verificacion = "SELECT * FROM registro_usuarios WHERE email = ? OR dni = ?";
    $stmt = mysqli_prepare($conexion, $sql_verificacion);
    mysqli_stmt_bind_param($stmt, "ss", $email, $dni);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($result) > 0) {
        echo '<script>alert("Error: Este correo o DNI ya está registrado."); window.location = "registro.php";</script>';
        exit();
    }

    // Encriptar la contraseña
    $password = hash('sha512', $password);

    // Insertar el nuevo usuario en la base de datos, incluyendo el campo "rango"
    $sql = "INSERT INTO registro_usuarios (nombre, email, dni, password, rango) VALUES (?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conexion, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $nombre, $email, $dni, $password, $rango);

    if (mysqli_stmt_execute($stmt)) {
        echo '<script>alert("Registro exitoso. Ahora puedes iniciar sesión."); window.location = "login.php";</script>';
    } else {
        echo "Error al registrar el usuario: " . mysqli_error($conexion);
    }

    // Cerrar la conexión
    mysqli_close($conexion);
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
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
        input[type="email"],
        input[type="password"],
        select {
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
    <h2>Formulario de Registro</h2>
    <form action="registro.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>

        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required>

        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required>

        <label for="rango">Rango:</label>
        <select id="rango" name="rango" required>
            <option value="">Seleccione un rango</option>
            <option value="vendedor">Vendedor</option>
            <option value="comprador">Comprador</option>
        </select>

        <input type="submit" value="Registrar">
    </form>

    <div class="form-footer">
        <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
    </div>
</div>

</body>
</html>
