<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Coche</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('logo2.jpg'); 
            background-size: cover; 
        }

        .form-container {
            border: 2px solid black; 
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.8); 
        }

        h1 {
            text-align: center;
            color: black; 
            background-color: white; 
            padding: 5px;
            border-radius: 5px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            color: black; 
            font-weight: bold;
            background-color: white; 
            padding: 5px;
            border-radius: 5px;
        }

       
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid black; 
            border-radius: 5px;
            background-color: white; 
            color: black; 
            box-sizing: border-box;
        }

        input:focus {
            border-color: black; 
            outline: none; 
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: black; 
            color: white; 
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Añadir Coche</h1>
        <form id="formCoche" action="subir_img.php" method="POST" enctype="multipart/form-data">
            <label for="marca">Marca del coche:</label>
            <input type="text" id="marca" name="marca" required><br>

            <label for="modelo">Modelo del coche:</label>
            <input type="text" id="modelo" name="modelo" required><br>

            <label for="color">Color del coche:</label>
            <input type="text" id="color" name="color" required><br>

            <label for="precio">Precio:</label>
            <input type="number" id="precio" name="precio" required><br>

            <label for="alquilado">¿Está alquilado?</label>
            <select id="alquilado" name="alquilado" required>
                <option value="no">No</option>
                <option value="si">Sí</option>
            </select><br><br>

                <label for="foto">Foto del coche:</label>
                <input type="file" id="foto" name="foto" accept="image/*"><br>
            

            <button type="submit">Añadir Coche</button>
        </form>
    </div>

    
</body>
</html>
