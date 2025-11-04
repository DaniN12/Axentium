<?php
require_once(__DIR__ . '/../model/repository/GlosarioRepository.php');
$repo = new GlosarioRepository();
$palabras = $repo->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Glosario Euskera / Castellano</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h1>Glosario Euskera / Castellano</h1>

    <table border="1" width="70%">
        <tr>
            <th>Palabra en Euskera</th>
            <th>Palabra en Castellano</th>
        </tr>

        <?php foreach ($palabras as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p->palabra_euskera) ?></td>
                <td><?= htmlspecialchars($p->palabra_castellano) ?></td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
