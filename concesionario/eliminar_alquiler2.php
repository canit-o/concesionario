<?php
    // Configuración de la base de datos
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "concesionario";
    
    // Crear conexión
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Conexión fallida: " . mysqli_connect_error());
    }
    
    // Recuperar datos del formulario
    $prestado = $_REQUEST['prestado'];
    $devuelto = $_REQUEST['devuelto'];

   
    
    // Preparar y ejecutar la consulta de inserción
    $sql = "DELETE FROM alquileres WHERE prestado = '$prestado' or devuelto = '$devuelto'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Alquiler eliminado con éxito.";
    } else {
        echo "Error al eliminar: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>
