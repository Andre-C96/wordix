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

/** Esta función presenta el menú de opciones al usuario
 * Se encarga de que la opción sea valida
 * @return INT
 */
function seleccionarOpcion(){
    echo "Menú de opciones:\n";
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
    static $arrayPartidasJugadas = [];

    if($partidaJugada !== null){
        $partida = $partidaJugada;
        $jugadorActual = $partida["jugador"];
        if (!$arrayPartidasJugadas[$jugadorActual]){
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
                "intentos" => $partida["intentos"],
                "palabra" => $partida["palabra"],
                "puntaje" => $partida["puntaje"]
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
        $encontrado = false;
        if (($partidasJugadas[$jugador])) {
            foreach ($partidasJugadas[$jugador]["partidas"] as $partida) {
                if ($partida["palabra"] == $palabraAJugar) {
                    $encontrado = true;
                }
            }
        }
        return $encontrado;
    }
 
 
/**
 * Ésta función compara las partidas para ordenarlas por jugador y por palabra
 * @param STRING $a, $b
 * @return 
 */
function compararPartidas ($a,$b){
    if($a["jugador"] == $b["jugador"]){
        $comparacion = strcmp($a["palabra"],$b["palabra"]);
    } else{
            $comparacion = strcmp($a["jugador"],$b["jugador"]);
        }
    return $comparacion;
}


/**************************************/
/*********** PROGRAMA PRINCIPAL *******/
/**************************************/

//Declaración de variables:


//Inicialización de variables:
$almacenarPartidas = [];
$partidasJugadas = cargarPartidas();

//Proceso:
do{ 
    $opcion = seleccionarOpcion();
    switch ($opcion){
        case 1: 
            $palabraElegida = "";
            $palabraValida = false;
            $coleccionPalabras = cargarColeccionPalabras();
            echo "Ingresa tu nombre: ";
            $jugador = trim(fgets(STDIN));
            while (!$palabraValida) {
                echo "Seleccione su palabra de juego ingresando un número del 1 al 15: ";
                $posicionPalabra = solicitarNumeroEntre(1,15);
                $palabraElegida = $coleccionPalabras[$posicionPalabra];
                if (verificarNoRepetirPalabra($jugador, $palabraElegida, $partidasJugadas)) {
                    echo "La palabra ya fue utilizada por este jugador." . "\n\"";
                } else {
                    $palabraValida = true;
                }
            }
            $partida = jugarWordix($palabraElegida, $jugador);
            $almacenarPartidas = cargarPartidas($partida);
            break;
        case 2:
            echo "Ingresa tu nombre: ";
            $jugador = trim(fgets(STDIN));
            $coleccionPalabras = cargarColeccionPalabras();
            $palabraAleatoria = "";
            do { 
                $aleatoria = array_rand($coleccionPalabras);
                $palabraAleatoria = $coleccionPalabras[$aleatoria];
            } while (verificarNoRepetirPalabra($jugador, $palabraAleatoria, $PartidasJugadas));
            $partida = jugarWordix($palabraAleatoria, $jugador);
            $almacenarPartidas = cargarPartidas($partida);
            break;
        case 3: 
            $partidasJugadas = cargarPartidas();
            $cantPartidas = count($partidasJugadas) - 1;
            echo "Ingrese el número de partida (1-" . $cantPartidas . "): ";
            $numeroPartida = trim(fgets(STDIN));
            if (isset($partidasJugadas[$numeroPartida])) {
                 $partida = $partidasJugadas[$numeroPartida];
                echo "Partida WORDIX $numeroPartida:\n";
                echo "Palabra: " . $partida["palabra"] . "\n";
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
            break;
        case 4: 
            $partidasJugadas = cargarPartidas();
            echo "Ingrese el nombre del jugador: ";
            $jugador = trim(fgets(STDIN));
            $encontrado = false;
            $partidaGanada = [];
            $i = 0;
            $cantPartidasJugadas = count($partidasJugadas);
            while ($i < $cantPartidasJugadas && !$encontrado) {
                if ($partidasJugadas[$i]["jugador"] == $jugador && $partidasJugadas[$i]["intentos"] > 0) {
                    $partidaGanada = $partidasJugadas[$i];
                    $encontrada = true;
                }
            $i++;
            }
    
            if ($encontrado) {
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
            echo "Ingrese el nombre del jugador: ";
            $jugador = trim(fgets(STDIN));
            
            $partidasJugadasJugador = [];
            $cantPartidasJugadas = count($partidasJugadas);
            $i = 0;
            while( $i < $cantPartidasJugadas){
                if( $partidasJugadas [$i]["jugador"]== $jugador){
                    $partidasJugadasJugador[] = $partidasJugadas[$i];
                }
                $i++;
            }
            $cantPartidasJugadasJugador = count($partidasJugadasJugador);
            if($partidasJugadasJugador > 0 ){
                $puntajeTotal = 0;
                $victorias = 0;
                $adivinadas = [0,0,0,0,0,0];

                $i = 0;
                while($i < $cantPartidasJugadasJugador){
                    $puntajeTotal += $cantPartidasJugadasJugador[$i]["puntaje"];
                    if($cantPartidasJugadasJugador[$i]["intentos"] > 0 ){
                        $victorias ++;
                        $indiceIntento = $partidasJugadasJugador[$i]["intentos"] -1;
                        $adivinadas[$indiceIntento]++;
                    }
                    $i++;
                }
                $porcentajeVictorias = (($victorias *100)/$cantPartidasJugadasJugador);

                echo "**************************************************\n";
                echo "Jugador: " . $jugador . "\n";
                echo "Partidas: " . $cantPartidasJugadasJugador . "\n";
                echo "Puntaje Total: " . $puntajeTotal . "\n";
                echo "Victorias: " . $victorias . "\n";
                echo "Porcentaje Victorias: " . $porcentajeVictorias . "\n";
                echo "Adivinadas:\n";
                for($i =1; $i <= 6; $i++){
                    echo "Intento: " . $i . ":" . $adivinadas[$i - 1] . "\n";
                }
                echo "**************************************************\n";
            } else {
                echo "El jugador " . $jugador . " no tiene partidas jugadas.\n";
            }
            break;
        case 6:
            $partidasJugadas = cargarPartidas();
            uasort($partidasJugadas, "compararPartidas");
            echo "Listado de partidas ordenadas por jugador y por palabra:\n";
            print_r($partidasJugadas);
            break;
        case 7:
            $palabra = leerPalabra5Letras();
            $esPalabra = esPalabra($palabra);
            while (!$esPalabra){
                echo "Su palabra debe contener sólo letras \n";
                $palabra = leerPalabra5Letras();
            }
            break;
        case 8:
            echo "Hasta pronto!\n";
            exit;
            break;        
    }
}while ($opcion != 8);
?>