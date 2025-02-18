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
if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['select_nombre'])) {
    $selected_nombre = mysqli_real_escape_string($conn, $_GET['select_nombre']);
    $select_sql = "SELECT * FROM usuarios WHERE nombre = '$selected_nombre'";
    $select_result = mysqli_query($conn, $select_sql);
    $selected_car = mysqli_fetch_assoc($select_result);
}

// Handle modification submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['modificar'])) {
    // Validate that at least one field is being modified
    $updates = [];
    $nombre_original = mysqli_real_escape_string($conn, $_POST['nombre_original']);

    // Check and sanitize each field
    $fields = ['nombre', 'apellidos', 'password', 'dni', 'saldo'];
    foreach ($fields as $field) {
        if (!empty($_POST[$field])) {
            $value = mysqli_real_escape_string($conn, $_POST[$field]);
            // Special handling for dni to ensure it's numeric
            if (!empty($_POST['saldo'])) {
                $value = mysqli_real_escape_string($conn, $_POST['saldo']);
                $updates[] = "saldo = '$value'";
            }
        }
    }

    // Check if there are any updates to make
    if (!empty($updates)) {
        $update_sql = "UPDATE usuarios SET " . implode(', ', $updates) . " WHERE nombre = '$nombre_original'";

        if (mysqli_query($conn, $update_sql)) {
            $success_message = "Usuario modificado exitosamente.";
        } else {
            $error_message = "Error al modificar el Usuario: " . mysqli_error($conn);
        }
    } else {
        $error_message = "No se han proporcionado datos para modificar.";
    }
}

// Fetch all cars
$sql = "SELECT * FROM usuarios";
$result = mysqli_query($conn, $sql);

// Close database connection
mysqli_close($conn); 
?>
<!DOCTYPE html>
</html>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de usuarios</title>
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
        <h1>Listado de usuarios</h1>

        <?php if ($success_message): ?>
            <div class="message success-message"><?php echo htmlspecialchars($success_message); ?></div>
        <?php endif; ?>

        <?php if ($error_message): ?>
            <div class="message error-message"><?php echo htmlspecialchars($error_message); ?></div>
        <?php endif; ?>

        <table>
            <tr>
                <th>Seleccionar</th>
                <th>nombre</th>
                <th>apellidos</th>
                <th>password</th>
                <th>dni</th>
                <th>saldo</th>
            </tr>
            <?php while ($row = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td>
                        <a href="?select_nombre=<?php echo urlencode($row['nombre']); ?>">Seleccionar</a>
                    </td>
                    <td><?php echo htmlspecialchars($row['nombre']); ?></td>
                    <td><?php echo htmlspecialchars($row['apellidos']); ?></td>
                    <td><?php echo htmlspecialchars($row['password']); ?></td>
                    <td><?php echo htmlspecialchars($row['dni']); ?></td>
                    <td><?php echo htmlspecialchars($row['saldo']); ?></td>
                    
                </tr>
            <?php endwhile; ?>
        </table>

        <?php if ($selected_car): ?>
            <div class="modify-section">
                <h2>Modificar Usuario</h2>
                <form method="post" action="">
                    <input type="hidden" name="nombre_original" 
                           value="<?php echo htmlspecialchars($selected_car['Nombre']); ?>">
                    
                    <label for="Nombre">Nombre:</label>
                    <input type="text" id="Nombre" name="Nombre" 
                           value="<?php echo htmlspecialchars($selected_car['Nombre']); ?>"
                           placeholder="Nombre">
                    
                    <label for="apellidos">apellidos:</label>
                    <input type="text" id="apellidos" name="apellidos" 
                           value="<?php echo htmlspecialchars($selected_car['apellidos']); ?>"
                           placeholder="apellidos">
                    
                    <label for="password">password:</label>
                    <input type="text" id="password" name="password" 
                           value="<?php echo htmlspecialchars($selected_car['password']); ?>"
                           placeholder="password">
                    
                    <label for="dni">dni:</label>
                    <input type="number" id="dni" name="dni" 
                           value="<?php echo htmlspecialchars($selected_car['dni']); ?>"
                           placeholder="dni" step="0.01">
                    
                    <label for="saldo">saldo:</label>
                    <select id="saldo" name="saldo">
                        <option value="Si" <?php echo $selected_car['saldo'] == 'Si' ? 'selected' : ''; ?>>
                            saldo
                        </option>
                        <option value="No" <?php echo $selected_car['saldo'] == 'No' ? 'selected' : ''; ?>>
                            No saldo
                        </option>
                    </select>
                    
                    <input type="submit" name="modificar" value="Modificar Usuario" class="submit-btn">
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