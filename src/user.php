<?php

use Gymbro\Classes\DB;
use Gymbro\Classes\User;


function comprobarUsuario(){
    if (!isset($_SESSION["user"]) || empty($_SESSION["user"])) {
        header("Location: ./index.php");
    }
}

function registrarUsuario(string|null $username, string|null $email, string|null $pw): User|null {
    if (
        empty($username) ||
        empty($email) ||
        empty($pw)
    ) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
    } else {
        $connect = new DB();
        $result = $connect -> Select("SELECT usuario_ID FROM usuario WHERE username = '$username' OR email = '$email'");
        $baneado = $connect -> Select("SELECT usuario_ID FROM usuario WHERE username = '$username' OR email = '$email'");

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

function login(string|null $username, string|null $pw): User|null {
    if (
        empty($username) ||
        empty($pw)
    ) {
        echo "<p>Faltan uno o mas campos por rellenar</p>";
        throw new Exception('Campos no rellenados.');
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