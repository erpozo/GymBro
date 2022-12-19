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


    </body>
</html>