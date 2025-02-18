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
    $marca = $_REQUEST['marca'];
    $modelo = $_REQUEST['modelo'];
    $color = $_REQUEST['color'];
    $precio = $_REQUEST['precio'];
   
    
    // Preparar y ejecutar la consulta de inserción
    $sql = "DELETE FROM coches WHERE marca = '$marca' or modelo = '$modelo' or color = '$color' or precio = '$precio'";
    
    if (mysqli_query($conn, $sql)) {
        echo "Coche eliminado con éxito.";
    } else {
        echo "Error al eliminar: " . mysqli_error($conn);
    }
    
    mysqli_close($conn);
?>
