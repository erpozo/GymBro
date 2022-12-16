<?php
    include "./vendor/autoload.php";
    session_start();
?>
<!DOCTYPE html>
<html lang="es">
    <head>
        <?php
            include "./headerinfo.php";
        ?>
    </head>

    <body>
        <form action="./index.php" method="post">
            <label for="username">Username:</label><br>
            <input type="text" name="username"><br>

            <label for="email">Email:</label><br>
            <input type="text" name="email"><br>

            <label for="password">PassWord:</label><br>
            <input type="password" name="password"><br>

            <input type="submit" name="registrar" value="Submit">
        </form>

        <?php
            if (isset($_SESSION["user"]) || !empty($_SESSION["user"])) {
                header("Location: ./home.php");
                exit();
            }
        ?>
    </body>
</html>