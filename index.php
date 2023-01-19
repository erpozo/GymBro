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
        <div class="menuform">
            <img src="./sources/img/Gymbro.png" width="200" height="125">
            <form action="./index.php" method="post">
                <label for="username">Username:</label><br>
                <input type="text" name="username"><br>

                <label for="password">PassWord:</label><br>
                <input type="password" name="password"><br>

                <input type="submit" name="login" value="Submit">
            </form>

            <a href="./register.php">Registrate</a>
        </div>

        <?php
            if (isset(($_POST['login']))) {
                $_SESSION["user"] = login($_POST['username'], $_POST['password']);
            }

            if (isset(($_POST['registrar']))) {
                $_SESSION["user"] = registrarUsuario($_POST['username'], $_POST['email'], $_POST['password']);
            }

            if (isset($_SESSION["user"]) || !empty($_SESSION["user"])) {
                header("Location: ./home.php");
                exit();
            }
        ?>
    </body>
</html>