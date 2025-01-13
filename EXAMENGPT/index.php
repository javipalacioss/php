<?php
// Incluir las clases necesarias
include 'cliente.php';
include 'fotocopia.php';
include 'libro.php';
include 'iEmbalaje.php'; // Incluir la interfaz

// Crear un cliente llamado Pepe
$cliente1 = new Cliente("Pepe", "El gran Pepe");
$cliente1->mostrar();

// Crear una fotocopia a doble cara de tamaño 10 x 20
$fotocopia1 = new Fotocopia(10, 20, "Rojo", true);
echo $fotocopia1;  // Mostrar la fotocopia
echo "Superficie: " . ($fotocopia1->getAlto() * $fotocopia1->getLargo()) . " cm²<br>"; // Mostrar la superficie

// Pepe compra la fotocopia
$cliente1->comprar($fotocopia1);

// Mostrar los datos de la fotocopia
echo $fotocopia1;
echo "Páginas gastadas: " . $fotocopia1->paginasGastadas . "<br>";
echo "Páginas recicladas: " . $fotocopia1->paginasRecicladas . "<br>";

// Mostrar la clientela total
echo "Clientela total: " . Cliente::$clientela . "<br>";

// Eliminar al cliente
unset($cliente1);

// Eliminar la fotocopia
unset($fotocopia1);

// Mostrar las páginas gastadas y recicladas
echo "Páginas gastadas: " . $fotocopia1->paginasGastadas . "<br>";
echo "Páginas recicladas: " . $fotocopia1->paginasRecicladas . "<br>";
echo "Clientela total: " . Cliente::$clientela . "<br>";

// Crear un libro de medidas 12 x 25 y 200 páginas
$libro1 = new Libro("Mi Primer Libro", 12, 25, 200);

// Embalar 2 unidades del libro
$volumenEnvoltorio = $libro1->embalar(2);
echo "Volumen del envoltorio: {$volumenEnvoltorio} cm³<br>";

// Crear un cliente llamado Juan con el libro
$cliente2 = new Cliente("Juan", "El gran Juan");
$cliente2->comprar($libro1);
$cliente2->mostrar();

// Mostrar las páginas gastadas y recicladas
echo "Páginas gastadas: " . $libro1->paginasGastadas . "<br>";
echo "Páginas recicladas: " . $libro1->paginasRecicladas . "<br>";

// Mostrar la clientela total
echo "Clientela total: " . Cliente::$clientela . "<br>";
?>
