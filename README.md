## Prueba: Registro de Ventas
Ejecutar los siguientes comandos:

1. Clonar el repositorio 
- git clone https://github.com/alemurillo104/prueba_registro_ventas.git

2. Dirigirse al directorio del proyecto
- cd prueba_registro_ventas/

3. Instalar dependencias
- composer install

4. Clonar el archivo .env.example para declarar las variables de entorno 
- cp .env.example .env

5. Generar la clave unica
- php artisan key:generate

6. Crear la base de datos en el SGBD, en este caso utilizamos postgres y lo realizamos en pgAdmin, 
(nombre ejm: db_prueba_gob)
    
7. Abrir el proyecto en un editor de código (por ejm: VS Code) 
y editar el archivo .env agregando las variables de entorno para la conexión a la base de datos

    DB_CONNECTION=pgsql
    DB_HOST=127.0.0.1
    DB_PORT=5432
    DB_DATABASE=db_prueba_gob
    DB_USERNAME=SU_NOMBRE_DE_USUARIO
    DB_PASSWORD=SU_CONTRASEÑA

8. Para ejecutar las migraciones, creación de tablas y cargar la data inicial, ejecutamos:
- php artisan migrate:fresh --seed

9. Para correr el proyecto
- php artisan serve

Listo!
