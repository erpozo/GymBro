<?php
    include "./vendor/autoload.php";
    session_start();
    $user = $_SESSION["user"];
    if (isset($_POST['logout'])) {
        $_SESSION["user"] = null;
    }    
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
                echo "Bienvenido a Gymbro " . $user->getUsername();
            ?>
        </h1>
        <a href="./rutinas.php">Rutinas</a>
        <a href="./ejercicios.php">Ejercicios</a>

        <form action="./home.php" method='post'>
            <input type='submit' name='logout' value='LogOut'>
        </form>
    </body>
</html>