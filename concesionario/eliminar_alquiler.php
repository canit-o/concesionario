<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Alquiler</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('logo2.jpg');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
            color: #555;
        }

        label {
            font-size: 1.1em;
            margin-top: 10px;
            display: block;
        }

        input[type="text"] {
            width: 100%;
            padding: 12px;
            margin: 8px 0;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        input[type="submit"] {
            width: 100%;
            padding: 12px;
            background-color: #888;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #666;
        }

        .back-button {
            display: block;
            width: 200px;
            margin: 20px auto;
            padding: 10px;
            background-color: #888;
            color: white;
            text-align: center;
            border: none;
            border-radius: 5px;
            text-decoration: none;
        }

        .back-button:hover {
            background-color: #666;
        }

        .message {
            text-align: center;
            font-size: 1.2em;
            color: #333;
        }

        .error {
            color: red;
        }

        .success {
            color: green;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Eliminar Alquiler</h2>

    <form action="eliminar_alquiler2.php" method="post">
        <label for="prestado">Prestado:</label>
        <input type="text" name="prestado" placeholder="Sí/No" required><br>

        <label for="devuelto">Devuelto:</label>
        <input type="text" name="devuelto" placeholder="Sí/No" required><br>

        <input type="submit" value="Eliminar">
    </form>

    <a href="index.php" class="back-button">Volver</a>

</div>

</body>
</html>
