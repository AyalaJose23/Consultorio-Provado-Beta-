🔌 Conexión a la Base de Datos
Este proyecto utiliza PHP y PostgreSQL dentro de un entorno local proporcionado por XAMPP.

🧩 Requisitos
Antes de ejecutar el sistema, asegúrate de tener instalados y configurados los siguientes componentes:

* XAMPP (incluye Apache y PHP)

* PostgreSQL (como motor de base de datos)

* Extensión pgsql habilitada en PHP (ver más abajo)

Navegador web

⚙️ Configuración de la conexión
El archivo conexion.php contiene la clase conexion que maneja la conexión a la base de datos:


📌 Parámetros de conexión:
host: Dirección del servidor PostgreSQL (por defecto localhost)

port: Puerto del servidor PostgreSQL (por defecto 5432)

dbname: Nombre de la base de datos (taller4)

user: Usuario de PostgreSQL (postgres)

password: Contraseña del usuario (123)

Puedes modificar estos valores según tu entorno local o de producción.

🛠️ Habilitar extensión pgsql en XAMPP
Para que PHP se conecte a PostgreSQL, debes habilitar la extensión pgsql en tu instalación de XAMPP:

Abre el archivo php.ini (lo encuentras en xampp/php/php.ini)

Busca las siguientes líneas y quítales el ; (si lo tienen):

ini
extension=pgsql
extension=pdo_pgsql

Guarda el archivo y reinicia Apache desde el panel de control de XAMPP.
