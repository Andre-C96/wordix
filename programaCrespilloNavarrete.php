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
// UASORT: Ordena un array con una función de comparación definida por el usuario y mantiene la asociación de índices.
// CTYPE_ALPHA:Verifica si todos los caracteres en la string entregada,texto, son alfabéticos.
// STRTOUPPER: Convierte un string a mayúsculas.
// STRTOLOWER: Convierte un string a minúsculas.
// COUNT: Cuenta todos los elementos de un array o algo de un objeto.
// STRCMP: Comparación de string segura a nivel binario.
// STRLEN: Obtiene la longitud de un string.
// SRTPOS: Encuentra la posición de la primera ocurrencia de un substring en un string.
// ARRAY_RAND: Seleccionar una o más claves aleatorias de un array.
// ARRAY_PUSH: Inserta uno o más elementos al final de un array.
// PRINT_R: Imprime información legible para humanos sobre una variable.



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

/** Esta función presenta el menú de opciones al usuario
 * Se encarga de que la opción sea valida
 * @return INT
 */
function seleccionarOpcion(){
    //INT $opcion
    echo "\n Menú de opciones:\n";
    echo "1) Jugar al wordix con una palabra elegida\n";
    echo "2) Jugar al wordix con una palabra aleatoria\n";
    echo "3) Mostrar una partida\n";
    echo "4) Mostrar la primer partida ganadora\n";
    echo "5) Mostrar resumen de Jugador\n";
    echo "6) Mostrar listado de partidas ordenadas por jugador y por palabra\n";
    echo "7) Agregar una palabra de 5 letras a Wordix\n";
    echo "8) Salir\n";
    echo "Ingrese opción elegida: \n";
    $opcion = solicitarNumeroEntre(1,8);
    return $opcion;
}


/** Esta función almacena las partidas realizadas 
 * Recibe como paremetro los datos de la partida y retorna un arreglo múltidimensional
 * @param array $partidaJugada
 * @return array 
*/
function cargarPartidas (){
     $coleccionPartidas = [
        ["palabraWordix" => "QUESO", "jugador" => "majo", "intentos" => 0, "puntaje" => 0],
        ["palabraWordix" => "CASAS", "jugador" => "rudolf", "intentos" => 3, "puntaje" => 14],
        ["palabraWordix" => "QUESO", "jugador" => "pink2000", "intentos" => 6, "puntaje" => 10],
        ["palabraWordix" => "FUEGO", "jugador" => "majo", "intentos" => 4, "puntaje" => 12],
        ["palabraWordix" => "PIANO", "jugador" => "rudolf", "intentos" => 2, "puntaje" => 18],
        ["palabraWordix" => "NAVES", "jugador" => "ana", "intentos" => 1, "puntaje" => 20],
        ["palabraWordix" => "CLAVO", "jugador" => "pedro", "intentos" => 5, "puntaje" => 8],
        ["palabraWordix" => "MESAS", "jugador" => "pink2000", "intentos" => 3, "puntaje" => 14],
        ["palabraWordix" => "GATOS", "jugador" => "ana", "intentos" => 6, "puntaje" => 6],
        ["palabraWordix" => "RASGO", "jugador" => "pedro", "intentos" => 2, "puntaje" => 16]
    ];

    return $coleccionPartidas;
}



/** Esta función verifica que un jugador no repita una palabra ya jugada
* @param STRING $jugador
* @param STRIN $palabraAJugar
* @param array $partidas
* @return BOOL
*/
function verificarNoRepetirPalabra ($jugador, $palabraAJugar, $partidas){
    //BOLL $encontrado
    //INT $canPartidas
    //INT $i
    $i = 0;
    $encontrada = false;
    $cantidadPartidas = count($partidas);

    while ($i < $cantidadPartidas && !$encontrada) {
        if ($partidas[$i]["jugador"] == $jugador && $partidas[$i]["palabraWordix"] == $palabraAJugar) {
        $encontrada = true;
        }
        $i++;
    }

    return $encontrada; 
}

 
 /** Esta función recibe como parámetro un número y muestra en pantalla los datos de la partida solicitada
  * @param int $num 
 * @param array $partidas 
 */
function mostrarPartida($num, $partidas) {
    $num = $num - 1; 
    $cantPartidas = count($partidas);
    if ($num >= 0 && $num < $cantPartidas) {
        $partida = $partidas[$num];

        echo "Partida WORDIX " . ($num + 1) . ":\n";
        echo "Palabra: " . $partida["palabraWordix"] . "\n";
        echo "Jugador: " . $partida["jugador"] . "\n";
        echo "Puntaje: " . $partida["puntaje"] . " puntos\n";

        if ($partida["intentos"] == 0) {
            echo "Intento: No adivinó la palabra\n";
        } else {
            echo "Intento: Adivinó la palabra en " . $partida["intentos"] . " intentos\n";
        }
    } else {
        echo "Error: La partida no existe.\n";
    }
}

/** Está función agrega una palabra a la colección de palabras del juego
 * @param array $coleccionPalabras
 * @return STRING
*/
function agregarPalabras ($coleccionPalabras){
    //STRING $palabra
    //INT $cantPalabras
    //INT $i
    //BOOL $encontrado
    $palabra = leerPalabra5Letras();
    $cantPalabras =  count($coleccionPalabras);
    $i = 0;
    $encontrado = false;
    while ($i < $cantPalabras && !$encontrado){
        if ($coleccionPalabras[$i] == $palabra){
        echo "Su palabra ya existe en la colección, ingrese otra. \n";
        $encontrado = true;
        $palabra = leerPalabra5Letras();
    }
    $i++;
    }
    return $palabra;
}

/** Retorna el índice de la primera partida ganada por un jugador.
 * Si el jugador no ganó ninguna partida, retorna -1.
 * @param array $partidas 
 * @param string $nombreJugador 
 * @return int 
 */
function primeraPartidaGanada($partidas, $nombreJugador) {
    //INT $cantPartidas
    //INT $i
    //INT $posicion
    $i = 0;
    $posicion = -1;
    $cantidadPartidas = count($partidas);
    while ($i < $cantidadPartidas && $posicion == -1) {
        if ($partidas[$i]["jugador"] == $nombreJugador && $partidas[$i]["intentos"] > 0) {
            $posicion = $i;
        } else {
            $i++;
        }
    }
    
    return $posicion;
}


 /** Esta función calcula el resumen del jugador y lo retorna en un arreglo asociativo.
 * 
 * @param array $partidas 
 * @param string $nombreJugador 
 * @return array 
 */
function obtenerResumenJugador($partidas, $nombreJugador) {
    //array $partidasJugador
    //INT $cantPartidas
    //INT $i
    //INT $puntajeTotal
    //INT $victorias
    //INT $intento1
    //INT $intento2
    //INT $intento3
    //INT $intento4
    //INT $intento5
    //INT $intento6
    //INT $cantPartidasJugador
    //INT $j
    //array $partida
    //INT $indiceIntento
    //FLOAT $porcentajeVictorias
    //array $resumenJugador
    $puntajeTotal = 0;
    $victorias = 0;
    $intento1 = 0;
    $intento2 = 0;
    $intento3 = 0;
    $intento4 = 0;
    $intento5 = 0;
    $intento6 = 0;
    $partidasJugador = [];

    $cantPartidas = count($partidas);
    for ($i = 0; $i < $cantPartidas; $i++) {
        if ($partidas[$i]["jugador"] == $nombreJugador) {
            $partidasJugador[] = $partidas[$i];
        }
    }

    $cantPartidasJugador = count($partidasJugador);
    for ($j = 0; $j < $cantPartidasJugador; $j++) {
        $puntajeTotal += $partidasJugador[$j]["puntaje"];

        if ($partidasJugador[$j]["intentos"] > 0 && $partidasJugador[$j]["intentos"] <= 6) {
            $victorias++;
            if ($partidasJugador[$j]["intentos"] == 1) {
                $intento1++;
            } elseif ($partidasJugador[$j]["intentos"] == 2) {
                $intento2++;
            } elseif ($partidasJugador[$j]["intentos"] == 3) {
                $intento3++;
            } elseif ($partidasJugador[$j]["intentos"] == 4) {
                $intento4++;
            } elseif ($partidasJugador[$j]["intentos"] == 5) {
                $intento5++;
            } else{
                $intento6++;
            }
        }
    }
    $porcentajeVictorias = $cantPartidasJugador > 0 ? ($victorias * 100) / $cantPartidasJugador : 0;
    $resumenJugador = [
        "jugador" => $nombreJugador,
        "partidas" => $cantPartidasJugador,
        "puntajeTotal" => $puntajeTotal,
        "victorias" => $victorias,
        "porcentajeVictorias" => $porcentajeVictorias,
        "intento1" => $intento1,
        "intento2" => $intento2,
        "intento3" => $intento3,
        "intento4" => $intento4,
        "intento5" => $intento5,
        "intento6" => $intento6
        ];
    return $resumenJugador;
}


/** Está función solicita el nombre de un jugador asegurando que comience con una letra
 * y devuelve el nombre en minúsculas.
 * 
 * @return string 
 */
function solicitarJugador() {
    //STRING $nombre
    do {
        echo "Ingrese el nombre del jugador (debe comenzar con una letra): ";
        $nombre = trim(fgets(STDIN)); 
        
        if (!ctype_alpha($nombre[0])) {
            echo "El nombre debe comenzar con una letra.\n";
        }
    } while (!ctype_alpha($nombre[0])); 
    
    return strtolower($nombre);
}
/**
 * Ésta función compara las partidas para ordenarlas por jugador y por palabra
 * @param STRING $a, $b
 * @return 
 */
function compararPartidas ($a,$b){
    //$comparacion
    if ($a["jugador"] < $b["jugador"]) {
        $comparacion = -1;
    } elseif ($a["jugador"] > $b["jugador"]) {
        $comparacion = 1;
    } else {
        if ($a["palabraWordix"] < $b["palabraWordix"]) {
            $comparacion = -1;
        } elseif ($a["palabraWordix"] > $b["palabraWordix"]) {
            $comparacion = 1;
        } else {
            $comparacion = 0;
        }
    }
    return $comparacion;
}

/** Ésta función ordena un arreglo de las partidas jugadas por nombre de jugador y por palabra.
 * Luego lo muestra por pantalla
 * @param array $coleccionPartidas 
 */
function mostrarPartidasOrdenadas($coleccionPartidas) {
    uasort($coleccionPartidas, "compararPartidas");
    echo "Listado de partidas ordenadas por jugador y por palabra:\n";
    print_r($coleccionPartidas);
}




/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:
/**
 * STRING $jugador
 * STRING $palabraAleatoria
 * STRING $aleatoria
 * INT $opcion
 * INT $posiconPalabra
 * INT $cantPartidas
 * INT $numeroPartida
 * INT $indiceGanada
 * BOOL $palabraValida
 * array $palabraElegida
 * array $coleccionPalabras
 * array $partida
 * array $partidaGanada
 * array $almacenarPartidas
 * array $partidasJugadas
 * array $resumen
 * BOOL $partidaValida
 */


//Inicialización de variables:
$coleccionPartidas = cargarPartidas();
$coleccionPalabras = cargarColeccionPalabras();

//Proceso:
do{ 
    $opcion = seleccionarOpcion();
    switch ($opcion){
        case 1: 
            $palabraValida = false;
            $jugador = solicitarJugador();
            while (!$palabraValida) {
                $cantPalabras = count($coleccionPalabras);
                echo "Seleccione su palabra de juego ingresando un número del 1 al " . ($cantPalabras). ": ";
                $posicionPalabra = solicitarNumeroEntre(1,($cantPalabras));
                $palabraElegida = $coleccionPalabras[(int)$posicionPalabra-1];
                if (verificarNoRepetirPalabra($jugador, $palabraElegida, $coleccionPartidas)) {
                    echo "La palabra ya fue utilizada por este jugador." . "\n\"";
                } else {
                    $palabraValida = true;
                }
                }
            $partida = jugarWordix($palabraElegida, $jugador);
            $coleccionPartidas[] = $partida;
            break;
        case 2:
            $jugador = solicitarJugador();
            do { 
                $aleatoria = array_rand($coleccionPalabras);
                $palabraAleatoria = $coleccionPalabras[$aleatoria];
            } while (verificarNoRepetirPalabra($jugador, $palabraAleatoria, $coleccionPartidas));
            $partida = jugarWordix($palabraAleatoria, $jugador);
            $coleccionPartidas[] = $partida;
            break;
        case 3:
            $cantPartidas = count($coleccionPartidas);
            echo "Ingrese el número de partida (1-" . $cantPartidas . "): ";
            $numeroPartida = trim(fgets(STDIN));
            $mostrarPartida =  mostrarPartida($numeroPartida, $coleccionPartidas);
            break;
        case 4: 
            $jugador = solicitarJugador();
            $indiceGanada = primeraPartidaGanada($coleccionPartidas, $jugador);
            if ($indiceGanada !== -1) { 
                $partidaGanada = $coleccionPartidas[$indiceGanada];
                echo "*******************************************************\n";
                echo "Partida WORDIX ganada por " . $partidaGanada["jugador"] . ":\n";
                echo "Palabra: " . $partidaGanada["palabraWordix"] . "\n";
                echo "Puntaje: " . $partidaGanada["puntaje"] . " puntos\n";
                echo "Intento: Adivinó la palabra en " . $partidaGanada["intentos"] . " intentos\n";
                echo "*******************************************************\n";
            } else { 
                echo "El jugador " . $jugador . " no ganó ninguna partida.\n";
            }
            break;
        case 5:
            $jugador = solicitarJugador(); 
            $resumen = obtenerResumenJugador($coleccionPartidas, $jugador);
            if ($resumen["partidas"] == 0) {
                echo "El jugador " . $jugador . " no tiene partidas jugadas.\n";
            } else { 
                echo "**************************************************\n";
                echo "Jugador: " . $resumen["jugador"] . "\n";
                echo "Partidas: " . $resumen["partidas"] . "\n";
                echo "Puntaje Total: " . $resumen["puntajeTotal"] . "\n";
                echo "Victorias: " . $resumen["victorias"] . "\n";
                echo "Porcentaje Victorias: " . $resumen["porcentajeVictorias"] . "%\n";
                echo "Adivinadas:\n";
                echo "Intento 1: " . $resumen["intento1"] . "\n";
                echo "Intento 2: " . $resumen["intento2"] . "\n";
                echo "Intento 3: " . $resumen["intento3"] . "\n";
                echo "Intento 4: " . $resumen["intento4"] . "\n";
                echo "Intento 5: " . $resumen["intento5"] . "\n";
                echo "Intento 6: " . $resumen["intento6"] . "\n";
                echo "**************************************************\n";
                }
            break;
        case 6:
            mostrarPartidasOrdenadas($coleccionPartidas);
            break;
        case 7:
            $palabra = agregarPalabras($coleccionPalabras);
            $coleccionPalabras[] = $palabra;
            echo "Tu palabra ah sido agregada.";
            break;
        case 8:
            echo "Hasta pronto!\n";
            exit;
            break;        
    }
}while ($opcion != 8);
?>