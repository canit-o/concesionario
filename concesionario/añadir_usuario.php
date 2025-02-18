<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Usuario</title>
    <style>
        /* Centrar todo en la página */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: Arial, sans-serif;
            background-image: url('logo2.jpg'); 
            background-size: cover; /* Para que la imagen de fondo cubra toda la pantalla */
        }

        /* Estilos del contenedor del formulario (con borde pero sin fondo) */
        .form-container {
            border: 2px solid black; /* Borde negro */
            padding: 20px;
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
            background-color: rgba(255, 255, 255, 0.8); /* Fondo blanco con algo de transparencia */
        }

        /* Estilo del título */
        h1 {
            text-align: center;
            color: black; /* Título en color negro */
            background-color: white; /* Fondo blanco alrededor del título */
            padding: 5px;
            border-radius: 5px;
        }

        /* Estilo de las etiquetas */
        label {
            display: block;
            margin-bottom: 8px;
            color: black; /* Etiquetas en color negro */
            font-weight: bold;
            background-color: white; /* Fondo blanco alrededor de las etiquetas */
            padding: 5px;
            border-radius: 5px;
        }

        /* Estilo de los campos de entrada (inputs) */
        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 12px;
            border: 1px solid black; /* Borde negro para los cuadros de texto */
            border-radius: 5px;
            background-color: white; /* Fondo blanco para los campos de entrada */
            color: black; /* Texto en color negro */
            box-sizing: border-box;
        }

        input:focus {
            border-color: black; /* Borde negro cuando el campo está enfocado */
            outline: none; /* Eliminar el borde por defecto */
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: black; /* Fondo negro para el botón */
            color: white; /* Texto blanco */
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #333; /* Fondo negro más oscuro al pasar el ratón */
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Añadir Usuario</h1>
        <form id="formUsuario" action="añadir_usuarios2.php" method="POST">
            <label for="nombre">Nombre:</label>
            <input type="text" id="nombre" name="nombre" required><br>

            <label for="apellidos">Apellidos:</label>
            <input type="text" id="apellidos" name="apellidos" required><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br>

            <label for="dni">DNI:</label>
            <input type="text" id="dni" name="dni" required><br>

            <label for="saldo">Saldo:</label>
            <input type="number" id="saldo" name="saldo" step="0.01" required><br>

            <button type="submit">Registrar Usuario</button>
        </form>
    </div>
</body>
</html>
