<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "concesionario";

// Establish database connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Handle form submission for modifying car details
$success_message = "";
$error_message = "";
$selected_car = null;

// Handle car selection
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['select_modelo'])) {
    $selected_modelo = mysqli_real_escape_string($conn, $_GET['select_modelo']);
    $select_sql = "SELECT * FROM coches WHERE modelo = '$selected_modelo'";
    $select_result = mysqli_query($conn, $select_sql);
    $selected_car = mysqli_fetch_assoc($select_result);
}

// Handle modification submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar'])) {
    // Validate that at least one field is being modified
    $updates = [];
    $modelo_original = mysqli_real_escape_string($conn, $_POST['modelo_original']);

    // Check and sanitize each field
    $fields = ['modelo', 'marca', 'color', 'precio', 'alquilado'];
    foreach ($fields as $field) {
        if (!empty($_POST[$field])) {
            $value = mysqli_real_escape_string($conn, $_POST[$field]);
            // Special handling for precio to ensure it's numeric
            $updates[] = $field == 'precio' 
                ? "$field = " . floatval($value) 
                : "$field = '$value'";
        }
    }

    // Check if there are any updates to make
    if (!empty($updates)) {
        $update_sql = "UPDATE coches SET " . implode(', ', $updates) . " WHERE modelo = '$modelo_original'";
        
        if (mysqli_query($conn, $update_sql)) {
            $success_message = "Coche modificado exitosamente.";
        } else {
            $error_message = "Error al modificar el coche: " . mysqli_error($conn);
        }
    } else {
        $error_message = "No se han proporcionado datos para modificar.";
    }
}

// Fetch all cars
$sql = "SELECT * FROM coches";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Coches</title>
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
            width: 90%;
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #555;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table, th, td {
            border: 1px solid #ccc;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f0f0f0;
            color: #333;
            font-weight: bold;
        }

        tr:nth-child(even) {
            background-color: #f5f5f5;
        }

        tr:hover {
            background-color: #e0e0e0;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            object-fit: cover;
            border-radius: 5px;
        }

        .message {
            text-align: center;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .success-message {
            background-color: #dff0d8;
            color: #3c763d;
            border: 1px solid #d6e9c6;
        }

        .error-message {
            background-color: #f2dede;
            color: #a94442;
            border: 1px solid #ebccd1;
        }

        .modify-section {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin-top: 20px;
        }

        .modify-section h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .modify-section input, 
        .modify-section select {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .modify-section .submit-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .modify-section .submit-btn:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Listado de Coches</h1>

        <?php if ($success_message): ?>
            <div class="message success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <?php if ($error_message): ?>
            <div class="message error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <table>
            <tr>
                <th>Seleccionar</th>
                <th>Modelo</th>
                <th>Marca</th>
                <th>Color</th>
                <th>Precio</th>
                <th>Alquilado</th>
                <th>Foto</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <a href="?select_modelo=<?php echo urlencode($row['modelo']); ?>">Seleccionar</a>
                    </td>
                    <td><?php echo htmlspecialchars($row['modelo']); ?></td>
                    <td><?php echo htmlspecialchars($row['marca']); ?></td>
                    <td><?php echo htmlspecialchars($row['color']); ?></td>
                    <td><?php echo htmlspecialchars($row['precio']); ?></td>
                    <td><?php echo htmlspecialchars($row['alquilado']); ?></td>
                    <td>
                        <img src="<?php echo htmlspecialchars($row['foto']); ?>" alt="Foto del coche">
                    </td>
                </tr>
            <?php endwhile; ?>
        </table>

        <?php if ($selected_car): ?>
            <div class="modify-section">
                <h2>Modificar Coche</h2>
                <form method="post" action="">
                    <input type="hidden" name="modelo_original" 
                           value="<?php echo htmlspecialchars($selected_car['modelo']); ?>">
                    
                    <label for="modelo">Modelo:</label>
                    <input type="text" id="modelo" name="modelo" 
                           value="<?php echo htmlspecialchars($selected_car['modelo']); ?>"
                           placeholder="Modelo">
                    
                    <label for="marca">Marca:</label>
                    <input type="text" id="marca" name="marca" 
                           value="<?php echo htmlspecialchars($selected_car['marca']); ?>"
                           placeholder="Marca">
                    
                    <label for="color">Color:</label>
                    <input type="text" id="color" name="color" 
                           value="<?php echo htmlspecialchars($selected_car['color']); ?>"
                           placeholder="Color">
                    
                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" 
                           value="<?php echo htmlspecialchars($selected_car['precio']); ?>"
                           placeholder="Precio" step="0.01">
                    
                    <label for="alquilado">Alquilado:</label>
                    <select id="alquilado" name="alquilado">
                        <option value="Si" <?php echo $selected_car['alquilado'] == 'Si' ? 'selected' : ''; ?>>
                            Alquilado
                        </option>
                        <option value="No" <?php echo $selected_car['alquilado'] == 'No' ? 'selected' : ''; ?>>
                            No Alquilado
                        </option>
                    </select>
                    
                    <input type="submit" name="modificar" value="Modificar Coche" class="submit-btn">
                </form>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>
<?php
// Close database connection
mysqli_close($conn);
?>