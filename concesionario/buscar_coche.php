<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Coche</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Arial', sans-serif;
            background-image: url('logo2.jpg'); 
            background-size: cover; 
            background-position: center;
            color: #333;
        }

        .form-container {
            border: 2px solid #ddd;
            padding: 20px;
            border-radius: 12px;
            width: 100%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.9);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            padding: 10px;
            background-color: #f4f4f4;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 12px;
            font-weight: bold;
            color: #555;
            font-size: 16px;
        }

        .radio-container {
            margin-bottom: 20px;
        }

        .radio-container input[type="submit"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 12px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            text-align: center;
        }

        .radio-container input[type="submit"]:hover {
            background-color: #555;
        }

        .radio-container input[type="submit"]:focus {
            outline: none;
        }

        .radio-container label {
            font-size: 16px;
            display: block;
            margin-bottom: 10px;
        }

        @media (max-width: 480px) {
            .form-container {
                max-width: 100%;
                padding: 15px;
            }

            h1 {
                font-size: 20px;
            }

            .radio-container input[type="submit"] {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>¿Cómo desea buscar el coche?</h1>
        
        <label for="trabajo">Elija una opción</label>
        <div class="radio-container">
            <form action="buscar_coche2.php" method="post">
                <input type="submit" id="marca" name="marca" value="Buscar por marca">
            </form>
            <form action="buscar_coche3.php" method="post">
                <input type="submit" id="modelo" name="modelo" value="Buscar por modelo">
            </form>
        </div>
    </div>
</body>
</html>
