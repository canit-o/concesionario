<?php
// Iniciar la sesión
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Aquí almacenaríamos los datos en una base de datos, pero para este ejemplo los guardaremos en la sesión
    $_SESSION['usuarios'][$username] = $password;  // Guarda el nombre de usuario y contraseña

    echo "¡Registro exitoso! Ahora puedes iniciar sesión.";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
</head>
<body>
    <h2>Formulario de Registro</h2>
    <form action="registro.php" method="POST">
        <label for="username">Nombre de usuario:</label>
        <input type="text" id="username" name="username" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Registrar</button>
    </form>

    <p>¿Ya tienes cuenta? <a href="login.php">Inicia sesión aquí</a></p>
</body>
</html>

<?php
// Iniciar la sesión
session_start();

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recibir los datos del formulario
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar si el usuario está registrado
    if (isset($_SESSION['usuarios'][$username]) && $_SESSION['usuarios'][$username] == $password) {
        $_SESSION['usuario_logueado'] = $username;  // Guardar usuario logueado en la sesión
        echo "¡Bienvenido, " . $username . "!";
        // Redirigir a otra página o mostrar el contenido protegido
    } else {
        echo "Nombre de usuario o contraseña incorrectos.";
    }
}
?>