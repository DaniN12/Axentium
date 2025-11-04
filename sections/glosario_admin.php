<?php
require_once(__DIR__ . '/../model/repository/GlosarioRepository.php');
$repo = new GlosarioRepository();
$palabras = $repo->obtenerTodos();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin - Glosario Euskera / Castellano</title>
    <link rel="stylesheet" href="../css/estilos.css">
</head>
<body>
    <h1>Glosario Euskera / Castellano (Admin)</h1>

    <form method="post" action="control/glosario_controller.php">
        <input type="text" name="palabra_euskera" placeholder="Palabra en Euskera" required>
        <input type="text" name="palabra_castellano" placeholder="Palabra en Castellano" required>
        <button type="submit" name="agregar">Agregar</button>
    </form>

    <a href="../control/exportar_excel.php" class="export-btn">Exportar a Excel</a>

    <table border="1" width="70%">
        <tr>
            <th>Palabra en Euskera</th>
            <th>Palabra en Castellano</th>
            <th>Acciones</th>
        </tr>

        <?php foreach ($palabras as $p): ?>
            <tr>
                <form method="post" action="../control/glosario_controller.php">
                    <td><input type="text" name="palabra_euskera" value="<?= htmlspecialchars($p->palabra_euskera) ?>"></td>
                    <td><input type="text" name="palabra_castellano" value="<?= htmlspecialchars($p->palabra_castellano) ?>"></td>
                    <td>
                        <input type="hidden" name="id" value="<?= $p->id ?>">
                        <button type="submit" name="editar">Guardar</button>
                        <button type="submit" name="eliminar" onclick="return confirm('¿Eliminar esta palabra?')">Eliminar</button>
                    </td>
                </form>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
