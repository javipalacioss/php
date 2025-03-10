<?php

require_once("cliente.php");
require_once("fotocopia.php");
require_once("libro.php");

// Programa principal

/*********************************
 *   Crea un cliente sin producto
 **********************************/
$cliente1 = new cliente(1, "pepe");

// Crea una fotocopia a doble cara
$fotocopia1 = new fotocopia(10, 20, true);

// Superficie
echo $fotocopia1->calcularEspacio();

// Cliente compra fotocopia
$cliente1->comprar($fotocopia1);
echo "<p>El cliente ha comprado fotocopia</p>";

 echo $fotocopia1->__toString();
//echo $fotocopia1; // Si el toString es mágico.

echo "<p>Páginas gastadas: " . papel::$paginasGastadas . ".</p>";
echo "<p>Páginas recicladas: " . papel::$paginasRecicladas . ".</p>";
echo "<p>Clientela total: " . cliente::$clientela . ".</p>";

// Elimino cliente y su fotocopia
echo "Elimino cliente y su fotocopia";
unset($cliente1);

// Elimina la fotocopia
unset($fotocopia1);

echo "<p>Páginas gastadas: " . papel::$paginasGastadas . ".</p>";
echo "<p>Páginas recicladas: " . papel::$paginasRecicladas . ".</p>";
echo "<p>Clientela total: " . cliente::$clientela . ".</p>";

/*********************************
 *   Crea un cliente con producto
 **********************************/
// Crea un libro con 50 páginas
$libro1 = new libro(12, 25, 200);
$libro1->titulo = "Guía php";

echo "<p>Libro creado</p>";
$libro1->embalar(2);

echo "<p>Libro embalado</p>";
echo "<p>El embalaje ocupa $libro1->volumenEnvoltorio.</p>";

// Crea el cliente
$cliente2 = new cliente(2, "juan", $libro1);

echo "<p>Páginas gastadas: " . papel::$paginasGastadas . ".</p>";
echo "<p>Páginas recicladas: " . papel::$paginasRecicladas . ".</p>";
echo "<p>Clientela total: " . cliente::$clientela . ".</p>";
