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
    $nombre = $_REQUEST['nombre'];
    $apellidos = $_REQUEST['apellidos'];
    $password = $_REQUEST['password'];
    $dni = $_REQUEST['dni'];
    $saldo = $_REQUEST['saldo'];

   
    
    // Preparar y ejecutar la consulta de inserción
    $sql = "DELETE FROM usuarios WHERE nombre = '$nombre' or apellidos = '$apellidos' or password = '$password' or dni = '$dni' or saldo = '$saldo'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Usuario eliminado con éxito.";
    } else {
        echo "Error al eliminar: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>
