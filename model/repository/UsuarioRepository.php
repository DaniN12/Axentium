
<?php
require_once(BASE_PATH . "/model/AccesoBD.class.php");
require_once(BASE_PATH . "/model/Centro.class.php");
require_once(BASE_PATH . "/model/Familia.class.php");
require_once(BASE_PATH . "/model/Ciclo.class.php");
require_once(BASE_PATH . "/model/Rol.class.php");
require_once(BASE_PATH . "/model/Usuario.class.php");

class UsuarioRepository
{
    private $conexion;

    function __construct($conexion)
    {
        $this->conexion = $conexion;
    }

    const ROL_USUARIO = 2;

    function registrarUsuario($username, $email, $pass, $centro, $ciclo)
    {
        $pass = md5($pass);

        $sql = "SELECT id FROM usuarios WHERE email='$email'";
        $result = mysqli_query($this->conexion, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            return false; //el usuario ya existe
        }

        $sqlInsert = "INSERT INTO usuarios(username, email, password, rolId, centroId, cicloId)
                    VALUES ('$username','$email','$pass', '" . self::ROL_USUARIO . "', '$centro', '$ciclo')";
        mysqli_query($this->conexion, $sqlInsert);

        return true;
    }

    function getUser($username, $pass)
    {
        $sql = "SELECT u.id, u.username, u.email, u.rolId, r.nombre AS rol,
            u.cicloId, ci.nombre AS cicloNombre, ci.familiaId, 
            u.centroId, c.nombre AS centroNombre
            FROM usuarios u
            INNER JOIN roles r ON u.rolId=r.id 
            INNER JOIN centros c ON u.centroId=c.id
            INNER JOIN ciclos ci ON u.cicloId=ci.id
            WHERE username='$username' AND password='$pass' 
            LIMIT 1;";
        $result = mysqli_query($this->conexion, $sql);

        if ($result && $fila = mysqli_fetch_assoc($result)) {

            extract($fila);

            $rol = new Rol($rol, $rolId);
            $centro = new Centro($centroId, $centroNombre);
            $familia = new Familia($familiaId);
            $ciclo = new Ciclo($cicloId, $cicloNombre, $familia);
            $user = new Usuario($id, $username, $email, $rol, $ciclo, $centro);
            return $user;
        }
        return null;
    }

    function getUsuarioIdByUsername($username)
    {
        $usernameSanitized = mysqli_real_escape_string($this->conexion, (string)$username);

        $sql = "SELECT id 
            FROM usuarios 
            WHERE username = '$usernameSanitized' LIMIT 1;";

        $result = mysqli_query($this->conexion, $sql);

        if ($result && $fila = mysqli_fetch_assoc($result)) {
            $id = $fila['id'];
            mysqli_free_result($result);
            return $id;
        }
        return null;
    }

    function getUserById($id)
    {
        $sql = "SELECT u.id, u.username, u.email, u.rolId, r.nombre AS rol,
            u.cicloId, ci.nombre AS cicloNombre, ci.familiaId, 
            u.centroId, c.nombre AS centroNombre
            FROM usuarios u
            INNER JOIN roles r ON u.rolId=r.id 
            INNER JOIN centros c ON u.centroId=c.id
            INNER JOIN ciclos ci ON u.cicloId=ci.id
            WHERE u.id='$id' 
            LIMIT 1;";
        $result = mysqli_query($this->conexion, $sql);

        if ($result && $fila = mysqli_fetch_assoc($result)) {

            extract($fila);

            $rol = new Rol($rol, $rolId);
            $centro = new Centro($centroId, $centroNombre);
            $familia = new Familia($familiaId);
            $ciclo = new Ciclo($cicloId, $cicloNombre, $familia);
            $user = new Usuario($id, $username, $email, $rol, $ciclo, $centro);
            return $user;
        }
        return null;
    }
    function getAllUsuarios()
    {
        $sql = "SELECT u.id, u.username, u.email, u.rolId, r.nombre AS rol,
            u.cicloId, ci.nombre AS cicloNombre, ci.familiaId, 
            u.centroId, c.nombre AS centroNombre
            FROM usuarios u
            INNER JOIN roles r ON u.rolId=r.id 
            INNER JOIN centros c ON u.centroId=c.id
            INNER JOIN ciclos ci ON u.cicloId=ci.id
            INNER JOIN familias f ON f.id=ci.familiaId;";

        $result = mysqli_query($this->conexion, $sql);
        $usuarios = [];

        if ($result) {
            while ($fila = mysqli_fetch_assoc($result)) {
                extract($fila);

                $rol = new Rol($rol, $rolId);
                $centro = new Centro($centroId, $centroNombre);
                $familia = new Familia($familiaId);
                $ciclo = new Ciclo($cicloId, $cicloNombre, $familia);

                $user = new Usuario($id, $username, $email, $rol, $ciclo, $centro);
                $usuarios[] = $user;
            }
        }
        return $usuarios;
    }
}
?>
