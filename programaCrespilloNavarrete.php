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
// ARRAY_KAYS: Devuelve todas las claves de un array o un subconjunto de claves de un array.
// ISSET: Determina si una variable está definida y no es null.
// STATIC: definir métodos y propiedades estáticos. static también se puede usar para definir variables estáticas y para enlaces estáticos en tiempo de ejecución.



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
 * Recibe como paremetro los datos de la partida y retorna un arreglo múltidimencional
 * @param array $partidaJugada
 * @return array 
*/
function cargarPartidas ($partidaJugada = null){
    //array $partida
    //STRING $jugadorActual
    //array $arrayPartidasJugadas
    //INT $partidaActual
    //ARRAY $partidasIniciales
    //BOOL $existePartida
    static $arrayPartidasJugadas = [];

    $partidasIniciales = [
        [
            "jugador" => "juan",
            "intentos" => 3,
            "palabra" => "CASAS",
            "puntaje" => 7
        ],
        [
            "jugador" => "maria",
            "intentos" => 2,
            "palabra" => "PERRO",
            "puntaje" => 9
        ],
        [
            "jugador" => "juan",
            "intentos" => 4,
            "palabra" => "GATOS",
            "puntaje" => 11
        ],
        [
            "jugador" => "ana",
            "intentos" => 1,
            "palabra" => "CLAVO",
            "puntaje" => 15
        ],
        [
            "jugador" => "pedro",
            "intentos" => 2,
            "palabra" => "SALSA",
            "puntaje" => 5
        ],
        [
            "jugador" => "maria",
            "intentos" => 2,
            "palabra" => "QUESO",
            "puntaje" => 5
        ],
        [
            "jugador" => "juan",
            "intentos" => 3,
            "palabra" => "RASGO",
            "puntaje" => 9
        ],
        [
            "jugador" => "ana",
            "intentos" => 1,
            "palabra" => "YUYOS",
            "puntaje" => 17
        ],
        [
            "jugador" => "pedro",
            "intentos" => 4,
            "palabra" => "NAVES",
            "puntaje" => 7
        ],
        [
            "jugador" => "maria",
            "intentos" => 3,
            "palabra" => "MESAS",
            "puntaje" => 4
        ]
    ];

    for ($i = 0; $i < count($partidasIniciales); $i++) {
        $partida = $partidasIniciales[$i];
        $jugadorActual = $partida["jugador"];
        $palabraActual = $partida["palabra"];
        if (!isset($arrayPartidasJugadas[$jugadorActual])){
            $arrayPartidasJugadas[$jugadorActual] = [
                "partidas" => [
                    $partida
                ]
            ];
        } else {
            $existePartida = false;
            $cantPartidas = count($arrayPartidasJugadas[$jugadorActual]["partidas"]);
            for ($j = 0; $j < $cantPartidas; $j++) {
                $partidaExistente = $arrayPartidasJugadas[$jugadorActual]["partidas"][$j];
                if ($partidaExistente["palabra"] == $palabraActual) {
                    $existePartida = true;
                    break;
                }
            }
            if (!$existePartida) {
                $arrayPartidasJugadas[$jugadorActual]["partidas"][] = $partida;
            }
        }
    }

    if($partidaJugada !== null){
        $partida = $partidaJugada;
        $jugadorActual = $partida["jugador"];
        if (!isset($arrayPartidasJugadas[$jugadorActual])){
            $arrayPartidasJugadas[$jugadorActual] = [
                "partidas" => [
                    [
                        "jugador" => $jugadorActual,
                        "intentos" => $partida["intentos"],
                        "palabra" => $partida["palabraWordix"],
                        "puntaje" => $partida["puntaje"]
                    ]
                ]
            ];
        } else {
            $partidaActual = count($arrayPartidasJugadas[$jugadorActual]["partidas"]);
            $arrayPartidasJugadas[$jugadorActual]["partidas"][$partidaActual] = [
                "jugador" => $jugadorActual,
                "intentos" => ($partida["intentos"]),
                "palabra" => ($partida["palabraWordix"]),
                "puntaje" => ($partida["puntaje"])
            ];
        }
    }
    return $arrayPartidasJugadas;
    }


/** Esta función verifica que un jugador no repita una palabra ya jugada
* @param STRING $jugador
* @param STRIN $palabraAJugar
* @param array $arrayPartidasJugadas
* @return BOOL
*/
function verificarNoRepetirPalabra ($jugador, $palabraAJugar, $partidasJugadas){
    //BOLL $encontrado
    //INT $canPartidas
    //INT $i
    $encontrado = false;
    if (isset($partidasJugadas[$jugador])) {
        $i = 0; 
        $cantPartidas = count($partidasJugadas[$jugador]["partidas"]);
        while ($i < $cantPartidas && !$encontrado) {
            $partida = $partidasJugadas[$jugador]["partidas"][$i]; 
            if ($partida["palabra"] == $palabraAJugar) {
                    $encontrado = true;
                    }
            $i++; 
        }
    }

    return $encontrado;
}
 
 /** Esta función recibe como parámetro un número y muestra en pantalla los datos de la partida solicitada
  * @param INT $num
 */
function mostrarPartida ($num){
    //array $partidasJugadas
    //array $partida
    //BOOL $encontrada
    //INT $i
    //INT $j
    //INT $indiceJugadas
    $partidasJugadas = cargarPartidas();
    $num = $num - 1;
    $encontrada = false;
    $i = 0;
    $indiceJugadas = 0;
    while ($i < count($partidasJugadas) && !$encontrada) {
        $jugadorActual = array_keys($partidasJugadas)[$i];
        $partidasJugador = $partidasJugadas[$jugadorActual]["partidas"];
        $j = 0;
        while ($j < count($partidasJugador) && !$encontrada) {
            $partida = $partidasJugador[$j];
            if (($indiceJugadas) == $num) {
                echo "Partida WORDIX " .($j+1)." :\n";
                echo "Palabra: " . $partida["palabra"] . "\n";
                echo "Jugador: " . $partida["jugador"] . "\n";
                echo "Puntaje: " . $partida["puntaje"] . " puntos\n";
                if ($partida["intentos"] == 0) {
                    echo "Intento: No adivinó la palabra\n";
                } else {
                    echo "Intento: Adivinó la palabra en " . $partida["intentos"] . " intentos\n";
                }
                $encontrada = true;
            }
            $indiceJugadas++;
            $j++;
        }
        $i++;
    }
    if (!$encontrada) {
       echo "Error: La partida no existe.\n";
    }
}

/** Está función agrega una palabra a la colección de palabras del juego
 * @param array $coleccionPalabras
 * @return array
*/
function agregarPalabras ($coleccionPalabras){
    $palabra = leerPalabra5Letras();
    $esPalabra = esPalabra($palabra);
    while (!$esPalabra){
        echo "Su palabra debe contener sólo letras \n";
        $palabra = leerPalabra5Letras();
    }
    $coleccionPalabras[] = $palabra;
    return $coleccionPalabras;
}

/** Retorna el índice de la primera partida ganada por un jugador.
 * Si el jugador no ganó ninguna partida, retorna -1.
 * @param array $coleccionPartidas 
 * @param string $nombreJugador 
 * @return int 
 */
function primeraPartidaGanada($coleccionPartidas, $nombreJugador) {
    //INT $cantPartidas
    //INT $i
    //INT $posicion
    $i = 0; 
    $cantPartidas = count($coleccionPartidas[$nombreJugador]["partidas"]); 
    $posicion = -1;
    $encontrada = false;
    $indicePartidas = array_keys($coleccionPartidas[$nombreJugador]["partidas"]);
    while ($i < $cantPartidas && !$encontrada) {
        $clavePartida = $indicePartidas[$i];
        $partida = $coleccionPartidas[$nombreJugador]["partidas"][$clavePartida];
        if ($partida["intentos"] > 0) {
            $posicion = $i;
            $encontrada = true;
        }
        $i++;
    }

    return $posicion;
}


 /** Esta función calcula el resumen del jugador y lo retorna en un arreglo asociativo.
 * 
 * @param array $coleccionPartidas 
 * @param string $nombreJugador 
 * @return array 
 */
function obtenerResumenJugador($coleccionPartidas, $nombreJugador) {
    //array $partidasJugadasJugador
    //INT $cantPartidas
    //INT $i
    //INT $puntajeTotal
    //INT $victorias
    //array $adivinadas
    //INT $cantPArtidasJugador
    //INT $j
    //array $partida
    //INT $indiceIntento
    //FLOAT $porcentajeVictorias
    //array $resumenJugador
    $partidasJugadasJugador = $coleccionPartidas[$nombreJugador]["partidas"];
    $puntajeTotal = 0;
    $victorias = 0;
    $adivinadas = [0, 0, 0, 0, 0, 0]; 
    $cantPartidasJugador = count($partidasJugadasJugador);
    for ($j = 0; $j < $cantPartidasJugador; $j++) {
        $partida = $partidasJugadasJugador[$j];
        $puntajeTotal += $partida["puntaje"];
        if ($partida["intentos"] <= 6 && $partida["intentos"] > 0) {
            $victorias++;
            $indiceIntento = $partida["intentos"] - 1;
            $adivinadas[$indiceIntento]++;
        }
    }
    if ($cantPartidasJugador > 0){
        $porcentajeVictorias = (($victorias*100)/ $cantPartidasJugador);
    }
    else{ 
        $porcentajeVictorias = 0;
    }
    

    $resumenJugador = [
        "jugador" => $nombreJugador,
        "partidas" => $cantPartidasJugador,
        "puntajeTotal" => $puntajeTotal,
        "victorias" => $victorias,
        "porcentajeVictorias" => $porcentajeVictorias,
        "adivinadas" => $adivinadas
    ];
    if (count($partidasJugadasJugador) == 0) {
        $resumenJugador = [];
    }

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
    if($a["jugador"] == $b["jugador"]){
        $comparacion = strcmp($a["palabra"],$b["palabra"]);
    } else{
            $comparacion = strcmp($a["jugador"],$b["jugador"]);
        }
    return $comparacion;
}

/** Ésta función ordena una colección de partidas por nombre de jugador y por palabra.
 * Luego la muestra por pantalla
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
$partidasJugadas = cargarPartidas();
$coleccionPalabras = cargarColeccionPalabras();

//Proceso:
do{ 
    $opcion = seleccionarOpcion();
    switch ($opcion){
        case 1: 
            $coleccionPalabras = cargarColeccionPalabras();
            $palabraValida = false;
            $jugador = solicitarJugador();
            while (!$palabraValida) {
                $cantPalabras = count($coleccionPalabras);
                echo "Seleccione su palabra de juego ingresando un número del 1 al " . ($cantPalabras -1). ": ";
                $posicionPalabra = solicitarNumeroEntre(1,($cantPalabras-1));
                $palabraElegida = $coleccionPalabras[$posicionPalabra];
                if (verificarNoRepetirPalabra($jugador, $palabraElegida, $partidasJugadas)) {
                    echo "La palabra ya fue utilizada por este jugador." . "\n\"";
                } else {
                    $palabraValida = true;
                }
                }
            $partida = jugarWordix($palabraElegida, $jugador);
            $partidasJugadas = cargarPartidas($partida);
            break;
        case 2:
            $jugador = solicitarJugador();
            $coleccionPalabras = cargarColeccionPalabras();
            $palabraAleatoria = "";
            do { 
                $aleatoria = array_rand($coleccionPalabras);
                $palabraAleatoria = $coleccionPalabras[$aleatoria];
            } while (verificarNoRepetirPalabra($jugador, $palabraAleatoria, $partidasJugadas));
            $partida = jugarWordix($palabraAleatoria, $jugador);
            $partidasJugadas = cargarPartidas($partida);
            break;
        case 3: 
            $partidasJugadas = cargarPartidas();
            $cantPartidas = 0;
            for ($i = 0; $i < count($partidasJugadas); $i++) {
                $jugadorActual = array_keys($partidasJugadas)[$i];
                $cantPartidas += count($partidasJugadas[$jugadorActual]["partidas"]);
            }
            echo "Ingrese el número de partida (1-" . $cantPartidas . "): ";
            $numeroPartida = trim(fgets(STDIN));
            $mostrarPartida =  mostrarPartida($numeroPartida);
            break;
        case 4: 
            $partidasJugadas = cargarPartidas(); 
            $jugador = solicitarJugador();
            $partidasJugador = $partidasJugadas[$jugador]["partidas"];
            $indiceGanada = primeraPartidaGanada($partidasJugadas, $jugador);
            if ($indiceGanada !== -1) { 
                $partidaGanada = $partidasJugadas[$jugador]["partidas"][$indiceGanada];
                echo "Partida WORDIX ganada por " . $jugador . ":\n";
                echo "Palabra: " . $partidaGanada["palabra"] . "\n";
                echo "Puntaje: " . $partidaGanada["puntaje"] . " puntos\n";
                echo "Intento: Adivinó la palabra en " . $partidaGanada["intentos"] . " intentos\n";
            } else { 
                echo "El jugador " . $jugador . " no ganó ninguna partida.\n";
            }
            break;
        case 5:
            $partidasJugadas = cargarPartidas();
            $jugador = solicitarJugador(); 
            $resumen = obtenerResumenJugador($partidasJugadas, $jugador);
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
                for ($i = 1; $i <= 6; $i++) {
                    echo "Intento " . $i . ": " . $resumen["adivinadas"][$i - 1] . "\n";
                }
                echo "**************************************************\n";
                }
            break;
        case 6:
            $partidasJugadas = cargarPartidas();
            mostrarPartidasOrdenadas($partidasJugadas);
            break;
        case 7:
            $coleccionPalabras = cargarColeccionPalabras();
            $coleccionPalabras = agregarPalabras($coleccionPalabras);
            echo "Tu palabra ah sido agregada.";
            break;
        case 8:
            echo "Hasta pronto!\n";
            exit;
            break;        
    }
}while ($opcion != 8);
?>