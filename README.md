# Axentium

Guía rápida para poner en marcha la aplicación en local.

## Requisitos
- **PHP** con extensión **mysqli** habilitada.
- **Servidor web** (Apache recomendado). Puedes usar **Uniform Server Zero (UniServerZ)** o **XAMPP**.
- **MySQL/MariaDB**.

No hay dependencias de Composer (no existe `composer.json`).

## Estructura y puntos de entrada
- **Frontend público**: `http://localhost/Axentium/`
- **Panel de administración**: `http://localhost/Axentium/admin/`
- **El login redirige automáticamente las cuentas con rol de admin al panel de administración** 
Credenciales de administrador: usuario: admin, contraseña:1234

## Configuración básica
1. Clona o copia este repositorio dentro del directorio público de tu servidor web.
   - UniServerZ (Windows): `UniServerZ\www\Axentium`
   - XAMPP (Windows): `xampp\htdocs\Axentium`

2. Ajusta la URL base si cambias la carpeta o el puerto:
   - Archivo: `config.php`
   - Constante: `BASE_URL`
   - Valor por defecto: `http://localhost/Axentium/`

3. Configura la conexión a base de datos:
   - Archivo: `model/AccesoBD.class.php`
   - Constantes por defecto:
     - `RUTA = "localhost"`
     - `BD = "lhizki"`
     - `USER = "root"`
     - `PASS = "123"`
   - Cambia `USER` y `PASS` por credenciales válidas en tu entorno.

## Base de datos
1. Importa el esquema/datos desde el archivo `lhizki.sql` ubicado en la raíz del proyecto.
   - Con phpMyAdmin: Importar → seleccionar `lhizki.sql` → ejecutar.

## Arranque
1. Inicia el servidor web (Apache) y la base de datos (MySQL/MariaDB).
2. Accede en el navegador a:
   - Público: `http://localhost/Axentium/`
   - Admin: `http://localhost/Axentium/admin/`

## Notas y resolución de problemas
- **Extensión mysqli**: asegúrate de que `mysqli` esté habilitado en PHP.
- **Credenciales**: si ves "Error al establecer la conexión", revisa `USER`/`PASS`/`BD`/`RUTA` en `model/AccesoBD.class.php` y que la BD exista.
- **Ruta/URL base**: si no usas `http://localhost/Axentium/`, ajusta `BASE_URL` en `config.php`.
- **Charset**: se usa `utf8mb4` por defecto en la conexión.

## Seguridad (producción)
- No uses `root/123` en producción. Crea un usuario con permisos limitados y contraseña robusta.
- No expongas este repositorio con credenciales por defecto.

## Licencia
Si no se especifica, este proyecto se considera de uso académico/interno.
