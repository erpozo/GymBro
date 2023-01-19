<?php
    include "./vendor/autoload.php";
    session_start();
    $user = $_SESSION["user"];    
    comprobarUsuario();
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
                echo "Rutinas de " . $user->getUsername();
            ?>
        </h1>
        <form action="./home.php" method='post'>
            <input type='submit' name='logout' value='LogOut'>
        </form>
        <legend>Crear Rutina</legend>
        <form action="./rutinas.php" method="post">
            <label for="nombreRutina">Nombre Rutina:</label><br>
            <input type="text" name="nombreRutina"><br>

            <label for="descripcion">Descripción:</label><br>
            <input type="text" name="descripcion"><br>

            <?php
                $ejercicios = ejerciciosUser($user->getId());
                foreach($ejercicios as $ejercicio){
                    echo "<div class='ejercicioRutina'>";
                    $ejerID=$ejercicio["ejercicio_ID"];
                    $ejerName=$ejercicio["nombre"];
                    $ejerTipo=$ejercicio["tipo"];
                    echo "<label for='$ejerID'>$ejerName</label><br>";
                    echo "<input type='checkbox' name='$ejerID' value='$ejerName'>";
                    echo "<input type='text' name='$ejerID'>";
                    echo "</div>";
                }
            ?>
            <input type=hidden name="numej" value="$i">
            <br><input type="submit" name="newRutina" value="Submit">
        </form>

        <?php
            if (isset($_POST['newRutina'])) {
                echo "<h1>".$_POST['nombreRutina']."</h1>";
                foreach($ejercicios as $ejercicio){
                    $ejerID=$ejercicio["ejercicio_ID"];
                    $ejerName=$ejercicio["nombre"];
                    if ($_POST["$ejerID"]){
                        echo "$ejerName";
                    }
                }
            }
            if(isset($_POST['delete'])){
                eliminarEjercicio($_POST['ejercicio']);
            }
        ?>


    </body>
</html>