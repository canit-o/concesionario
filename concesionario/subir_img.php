<?php
$servername = "localhost";
$username = "root";
$password = "rootroot";
$dbname = "concesionario";

// Conectar a la base de datos
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Verificar si la conexión es exitosa
if (!$conn) {
    die("Conexión fallida: " . mysqli_connect_error());
}

// Obtener los datos del formulario
$marca = trim(strip_tags($_REQUEST["marca"]));
$modelo = trim(strip_tags($_REQUEST["modelo"]));
$color = trim(strip_tags($_REQUEST["color"]));
$precio = trim(strip_tags($_REQUEST["precio"]));
$alquiler = trim(strip_tags($_REQUEST["alquilado"]));

// Variable para la foto (ruta de la imagen)
$img = "";

// SUBIR IMAGEN
// Directorio donde se guardarán las imágenes
$target_dir = "img/";

// Verificar si se envió un archivo
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['foto'])) {
    $file = $_FILES['foto'];
    
    // Obtener el nombre y ruta del archivo destino
    $target_file = $target_dir . basename($file["name"]);

    // Verificar si el archivo es realmente una imagen
    $check = getimagesize($file["tmp_name"]);
    if ($check === false) {
        die("<form action='coches.php' method='post'><input type='submit' name='volver' value='El archivo no es una imagen ¿volver?'></form>");
    }

    // Verificar si el archivo ya existe
    if (file_exists($target_file)) {
        die("<form action='coches.php' method='post'><input type='submit' name='volver' value='El archivo ya existe ¿volver?'></form>");
    }

    // Intentar mover el archivo al directorio de destino
    if (move_uploaded_file($file["tmp_name"], $target_file)) {
        // Obtener la ruta de la imagen
        $img = $target_file; // Guardar la ruta en la base de datos
    } else {
        die("<form action='coches.php' method='post'><input type='submit' name='volver' value='Error en el archivo, ¿volvemos?'></form>");
    }
} else {
    echo "No se ha seleccionado ningún archivo.";
    echo "<form action='coches.php' method='post'><input type='submit' name='volver' value='volver'></form>";
}

// Insertar los datos en la base de datos
$sql = "INSERT INTO coches (marca, modelo, color, precio, alquilado, foto) 
        VALUES ('$marca', '$modelo', '$color', '$precio', '$alquiler', '$img')";

if (mysqli_query($conn, $sql)) {
    echo "El coche ha sido añadido correctamente.";
    echo "<form action='coches.php' method='post'><input type='submit' name='volver' value='volver'></form>";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    echo "<form action='coches.php' method='post'><input type='submit' name='volver' value='volver'></form>";
}

// Cerrar la conexión a la base de datos
mysqli_close($conn);

$Nombrearchivo = "coches.txt";
$mensaje = "$marca, $modelo, $color, $precio, $alquiler, $img\n";
$archivo = fopen($Nombrearchivo, "a");
if ($archivo) {
    fwrite($archivo, $mensaje);  // Escribir el mensaje en el archivo
    fclose($archivo);  // Cerrar el archivo después de escribir
} else {
    echo "No se pudo abrir el archivo.";
}
fclose($archivo);
?>
