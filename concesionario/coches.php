<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Coches</title>
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

        .register-message {
            color: white;
            text-align: center;
            font-size: 18px;
            margin-top: 20px;
        }

        .register-message a {
            color: #1ABC9C;
            font-weight: bold;
            text-decoration: none;
        }

        .register-message a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <h2>Opciones</h2>
    <button class="option-button" onclick="location.href='index.php'">Inicio</button>
    
    <?php
    // Verificar si el usuario está logueado
    if (isset($_SESSION['id'])) {
        // Comprobar el rol del usuario
        if ($_SESSION['rol'] == 'vendedor') {
            // Si es vendedor, mostrar mensaje de bienvenida
            echo '<p>Bienvenido vendedor, ' . $_SESSION['nombre'] . '!</p>';
            echo '<button class="option-button" onclick="location.href=\'añadircoche.php\'">Añadir</button>';
            echo '<button class="option-button" onclick="location.href=\'listar_coches2.php\'">Listar</button>';
            echo '<button class="option-button" onclick="location.href=\'buscar_coche.php\'">Buscar</button>';
        } elseif ($_SESSION['rol'] == 'cliente') {
            // Si es cliente, mostrar mensaje de bienvenida
            echo '<p>Bienvenido cliente, ' . $_SESSION['nombre'] . '!</p>';
            echo '<button class="option-button" onclick="location.href=\'listar_coches2.php\'">Listar</button>';
            echo '<button class="option-button" onclick="location.href=\'buscar_coche.php\'">Buscar</button>';
            echo '<button class="option-button" onclick="location.href=\'alquilar_coche.php\'">Alquilar</button>';
        }
    } else {
        // Si no está logueado, mostrar mensaje y enlace para registrarse
        echo '<div class="register-message">';
        echo 'No estás registrado. <a href="register.php">Regístrate aquí</a> o <a href="login.php">inicia sesión</a>.';
        echo '</div>';
    }
    ?>
</div>

<div class="content">
    <h1>Bienvenido a la página de coches</h1>
</div>

</body>
</html>
