<?php
//obtener el valor actual de la cookie, si existe. Si no existe una, la creamos
if ( isset($_COOKIE["numAccesos"]) ) {
    # esta inicializada, se lee el valor
    $accesos = $_COOKIE ["numAccesos"];
    //incrementar el valor
    $accesos++;
} else{
    //no esta inicializada, reseteo el valor.
    $accesos = 1;
}

//actualizamos la cookie
setcookie("numAccesos", $accesos, time() + 2);
?>