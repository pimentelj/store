# Store
Prueba Técnica - DESARROLLADOR PHP

## :white_check_mark: Pre-Requisitos
1. Tener activo en el `php.ini` la extensión de `soap` para poder realizar petición a la API de PlacetoPay. 
⋅⋅⋅Si este no se encuentra activo se tendrá inconveniente en la dependencia `dnetix/redirection` instalada.

```
extension=soap
```

2. Tener instalado composer para realizar la instalación de las dependiencias propias de laravel y la de dnetic/redirection para realizar las peticiones a PlacetoPay.

## :white_check_mark: Instalación
1. Clonar el proyecto en un directorio en el disco local.
```
git clone https://github.com/pimentelj/store.git
```
2. En la consola ir hasta la ruta donde se clono el proyecto e instalar las dependencias utilizando composer con la siguiente instrucción:
```
composer install
```
3. Cambiar el nombre del archivo `.env.example` por `.env`.
4. En la base de datos mysql crear el schema con el nombre `store` y agregar un usuario colocandole `username` y `password` para acceder al schema creado. El usuario debe tener todos los permisos sobre el schema `store`. 
En el archivo `.env`, en la variable de entorno `DB_USERNAME` colocar el `username` y en `DB_PASSWORD` el `password` que se acabo de configurar para el usuario con acceso. Por defecto el username es root y el password esta vacio.
5. Parar correr las migraciones y seeder ejecutamos el comando 
```
php artisan migrate:fresh --seed
```
6. Para correr los test ejecutar el comando 
```
php artisan test
```
7. Para correr el proyecto como un servidor ejecutar el siguiente comando, luego proceder a abrir un navegador y escribir la url `http://127.0.0.1:8000`
```
php artisan serve
```