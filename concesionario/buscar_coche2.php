<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Coche por Marca</title>
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
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            display: block;
            margin-bottom: 12px;
            font-size: 16px;
            color: #555;
        }

        input[type="text"] {
            width: 100%;
            padding: 14px; /* Ajusté el padding para que sea más cómodo */
            margin-bottom: 18px; /* Aumenté el margen para que no quede tan apretado */
            border-radius: 8px;
            border: 1px solid #ccc;
            font-size: 16px;
            box-sizing: border-box; /* Asegura que el padding no aumente el tamaño total */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input[type="text"]:focus {
            border-color: #5c6bc0; /* Color de borde cuando está enfocado */
            box-shadow: 0 0 8px rgba(92, 107, 192, 0.5); /* Efecto de sombra en el foco */
            outline: none; /* Eliminar el borde de enfoque predeterminado */
        }

        button {
            width: 100%;
            padding: 12px;
            background-color: #333;
            color: white;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #555;
        }

        button:focus {
            outline: none;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Buscar Coche por Marca</h1>
        
        <form action="resultados_busqueda2.php" method="post">
            <label for="marca">Ingrese la marca del coche:</label>
            <input type="text" id="marca" name="marca" placeholder="Ejemplo: Toyota, Ford, BMW" required>
            
            <button type="submit">Buscar</button>
        </form>
    </div>
</body>
</html>
