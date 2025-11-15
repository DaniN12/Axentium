
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
    function getCountUsuarios()
    {
        $sql = "SELECT COUNT(id) as total FROM usuarios;";
        $result = mysqli_query($this->conexion, $sql);
        $fila = mysqli_fetch_assoc($result);
        return $fila['total'];
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
    function getCountNuevosUsuariosSemana()
    {
        $sql = "SELECT COUNT(id) AS total
            FROM usuarios
            WHERE YEARWEEK(fecha_registro, 1) = YEARWEEK(NOW(), 1)";

        $result = mysqli_query($this->conexion, $sql);
        $fila = mysqli_fetch_assoc($result);
        return $fila['total'];
    }
    function eliminarUsuario($id)
    {
        $idSanitized = mysqli_real_escape_string($this->conexion, (int)$id);
        $sql = "DELETE FROM usuarios WHERE id='$idSanitized'";
        return mysqli_query($this->conexion, $sql);
    }
    function editarUsuario($id, $username, $email, $pass = null, $centroId, $cicloId, $rolId)
    {
        $idSanitized = mysqli_real_escape_string($this->conexion, (int)$id);
        $usernameSanitized = mysqli_real_escape_string($this->conexion, $username);
        $emailSanitized = mysqli_real_escape_string($this->conexion, $email);
        $centroSanitized = mysqli_real_escape_string($this->conexion, (int)$centroId);
        $cicloSanitized = mysqli_real_escape_string($this->conexion, (int)$cicloId);
        $rolSanitized = mysqli_real_escape_string($this->conexion, (int)$rolId);

        $sql = "UPDATE usuarios SET 
                    username='$usernameSanitized', 
                    email='$emailSanitized', 
                    centroId='$centroSanitized', 
                    cicloId='$cicloSanitized', 
                    rolId='$rolSanitized'";

        if ($pass !== null && $pass !== '') {
            $passHashed = md5($pass);
            $sql .= ", password='$passHashed'";
        }

        $sql .= " WHERE id='$idSanitized'";

        return mysqli_query($this->conexion, $sql);
    }
}
?>
