# lamp-dev
Docker Compose setup for initiating a LAMP environment with XDEBUG enabled.  Comes pre-configured for Zend and Propel for MVC development.

## Exposed ports
1. MariaDB (MySQL) exposes port *3366* on your host machine and maps internally to port *3306*.
1. Apache exposes port *8888* on your host machine and maps internally to port *80*.
1. Adminer exposes port *8889* on your host machine and maps internally to port *8080*.

### To create a LAMP environment with XDebug enabled, follow these steps
1. Clone this project into your working directory
`git clone https://github.com/jenmcquade/lamp-dev.git`
1. Modify line 37 of docker-compose.yml to your host IP address
`PHP_XDEBUG_REMOTE_HOST: "XXX.XXX.XXX.XXX"`
1. _[Optional]_ If you have Visual Studio Code installed, Modify line 14 of .vscode/launch.json to the full directory path of the project's _src_ folder
`"localSourceRoot": "localSourceRoot": "{YOUR PROJECT FOLDER ROOT}\\src"`
1. Copy your PHP project files into the _src_ folder
1. In a terminal, pointed at the root lamp-dev project folder, run `docker-compose up -d`. This will run the containers in the background. You can use a UI like Kitematic (https://kitematic.com/) to view the container logs. 
1. Begin your debugger and visit http://localhost:8888/{Your_folder_under_./src}

### Services
1. MariaDB (latest, from base image). See _docker-compose.yml_ for login credentials. *This maps your host's port 3366 to the internal port 3306*.
1. PHP 7.1.6 (based on docker wodby/drupal-php).  Php.ini config under */usr/local/etc/php*
1. Apache 2.4.25 (based on docker wodby/drupal-apache:2.4-1.0.0).  Httpd config uder /usr/local/apache2.  *This maps your host's port 8888 to the internal port 80*.
1. Adminer (latest, from base image). *This maps your host's port 8888 to the internal port 80*.

#### Composer
Composer is installed globally as an executable inside of the PHP docker image.  Here is how to run Composer:
1. run `docker ps` to see a list of open Docker containers.  Find the container ID of your open PHP container with the image *bistormllc/php*.  Copy the container ID.  
1. run `docker exec -ti bash {CONTAINER ID}` to launch an interactive session in the PHP Docker container.
1. `cd /var/www/html` to get to the root project folder.
1. run`composer install` to install the Zend Framework and Propel ORM.

#### Zend MVC Skeleton App comes preinstalled
To get you up and running with MVC, a composer.json configuration file is included in the *src* folder.  The Zend Framework and Propel should be installed using Composer in order to write full-fledged MVC applications. 
##### Installing the full Zend Framework and Propel
1. run `docker ps` to see a list of open Docker containers.  Find the container ID of your open PHP container with the image *bistormllc/php*.  Copy the container ID.  
1. run `docker exec -ti bash {CONTAINER ID}` to launch an interactive session in the PHP Docker container.
1. `cd /var/www/html` to get to project sources folder, containing composer.json.
1. run `ccomposer install`
##### Running the Zend Framekwork Skeleton App
1. `cd /var/www/html/zend_app` to enter the Zend Skelton app directory.
1. run `composer install` to install vendor dependencies.
1. Open http://localhost:8888/zend_app/public

#### Propel ORM for model development comes preconfigured
You can use Propel both within the _src_ project directory and inside of the Zend MVC Skeleton App.  It is available globally after running `composer install` in the _src_ project directory or locally after running `composer install` inside the _src/zend_app_ directory.
1. `cd /var/www/html/zend_app` to enter the Zend Skeleton app directory.
1. run `composer install` to install project dependencies.
1. run `propel init` to initialize schema and inheritance classes to manage CRUD operations.
1. Each time you will update your schema, you should run `propel sql:build` and `propel sql:insert`.

### Requirements
1. Docker: https://docs.docker.com/engine/installation/
1. Visual Studio Code (for debugging): https://code.visualstudio.com/docs/setup/setup-overview

