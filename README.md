Pasos Instalacion


El equipo debe contar con XAMPP -MYSQL, y laravel instalado y composer instalado ,Nodej Js


* Clone el repositorio si le es mas facil por SSH (Tener configurado git en el computador ) **git@github.com:3stiven/prueba_dev_nexura.g**i**t**  o si es mejor HHTPS (Este le permite clonar sin ninguna key SSH)  **https://github.com/3stiven/prueba_dev_nexura.git**
* El proyecto cuenta con un archivo .env  donde en la linea 14 ,contara con la conexion a la DB , este solamente pedira el nombre de la plata que creen en su ambiente de base de datos y si lo requiere credenciales.
* Luego ejecutar en la consola npm install , para instalar los repositorios o librerias necesario o usadas en el proyecto.
* Luego ejecutar composer update .
* luego de tener configurado el archivo .env , ejecutaras el el siguiente comando  **php artisan migrate --seed** este comando ejecutara las tablas de la base de datos , y **--seed** ejecutara los sembradores que son registro por defectos que cree y esto hara un insert en cada tabla
* todo este proceso no deberia generar problema ya que el proyecto esta totalmente limpio.
* por ultimo ejecutar en la terminal php artisan serve y en otra terminal ejecutar npm run watch (php artisan serve ejecutara back y npm run watch ejecutar el front  el js).
* en el navegador correras 127.0.0.0:8000 (ruta por defecto ) , o lo que el comando php artisan serve te haya respondido .
