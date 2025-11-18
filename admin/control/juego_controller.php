<?php
require_once(__DIR__ . '/../../config.php');
require_once(BASE_PATH . "/model/repository/CentroRepository.php");
require_once(BASE_PATH . "/model/repository/JuegoRepository.php");
require_once(BASE_PATH . "/model/repository/PreguntaRepository.php");

$centroId = $_POST['centro'];
$fecha_inicio = $_POST['fecha_inicio'];
$fecha_fin = $_POST['fecha_fin'];
$action = $_POST['action'] ?? $_GET['action'] ?? null;

$bd = new AccesoBD();
$conexion = $bd->conexion;
$preguntaRepo = new PreguntaRepository($conexion);
$centroRepo = new CentroRepository($conexion);
$juegoRepo = new JuegoRepository($conexion);


if ($action == 'crearJuegosByCentro'  && $centroId && $fecha_inicio && $fecha_fin) {

    //0. Actualizar juegos activos
    $juegoRepo->actualizarJuegosActivos();

    //1. Elegir preguntas generales
    $preguntasGenerales = $preguntaRepo->seleccionarPreguntasGenerales();

    //2. Obtener familias del centro
    $familias = $centroRepo->getFamiliasByCentroId($centroId);

    foreach ($familias as $familia) {
        $familiaId = (int)$familia->getId();

        //3. Transacción por familia
        try {
            mysqli_begin_transaction($conexion);

            //3.1 Crear juego
            $juegoId = $juegoRepo->crearJuego($familiaId, $fecha_inicio, $fecha_fin);
            if (!$juegoId) {
                throw new Exception("No se pudo crear el juego para la familia $familiaId");
            }
            //3.2 Seleccionar preguntas por familia
            $preguntasFamilia = $preguntaRepo->seleccionarPreguntas($familiaId);

            //3.3 Juntar preguntas
            $preguntasFinales = alternarPreguntas($preguntasGenerales, $preguntasFamilia);

            $preguntasIds = [];
            foreach ($preguntasFinales as $pregunta) {
                $preguntasIds[] = $pregunta->getId();
            }

            //3.4 Asignar preguntas al juego
            $juegoRepo->addPreguntasToJuegoBulk($juegoId, $preguntasIds);

            mysqli_commit($conexion);
        } catch (Exception $e) {
            mysqli_rollback($conexion);
            error_log("Error creando juego familia $familiaId: " . $e->getMessage());
            throw $e;
        }
    }
    $bd->cerrarConexion();
    header('Location: ' . BASE_URL . 'admin/index.php?s=juegos');
}
if ($action == 'eliminar' && isset($_GET['id'])) {
    $juegoId = $_GET['id'];
    $juegoRepo->eliminarJuego($juegoId);
    header('Location: ' . BASE_URL . 'admin/index.php?s=juegos');
}

function alternarPreguntas($generales, $familia)
{
    $resultado = [];
    $i = 0;

    // Alternar hasta que alguno se acabe
    while ($i < count($generales) || $i < count($familia)) {
        if ($i < count($generales)) {
            $resultado[] = $generales[$i];
        }
        if ($i < count($familia)) {
            $resultado[] = $familia[$i];
        }
        $i++;
    }

    return $resultado;
}
