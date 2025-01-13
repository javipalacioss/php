

<?php

//clase Papel
abstract class papel {
    public $páginasGastadas = 0;  //paginas gastadas
    public $páginasRecicladas = 0; //paginas recicladas
    private $dobleCara;  //si es doble cara o no
    protected $alto;     //alto del papel
    protected $largo;    //largo del papel

    //constructor para inicializar ancho, largo y si es doble cara
    public function __construct($alto, $largo, $dobleCara = false) {
        $this->alto = $alto;
        $this->largo = $largo;
        $this->dobleCara = $dobleCara;
    }

    //metodo para obtener el valor de dobleCara
    public function getDobleCara() {
        return $this->dobleCara;
    }

    //metodo abstracto para calcular el espacio (definido por las subclases)
    abstract public function calcularEspacio();

    //metodo __toString para mostrar informacion del papel
    public function __toString() {
        return "Se usa un papel de tamaño: {$this->alto} x {$this->largo}.";
    }
}
?>



<?php
//interfaz que define el embalaje
interface iEmbalaje {
    public function embalar($unidades);  //metodo para embalar, que recibe unidades
}
?>





<?php
// Incluir las clases necesarias (con include_once)
include_once 'papel.php';  // Asegúrate de que este sea el archivo correcto
include_once 'cliente.php';
include_once 'fotocopia.php';
include_once 'libro.php';

// Crear un cliente llamado Pepe sin producto
$pepe = new cliente("Pepe");
$pepe->apodo = "El Rápido";

// Crear una fotocopia a doble cara de tamaño 10x20
$fotocopia = new fotocopia(10, 20, "Negra", true);

// Mostrar la superficie de la fotocopia
echo "Superficie de la fotocopia: " . $fotocopia->calcularEspacio() . " cm²\n";

// Pepe compra la fotocopia
$pepe->comprar($fotocopia);

// Mostrar los datos de la fotocopia
echo "Fotocopia comprada: " . $fotocopia->__toString() . "\n";

// Mostrar las páginas gastadas y recicladas
echo "Páginas gastadas: " . $fotocopia->páginasGastadas . "\n";
echo "Páginas recicladas: " . $fotocopia->páginasRecicladas . "\n";

// Mostrar la clientela total
echo "Clientela total: " . cliente::$clientela . "\n";

// Eliminar cliente y fotocopia
$pepe->eliminar();
unset($fotocopia);  // Eliminar la fotocopia (y la variable)

// Verificar si la fotocopia aún está definida antes de intentar acceder a sus propiedades
if (isset($fotocopia)) {
    echo "Páginas recicladas después de eliminar: " . $fotocopia->páginasRecicladas . "\n";
} else {
    echo "La fotocopia ha sido eliminada.\n";
}

echo "Clientela total después de eliminar: " . cliente::$clientela . "\n";

// Crear un libro de medidas 12x25 y 200 páginas
$libro = new libro(12, 25, 200);

// Mostrar el libro creado
echo $libro->__toString() . "\n";

// Embalar 2 unidades del libro
echo "Volumen de embalaje: " . $libro->embalar(2) . " cm³\n";

// Crear un cliente llamado Juan y asignarle el libro
$juan = new cliente("Juan", $libro);

// Mostrar las páginas gastadas y recicladas
echo "Páginas gastadas del libro: " . $libro->páginasGastadas . "\n";
echo "Páginas recicladas del libro: " . $libro->páginasRecicladas . "\n";

// Mostrar la clientela total después de crear a Juan
echo "Clientela total: " . cliente::$clientela . "\n";
?>
