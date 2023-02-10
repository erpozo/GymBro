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
        <div class="menuform topbotmargin">
            <div class="textcenter">
                <img src="./sources/img/Gymbro.png" width="400" height="250">
            </div>
            <div class="textcenter topbotmargin">
                <form action="./register.php" method="post">
                    <label for="username">Username:</label><br>
                    <input type="text" name="username"><br>

                    <label for="email">Email:</label><br>
                    <input type="text" name="email"><br>

                    <label for="password">PassWord:</label><br>
                    <input type="password" name="password"><br>

                    <input type="submit" name="registrar" value="Submit">
                </form>
            </div>
            <div class="textcenter">
                <a href="./index.php">Ya tengo cuenta</a>
            </div>
        </div>

        <?php
            if (isset($_SESSION["user"]) || !empty($_SESSION["user"])) {
                header("Location: ./home.php");
                exit();
            }

            if (isset(($_POST['registrar']))) {
                $_SESSION["user"] = registrarUsuario($_POST['username'], $_POST['email'], $_POST['password']);
            }
        ?>
    </body>
</html>