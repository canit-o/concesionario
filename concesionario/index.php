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
            text-align: center;
            position: fixed;
            top: 0;
            left: 0;
            z-index: 100;
        }

        .header h1 {
            margin: 0;
            font-size: 2.5rem;
            color: white;
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.7);
        }

        nav {
            width: 100%;
            background-color: black;
            border-bottom: 20px solid black;
            position: fixed;
            top: 70px;
            left: 0;
            padding: 10px 0;
            z-index: 99;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-left: 20px;
            padding-right: 20px;
        }

        .nav-left {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-grow: 1;
        }

        nav ul {
            list-style-type: none;
            margin: 0;
            padding: 0;
            text-align: center;
            display: flex;
            gap: 30px;
        }

        nav ul li {
            display: inline-block;
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

        .login-btn {
            padding: 10px 20px;
            background-color: #f39c12;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            text-decoration: none;
            margin-left: 20px;
            margin-right: 40px;
        }

        .login-btn:hover {
            background-color: #e67e22;
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
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Sistema de Gestión de Coches</h1>
</div>

<nav>
    <div class="nav-left">
        <ul>
            <li><a href=".\coches.php" aria-label="Ir a la sección de coches">Coches</a></li>
            <li><a href=".\usuarios.php" aria-label="Ir a la sección de usuarios">Usuarios</a></li>
            <li><a href=".\alquileres.php" aria-label="Ir a la sección de alquileres">Alquileres</a></li>
        </ul>
    </div>
    <a href="login.php">
        <button class="login-btn">Iniciar sesión/registrarse</button>
    </a>
</nav>

<div class="content">
</div>

</body>
</html>
