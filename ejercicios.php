<?php
    include "./vendor/autoload.php";
    session_start();

    $user = $_SESSION["user"];
?>
<!DOCTYPE html>

<html lang="es">
    <head>
        <?php
            include "./headerinfo.php";
        ?>
    </head>
    
    <body>
        <h1>
            <?php
                echo "Ejercicios de " . $user->getUsername();
            ?>
        </h1>
        <legend>Crear Ejercicio</legend>
        <form action="./ejercicios.php" method="post">
            <label for="nombreEjercio">Nombre Ejercicio:</label><br>
            <input type="text" name="nombreEjercio"><br>

            <label for="descripcion">Descripción:</label><br>
            <input type="text" name="descripcion"><br>

            <label for="tipo">Tipo</label>
            <select name="tipo">
                <option value="">-</option>
                <option value="tiempo">Tiempo</option>
                <option value="rept">Repeticiones</option>
            </select>

            <input type="submit" name="newEjercio" value="Submit">
        </form>

        <?php
            if (isset($_POST['newEjercio'])) {
                newEjercicio( $_POST['nombreEjercio'], $_POST['descripcion'], $_POST['tipo'], $user->getId());
            }
            if(isset($_POST['delete'])){
                eliminarEjercicio($_POST['ejercicio']);
            }
            
        ?>

        <table>
            <?php
                tablaEjercicios($user->getId());
            ?>
        </table>
    </body>
</html>