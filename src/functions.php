<?php

use Gymbro\Classes\DB;
use Gymbro\Classes\User;


function comprobarUsuario(){
    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
        header("Location: ./index.php");
    }
}


function registrarUsuario(string $username, string $email, string $pw): User|null {
    if (
        empty($username) ||
        empty($email) ||
        empty($pw)
    ) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
    } else {
        $connect = new DB();
        $result = $connect -> Select("SELECT usuario_ID FROM usuario WHERE username = '$username' OR email = '$email'");

        if (count($result) == 0) {
            $username = $connect -> clearString($username);
            $email = $connect -> clearString($email);
            $pw = password_hash($connect -> clearString($pw), PASSWORD_DEFAULT);

            $connect -> Insert("INSERT INTO usuario (username, email, pw) VALUES ('$username', '$email', '$pw')");
            $result = $connect -> Select("SELECT * FROM usuario WHERE username = '$username'");

            return new User($result[0]["usuario_ID"], $result[0]["username"], $result[0]["email"], $result[0]["pw"]);
        } else {
            echo "<p>Ya existe un usuario con ese nombre o email</p>";
        }
    }

    return null;
}

function login(string $username, string $pw): User|null {
    if (
        empty($username) ||
        empty($pw)
    ) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
    } else {
        $connect = new DB();
        $result = $connect -> Select("SELECT * FROM usuario WHERE username = '$username'");

        if (count($result) == 1 && password_verify($pw, $result[0]["pw"])) {
            return new User($result[0]["usuario_ID"], $result[0]["username"], $result[0]["email"], $result[0]["pw"]);
        }
    }

    return null;
}

function datosUsuario(int $usuario_ID){
    return Select("SELECT username FROM usuario WHERE usuario_ID = '$usuario_ID'");
}

function newEjercicio(string $nombreEjercicio, string $descripcion, string $tipo, int $usuario_ID){
    if (
        empty($nombreEjercicio) ||
        empty($descripcion) ||
        empty($tipo)
    ) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
    } else {
        $connect = new DB();
        $nombreEjercicio = $connect -> clearString($nombreEjercicio);
        $descripcion = $connect -> clearString($descripcion);
        $tipo = $connect -> clearString($tipo);

        $connect -> Insert("INSERT INTO ejercicio (nombre, descripcion, tipo, fk_usuario_ID) VALUES ('$nombreEjercicio', '$descripcion', '$tipo', '$usuario_ID')");
        echo"Ejercicio Añadido";
    }

    return null;
}

function ejerciciosUser(int $usuario_ID){
    $connect = new DB();
    return $connect -> Select("SELECT * FROM ejercicio WHERE fk_usuario_ID = '$usuario_ID'");

}

function ejerciciosAjenos(int $usuario_ID):array{
    $connect = new DB();
    return $connect -> Select("SELECT * FROM ejercicio WHERE fk_usuario_ID != '$usuario_ID'");
}


function ejercicios():array{
    $connect = new DB();
    return $connect -> Select("SELECT * FROM ejercicio");
}

function tablaEjercicios(array $ejercicios){
    echo"<tr>
            <th>Nombre</th>
            <th>Descripcion</th>
            <th>Tipo</th>
            <th>Opciones</th>
        </tr>";
    foreach ($ejercicios as $ejercicio){
        echo 
        "<tr>".
            "<td>" . $ejercicio["nombre"] . "</td>".
            "<td>" . $ejercicio["descripcion"] . "</td>".
            "<td>" . $ejercicio["tipo"] . "</td>".
            "<td> <form method='post'> <input type='hidden' name='ejercicio' value='" . $ejercicio["ejercicio_ID"] . "'> <input type='submit' name='delete' value='borrar'> </form> </td>".
        "</tr>";
    }
}

function eliminarEjercicio(int $ejercicio_ID){
    $connect = new DB();
    $connect -> Remove("DELETE FROM ejercicio WHERE ejercicio_ID = '$ejercicio_ID'");
}
?>