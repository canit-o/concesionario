<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Inicial con Menú</title>
    <link rel="icon" href="logo.png" type="image/x-icon">
    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            color: white;
            background-image: url('coche.jpg'); 
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .header {
            width: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            padding: 15px 0;
            text-align: left;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 20px;
            padding-right: 20px;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5rem;
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        .welcome-message {
            font-size: 1.5rem;
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
            margin-left: auto; 
            margin-right: 40px; 
        }

        nav {
            width: 100%;
            background-color: black;
            border-bottom: 20px solid black;
            position: fixed;
            top: 70px;
            left: 0;
            padding: 30px 0 10px 0;
            z-index: 99;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
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
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        nav ul li a:hover {
            background-color: rgba(255, 255, 255, 0.3);
            color: #f39c12;
            border-radius: 5px;
        }

        .login-btn, .logout-btn {
            background-color: black;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        .login-btn:hover, .logout-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
            color: #f39c12;
        }

        .login-btn-container {
            position: absolute;
            right: 20px;
            top: 100px; 
            z-index: 101;
        }

        .content {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
            text-align: center;
            color: white;
            background-color: rgba(0, 0, 0, 0.5);
            margin-top: 130px;
        }

        h2 {
            font-size: 3rem;
        }

        @media (max-width: 768px) {
            nav ul li {
                display: block;
                margin: 10px 0;
            }

            h1 {
                font-size: 2rem;
            }

            .content h2 {
                font-size: 2rem;
            }

            .login-btn-container {
                top: 150px; 
            }
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Sistema de Gestión de Coches</h1>
    <div class="welcome-message">
        <?php
        if (isset($_SESSION['id'])) {
            echo "Bienvenido, " . $_SESSION['nombre'] . "!<br> eres un " . $_SESSION['rol'] . "!";
        }
        ?>
    </div>
</div>

<nav>
    <ul>
        <li><a href="coches.php" aria-label="Ir a la sección de coches">Coches</a></li>
        <li><a href="usuarios.php" aria-label="Ir a la sección de usuarios">Usuarios</a></li>
        <li><a href="alquileres.php" aria-label="Ir a la sección de alquileres">Alquileres</a></li>
    </ul>
</nav>

<div class="login-btn-container">
    <?php
    if (isset($_SESSION['id'])) {
        // Si la sesión está activa, mostrar el botón de Cerrar sesión
        echo '<a href="logout.php" class="logout-btn">Cerrar sesión</a>';
    } else {
        // Si la sesión no está activa, mostrar el botón de Iniciar sesión
        echo '<a href="login.php" class="login-btn">Iniciar sesión / Registrarse</a>';
    }
    ?>
</div>

<div class="content">
    
</div>

</body>
</html>
