<?php
// Generar 6 números aleatorios del 1 al 6
$numeros = []; // Inicializa un array vacío para almacenar los números
for ($i = 0; $i < 6; $i++) {
    $numeros[] = rand(1, 6); // Agrega un número aleatorio entre 1 y 6 al array
}

// Mostrar el array original
echo "Array original: ";
print_r($numeros); // Imprime el contenido del array de forma legible

// Contar cuántas veces aparece cada número del 1 al 6
$conteo = array_count_values($numeros); // Crea un array asociativo con la cantidad de ocurrencias de cada valor
echo "Conteo de números:\n";
for ($i = 1; $i <= 6; $i++) {
    echo "$i: " . ($conteo[$i] ?? 0) . " veces\n"; // Muestra cuántas veces aparece cada número; si no aparece, muestra 0
}

// Obtener otro número al azar entre 1 y 6
$numeroAleatorio = rand(1, 6); // Genera un número aleatorio entre 1 y 6
echo "Número aleatorio generado: $numeroAleatorio\n";

// Comprobar si el número está en el array y mostrar los índices
$indices = []; // Inicializa un array vacío para almacenar índices
foreach ($numeros as $index => $valor) { // Recorre el array y obtiene índice y valor
    if ($valor == $numeroAleatorio) { // Verifica si el valor actual es igual al número aleatorio
        $indices[] = $index; // Agrega el índice al array de índices
    }
}

if (!empty($indices)) {
    echo "El número $numeroAleatorio aparece en los índices: " . implode(", ", $indices) . "\n"; // Muestra los índices donde se encuentra el número
} else {
    echo "El número $numeroAleatorio no se encuentra en el array.\n"; // Informa si el número no está en el array
}

// Mostrar el array ordenado de mayor a menor
$numerosOrdenados = $numeros; // Crea una copia del array original
sort($numerosOrdenados); // Ordena el array de menor a mayor
$numerosOrdenados = array_reverse($numerosOrdenados); // Invierte el orden para mostrarlo de mayor a menor
echo "Array ordenado de mayor a menor: ";
print_r($numerosOrdenados); // Imprime el array ordenado

// Mostrar el array sin duplicados y sin huecos
$numerosUnicos = array_unique($numeros); // Elimina los valores duplicados del array
$numerosUnicos = array_values($numerosUnicos); // Reindexa el array para eliminar huecos en los índices
echo "Array sin valores duplicados: ";
print_r($numerosUnicos); // Imprime el array sin duplicados
