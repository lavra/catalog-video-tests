# Catalog Video - PHP

### Configurações autoload PSR 4

- Acessar a app
````
$ docker-compose exec app bash
````
- Para permitir Usuário 1000
````
# chown -R 1000:1000 .
````
- Iniciar composer
````
# composer init

Package name (<vendor>/<name>) [root/www]: avdesign/app-php-catalog-video
Description []: App Catalogo de Video
Author [n to skip]: Anselmo Velame <design@anselmovelame.com.br>
Minimum Stability []: 
Package Type (e.g. library, project, metapackage, composer-plugin) []: 
License []: 

Define your dependencies.

Would you like to define your dependencies (require) interactively [yes]? no
Would you like to define your dev dependencies (require-dev) interactively [yes]? no
Add PSR-4 autoload mapping? Maps namespace "Avdesign\AppPhpCatalogVideo" to the entered relative path. [src/, n to skip]: no

{
    "name": "avdesign/app-php-catalog-video",
    "description": "App Catalogo de Video",
    "authors": [
        {
            "name": "Anselmo Velame",
            "email": "design@anselmovelame.com.br"
        }
    ],
    "require": {}
}

Do you confirm generation [yes]? y
````
- Criar estrutura de Pasta Local
````
src 
    -> Core

    composer.json

    "autoload": {
    "psr-4": {
        "Core\\": "src/Core"
    }

````
- Dentro do cantainer gerar autoload
````
# composer dump-autoload
````
- Criar a primeira class no Core
````
<?php

namespace Core;

class Teste {

    public function foo()
    {
        return '123';
    }
}



````
### Instalar e configurar o PHPUnit

Doc: https://phpunit.readthedocs.io/en/9.5/installation.html
````
# composer require --dev phpunit/phpunit ^9.5
````

### Instalar e configurar o Mockery

Doc: http://docs.mockery.io/en/latest/getting_started/installation.html
````
# php composer.phar require --dev mockery/mockery
````

````
````

````
````

````
````

````
````

````
````

````
````

````
````
acabou aqui