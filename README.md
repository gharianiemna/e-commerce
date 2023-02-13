Create project :

Run in cmd : composer create-project symfony/website-skeleton:"^4.4"  Act-4.4
Enter project file created and change in composer.json:  "doctrine/orm": "2.11.*",
Run composer update

Create database:
In .env activate the database link : DATABASE_URL="mysql://root:@127.0.0.1:3306/dbaseemna?charset=utf8mb4"
Run the following commands to make the db and the entities: 
symfony console doctrine:database:create
symfony console make:entity name
symfony console make:migration  
symfony console doctrine:migrations:migrate 
php bin/console doctrine:schema:update –force

Installing JWT management bundle:
composer require lexik/jwt-authentication-bundle
Generate a public and private key with a passphrase to report in the .env : JWT_PASSPHRASE=proj)
Run the following commands
mkdir -p config/jwt
openssl genrsa -out config/jwt/private.pem -aes256 4096 
openssl rsa -pubout -in config/jwt/private.pem -out config/jwt/public.pem
