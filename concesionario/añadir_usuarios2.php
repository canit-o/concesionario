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
    $nombre = trim(strip_tags($_REQUEST["nombre"]));
    $apellidos = trim(strip_tags($_REQUEST["apellidos"]));
    $password = trim(strip_tags($_REQUEST["password"]));
    $dni = trim(strip_tags($_REQUEST["dni"]));
    $saldo = trim(strip_tags($_REQUEST["saldo"]));
    
    $sql = "INSERT INTO usuarios(password, nombre, apellidos, dni, saldo) 
            VALUES ('$password', '$nombre', '$apellidos', '$dni', '$saldo')";
    
    if(mysqli_query($conn, $sql)){
        echo "El usuario se ha añadido con éxito";
        echo "<form action='usuarios.php' method='post'><input type='submit' name='volver' value='volver'></form>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        echo "<form action='usuarios.php' method='post'><input type='submit' name='volver' value='volver'></form>";
    }
    mysqli_close($conn);

    $Nombrearchivo="usuarios.txt";
    $mensaje= "$nombre, $apellidos, $password, $dni, $saldo\n";
    $fd = fopen($Nombrearchivo, "a");

    if($fd){
        $escribir = fwrite($fd, $mensaje);
        fclose($fd);

    } else {
        echo "Hubo algún error";
    }
    fclose($fd);

?>
    
