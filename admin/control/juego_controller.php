<?php
require_once(__DIR__ . '/../../config.php');
require_once(BASE_PATH . "/model/repository/CentroRepository.php");
require_once(BASE_PATH . "/model/repository/JuegoRepository.php");
require_once(BASE_PATH . "/model/repository/PreguntaRepository.php");

$centro = $_POST['centro'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$action = $_POST['action'];

if ($action == 'crearJuegosByCentro') {

    //0. Elegir preguntas generales
    $preguntaRepo = new PreguntaRepository();
    $preguntasGenerales = $preguntaRepo->seleccionarPreguntasGenerales();
    var_dump($preguntasGenerales);

    //1. Obtener familias del centro
    $centroRepo = new CentroRepository();
    $familias = $centroRepo->getFamiliasByCentroId($centro);

    //2. Crear juego
    foreach ($familias as $familia) {
        $familiaId = (int)$familia->getId();
        $juegoRepo = new JuegoRepository();
        $juegoId = $juegoRepo->crearJuego($familiaId, $fecha_inicio, $fecha_fin);

        //3. Elegir preguntas por familia
        $preguntas = $preguntaRepo->seleccionarPreguntas($familiaId);
        $preguntasFinales = array_merge($preguntasGenerales, $preguntas);
        echo ('<pre>');
        var_dump($preguntasFinales);
        echo ('</pre>');

        //4. Asignar preguntas al juego
        foreach($preguntasFinales as $pregunta){
            $juegoRepo->addPreguntaToJuego($juegoId, $pregunta->getId());
        }
    }
}

// header("Location: ../index.php?s=test-admin"); 
