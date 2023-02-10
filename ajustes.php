<?php
    include "./vendor/autoload.php";
    session_start();
    $user = $_SESSION["user"];
    if (isset($_POST['logout'])) {
        $_SESSION["user"] = null;
    }    
    comprobarUsuario();
?>
<html lang="es">
    <head>
        <?php
            include "./headerinfo.php";
        ?>
    </head>

    <body>
        <form action="./ajustes.php" method="post">
            <label for="userfile">FotoPerfil:</label>
            <input type="file" name="userfile"><br>
            <div class="textcenter">
                <input type="submit" name="update" value="Submit">
            </div>
        </form>
    
        <?php
            if (isset(($_POST['update']))) {
                $nombre_archivo = $_FILES['userfile']['name'];
                $tipo_archivo = $_FILES['userfile']['type'];
                $tamano_archivo = $_FILES['userfile']['size'];
                if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "jpeg")) && ($tamano_archivo < 100000))) {
                    echo "La extensión o el tamaño de los archivos no es correcta. <br><br><table><tr><td><li>Se permiten archivos .gif o .jpg<br><li>se permiten archivos de 100 Kb máximo.</td></tr></table>";
                }else{
                    if (move_uploaded_file($_FILES['userfile']['tmp_name'],  $nombre_archivo)){
                            if (!move_uploaded_file(
                                $_FILES['userfile']['tmp_name'],
                                sprintf('./storage/',
                                    sha1_file($_FILES['upfile']['tmp_name']),
                                    $ext
                                )
                            )) {
                                throw new RuntimeException('Failed to move uploaded file.');
                            }
                    }else{
                           echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                    }
             }
             
            }
        ?>
    </body>
</html>