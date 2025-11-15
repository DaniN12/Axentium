<?php
require_once(__DIR__ . '/../../config.php');
require_once(BASE_PATH . "/model/repository/PreguntaRepository.php");
require_once(BASE_PATH . "/model/Pregunta.class.php");

$bd = new AccesoBD();
$preguntaRepository = new PreguntaRepository($bd->conexion);

$imgNombre = null;
if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_OK) {
    $tmpName = $_FILES['img']['tmp_name'];
    $imgNombre = basename($_FILES['img']['name']);

    $imgNombre = time() . '_' . preg_replace("/[^a-zA-Z0-9_\.-]/", "_", $imgNombre);

    $destino = BASE_PATH . "/assets/img/" . $imgNombre;

    move_uploaded_file($tmpName, $destino);
}

try {
    if ($_POST['action'] === 'crearPreguntaGeneral') {
        $preguntaRepository->crearPregunta(
            $_POST['pregunta'],
            $_POST['opcion1'],
            $_POST['opcion2'],
            $_POST['opcion3'],
            $_POST['correcta'],
            null,                // familiaId
            $_POST['categoria'],  // categoriaId
            $imgNombre
        );
    }

    if ($_POST['action'] === 'crearPreguntaFamilia') {
        $preguntaRepository->crearPregunta(
            $_POST['pregunta'],
            $_POST['opcion1'],
            $_POST['opcion2'],
            $_POST['opcion3'],
            $_POST['correcta'],
            $_POST['familia'],   // familiaId
            null,                 // categoriaId
            $imgNombre
        );
    }

    header('Location: ' . BASE_URL . 'admin/index.php?s=preguntas');

} catch (Exception $e) {
    header("Location: " . BASE_URL . "admin/index.php?s=preguntas&error=" . urlencode($e->getMessage()));

}
?>
