
<?php
require_once(BASE_PATH."/model/AccesoBD.class.php");
require_once(BASE_PATH."/model/Rol.class.php");
require_once(BASE_PATH."/model/Usuario.class.php");

class UsuarioRepository
{
    const ROL_USUARIO = 2;

    function registrarUsuario($username, $email, $pass, $centro, $ciclo)
    {
        $bd = new AccesoBD();
        $pass = md5($pass);

        $sqlCheck = "SELECT id FROM usuarios WHERE email='$email'";
        $result = $bd->lanzarSQL($sqlCheck);

        if ($result && mysqli_num_rows($result) > 0) {
            return false; //el usuario ya existe
        }

        $sqlInsert = "INSERT INTO usuarios(username, email, password, rolId, centroId, cicloId)
                    VALUES ('$username','$email','$pass', '".self::ROL_USUARIO."', '$centro', '$ciclo')";
        $bd->lanzarSQL($sqlInsert);

        return true;
    }

    function getUser($username, $pass)
    {
        $bd = new AccesoBD();
        $sql = "SELECT u.id, u.username, u.email, u.rolId, r.nombre AS rol
            FROM usuarios u
            INNER JOIN roles r ON u.rolId=r.id 
            WHERE username='$username' AND password='$pass' 
            LIMIT 1;";
        $result = mysqli_query($bd->conexion, $sql);

        if ($result && $fila = mysqli_fetch_assoc($result)) {

            extract($fila);

            $rol = new Rol($rol, $rolId);
            $user = new Usuario($id, $username, $email, $rol);
            return $user;
            
        }
        return null;
    }

    function getUsuarioIdByUsername($username)
    {
        $bd = new AccesoBD();
        $usernameSanitized = mysqli_real_escape_string($bd->conexion, (string)$username);

        $sql = "SELECT id 
            FROM usuarios 
            WHERE username = '$usernameSanitized' LIMIT 1;";

        $result = mysqli_query($bd->conexion, $sql);

        if ($result && $fila = mysqli_fetch_assoc($result)) {
            $id = $fila['id'];
            mysqli_free_result($result);
            return $id;
        }
        return null;
    }

    function getUserById($id)
    {
        $bd = new AccesoBD();
        $sql = "SELECT username, email, fecha_verificacion, rolId, roles.rol
            FROM usuarios 
            INNER JOIN roles ON usuarios.rolId=roles.id 
            WHERE usuarios.id='$id' 
            LIMIT 1;";
        $result = mysqli_query($bd->conexion, $sql);

        if ($result && $fila = mysqli_fetch_assoc($result)) {

            extract($fila);

            if ($fecha_verificacion == null) {
                return null;
            } else {
                $rol = new Rol($rol, $rolId);
                $user = new Usuario($id, $username, $email, $rol);
                return $user;
            }
        }
        return null;
    }
}
?>
