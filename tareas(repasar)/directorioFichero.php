<?php
// muestra el directorio actual
echo "Directorio actual: " . getcwd() . "<br>";

// verifica si se tiene permiso para crear un directorio
if (is_writable(getcwd())) {
    echo "Tienes permiso para crear un directorio.<br>";
} else {
    echo "No tienes permiso para crear un directorio.<br>";
}

// crea un directorio llamado 'test'
$directorio = "test";
if (!file_exists($directorio)) {
    mkdir($directorio); // crea el directorio
    echo "Directorio '$directorio' creado.<br>";
} else {
    echo "El directorio '$directorio' ya existe.<br>";
}

// accede al directorio 'test'
chdir($directorio); // cambia al directorio 'test'
echo "Ahora estamos en el directorio: " . getcwd() . "<br>";

// crea un archivo llamado 'archivo.txt' con contenido
$archivo = "archivo.txt";
file_put_contents($archivo, "Hola DWES"); // crea el archivo con el contenido
echo "Archivo '$archivo' creado con el contenido: 'Hola DWES'.<br>";

// añade una nueva línea al archivo
file_put_contents($archivo, "\nNueva linea añadida.", FILE_APPEND); // añade al archivo
echo "Nueva linea añadida al archivo '$archivo'.<br>";

// lee el archivo y lo imprime
$contenido = file_get_contents($archivo); // lee el contenido
echo "Contenido del archivo '$archivo':<br>" . nl2br($contenido) . "<br>";

// copia el archivo a 'archivo_copia.txt'
copy($archivo, "archivo_copia.txt"); // copia el archivo
echo "Archivo '$archivo' copiado a 'archivo_copia.txt'.<br>";

// lista los archivos del directorio actual
$archivos = scandir(getcwd()); // obtiene los archivos
echo "Archivos en el directorio '$directorio':<br>";
foreach ($archivos as $fichero) {
    if ($fichero != "." && $fichero != "..") { // no mostrar '.' y '..'
        echo "$fichero<br>";
    }
}

// elimina los archivos creados
unlink($archivo); // elimina 'archivo.txt'
unlink("archivo_copia.txt"); // elimina 'archivo_copia.txt'
echo "Archivos eliminados.<br>";

// vuelve al directorio anterior
chdir(".."); 

// elimina el directorio creado
rmdir($directorio); // elimina el directorio 'test'
echo "Directorio '$directorio' eliminado.<br>";
?>
