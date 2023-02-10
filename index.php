<?php
    include "./vendor/autoload.php";
    session_start();
    $_SESSION["error"] = null;
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
                <form action="./index.php" method="post">
                    <label for="username">Username:</label><br>
                    <input type="text" name="username"><br>

                    <label for="password">PassWord:</label><br>
                    <input type="password" name="password"><br>
                    <div class="textcenter">
                        <input type="submit" name="login" value="Submit">
                    </div>2
                </form>
            </div>
            <div class="textcenter">
                <a href="register.php">Regístrate</a>
            </div>
            <div class="textcenter">
                <h2>
                    Error
                </h2>
            </div>
        </div>

        <?php
            if (isset(($_POST['login']))) {
                $_SESSION["user"] = login($_POST['username'], $_POST['password']);
            }

            if (isset($_SESSION["user"]) || !empty($_SESSION["user"])) {
                header("Location: ./home.php");
                exit();
            }
        ?>
    </body>
</html>