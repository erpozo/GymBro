<?php

use Gymbro\Classes\DB;
use Gymbro\Classes\User;


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

function ejerciciosRutinas(array $ejercicios){
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