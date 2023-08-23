## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

# Gobierno Digital

Fernando Jacobo Paredes

## Instrucciones para desplegar el sistema

	-Crear una base de datos llamada laravel, o si se quiere pueden cambiar el nombre en el archivo .env
	-Ejecutar #php artisan migrate
	-Ejecutar #php artisan db:seed
	-En caso de recibir algun error revisar que la version de laravel sea 8
	-Instalar las dependencias y librerias como:
		        "facade/ignition": "^2.5",
        		"fakerphp/faker": "^1.9.1",
        		"laravel/sail": "^1.0.1",
        		"mockery/mockery": "^1.4.4",
        		"nunomaduro/collision": "^5.10",
        		"phpunit/phpunit": "^9.5.10"
	para mas informacion revisar el archivo composer.json, revisar la carpeta vendor o ejecutar #composer show
	-Si el seeder se ejecutó correctamente estarán registrados 15 usuarios que serán generados por Faker, serán de tipo
	Administrador o Usuarios, siendo que solo el Administrador puede Crear, Eliminar y Editar usuarios
	-Para consumir la Api se debe ingresar el email del usuario y la contraseña, todos los usuarios tienen de clave '12345'
	con el fin de facilitar las pruebas, y posteriormente ingresar los datos necesarios en cada servicio, para mayor información
	revisar el archivo AuthController y el archivo Routes

##Observaciones generales
Algunos campos en el diagrama de la base de datos no coincidian con sus relaciones con otras tablas, por lo que fueron cambiadas para poder ejecutar correctamente todas las funciones, sería mejor mantener la integridad de los datos impidiendo la entrada de información
de manera mas segura, en mi caso me gustaría validar los datos de mejor manera
