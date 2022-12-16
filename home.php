<?php
    include "./vendor/autoload.php";
    session_start();

    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
        header("Location: ./index.php");
        exit();
    }

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
                echo "Bienvenido a Gymbro " . $user->getUsername();
            ?>
        </h1>
        <a href="./rutinas.php">Rutinas</a>
        <a href="./ejercicios.php">Ejercicios</a>
    </body>
</html>