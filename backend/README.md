# 1.- Levantar Proyecto con BD Mariadb 

`cd <nombre del proyecto>`

# El paso 2 depende que SO esten ocupando
# 2a.- Si estan en Linux 
```bash
cat  > .env <<EOF
APP_NAME=Laravel
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack
LOG_DEPRECATIONS_CHANNEL=null
LOG_LEVEL=debug

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=laravel
DB_USERNAME=root
DB_PASSWORD=

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DRIVER=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

MEMCACHED_HOST=127.0.0.1

REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379

MAIL_MAILER=smtp
MAIL_HOST=mailhog
MAIL_PORT=1025
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

AWS_ACCESS_KEY_ID=
AWS_SECRET_ACCESS_KEY=
AWS_DEFAULT_REGION=us-east-1
AWS_BUCKET=
AWS_USE_PATH_STYLE_ENDPOINT=false

PUSHER_APP_ID=
PUSHER_APP_KEY=
PUSHER_APP_SECRET=
PUSHER_APP_CLUSTER=mt1

MIX_PUSHER_APP_KEY="${PUSHER_APP_KEY}"
MIX_PUSHER_APP_CLUSTER="${PUSHER_APP_CLUSTER}"
EOF
```

# 2b.- Si están en Windows deben copiar el contenido anterior en el archivo .env (que debe ser creado dentro de la carpeta backend)

* `docker-compose up`

* `docker exec -ti <nombre del contenedor de la DB> bash`

* `mysql -u root -p`
* `ENTER`
* `CREATE DATABASE db_lem_system;`
* `CREATE USER 'sail' IDENTIFIED BY 'password';`
* `GRANT USAGE ON *.* TO 'sail'@'%' IDENTIFIED BY 'password';`
* `GRANT ALL PRIVILEGES ON db_lem_system.* TO 'sail'@'%';`
* `FLUSH PRIVILEGES;`
* `CTRL+D`
* `exit`

# Tener en cuenta en este paso que el archivo dump_lem_system.sql se encuentra en la carpta sql de este proyecto en la carpeta backend, en windows usar cmd en vez de powershell para este comando.

* `docker exec -i <nombre del contenedor de la base de datos> mysql -u sail -ppassword --database=db_lem_system < <ruta al archivo dump_lem_system.sql>`

# Configurar servidor laravel

`docker exec -ti <nombre del contenedor de laravel> bash`

`composer install`

`php artisan key:generate`

`exit`

# Setear la ip del contenedor de la DB en la variable de entorno en el archivo .env, buscamos la ip con el siguiente comando:

`docker inspect <nombre del contenedor de la DB>`

# Buscar el valor de la clave "IPAddress" y copiar la ip en la variable DB_HOST en el archivo .env junto con las variables nuevas de la base de datos (DB_DATABASE, DB_USERNAME, DB_PASSWORD)

* `docker-compose restart`

# Probar con Postman u alguna herramienta similar la siguiente ruta usando el verbo http get

* `http://localhost:80/instalation/all` 