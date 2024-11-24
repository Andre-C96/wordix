<?php
include_once("wordix.php");



/**************************************/
/***** DATOS DE LOS INTEGRANTES *******/
/**************************************/

/* Crespillo, Andrea. FAI 5546. Tecnicatura en Desarrollo Web. andrea.crespillo@est.fi.uncoma.edu.ar. Usuario Github: Andre-C96*/
/* Navarrete, Ramiro. FAI 5522. Tecnicatura en Desarrollo Web. 39681359rr@gmail.com. Usuario Github: Ramir0Navarrete*/


/**************************************/
/***** DEFINICION DE FUNCIONES ********/
/**************************************/



/**
 * Esta función obtiene una colección de palabras
 * @return array
 */
function cargarColeccionPalabras()
{
    $coleccionPalabras = [
        "MUJER", "QUESO", "FUEGO", "CASAS", "RASGO",
        "GATOS", "GOTAS", "HUEVO", "TINTO", "NAVES",
        "VERDE", "MELON", "YUYOS", "PIANO", "PISOS",
        "PERRO", "PLANO", "MESAS", "CLAVO", "SALSA"
    ];

    return ($coleccionPalabras);
}

/** Esta función almacena las partidas realizadas */


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:


//Proceso:



echo "Menú de opciones:\n";
echo "1) Jugar al wordix con una palabra elegida\n";
echo "2) Jugar al wordix con una palabra aleatoria\n";
echo "3) Mostrar una partida\n";
echo "4) Mostrar la primer partida ganadora\n";
echo "5) Mostrar resumen de Jugador\n";
echo "6) Mostrar listado de partidas ordenadas por jugador y por palabra\n";
echo "7) Agregar una palabra de 5 letras a Wordix\n";
echo "8) Salir\n";
$opcion = trim(fgets(STDIN));
solicitarNumeroEntre(1,8);
switch ($opcion){
    case 1: 
        echo "Ingresa tu nombre: ";
        $jugador = trim(fgets(STDIN));
        echo "Seleccione su palabra de juego ingresando un número del 1 al 15: ";
        $posicionPalabra = trim(fgets(STDIN));
        solicitarNumeroEntre(1,15);
        $coleccionPalabras = cargarColeccionPalabras();
        $palabraElegida = $coleccionPalabras[$posicionPalabra];
        jugarWordix($palabraElegida, $jugador);
}





$partida = jugarWordix("MELON", strtolower("MaJo"));
//print_r($partida);
//imprimirResultado($partida);



/*
do {
    $opcion = ...;

    
    switch ($opcion) {
        case 1: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 1

            break;
        case 2: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 2

            break;
        case 3: 
            //completar qué secuencia de pasos ejecutar si el usuario elige la opción 3

            break;
        
            //...
    }
} while ($opcion != X);
*/
