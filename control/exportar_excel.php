<?php
require_once(__DIR__ . '/../model/repository/GlosarioRepository.php');

$repo = new GlosarioRepository();
$palabras = $repo->obtenerTodos();

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=glosario_euskera_castellano.xls");
header("Pragma: no-cache");
header("Expires: 0");

echo "Palabra en Euskera\tPalabra en Castellano\n";
foreach ($palabras as $p) {
    echo $p->palabra_euskera . "\t" . $p->palabra_castellano . "\n";
}
exit;
?>
