# No longer in development: React Apache MySql PHP Development Environment
Docker Compose setup for initiating a LAMP environment with XDEBUG enabled, and built to accomodate React with Redux, with Hot Module Reloading (HMR) using Browsersync as a proxy, implementing the Webpack Hot Middleware module.  Sample Zend MVC app is pre-configured for Propel ORM and building with Docker.

### To create a fresh LAMP environment with XDebug enabled (without React), follow these steps
1. Clone this project into your working directory
`git clone https://github.com/jenmcquade/ramp-dev.git`
1. Modify line 37 of docker-compose.yml to your host IP address
`PHP_XDEBUG_REMOTE_HOST: "XXX.XXX.XXX.XXX"`
1. _[Optional]_ If you have Visual Studio Code installed, Modify line 14 of .vscode/launch.json to the full directory path of the project's _src_ folder
`"localSourceRoot": "localSourceRoot": "{YOUR PROJECT FOLDER ROOT}\\src"`
1. Copy your PHP project files into the _src_ folder
1. In a terminal, pointed at the root lamp-dev project folder, run `docker-compose up -d`. This will run the containers in the background. You can use a UI like Kitematic (https://kitematic.com/) to view the container logs. 
1. Begin your debugger and visit http://localhost:8081/{Your_folder_under_src}
1. The sample Notes Zend MVC app, configured with Propel ORM, can be visited via http://localhost:8080

### Sample Note Taking App, implementing React, Apache, MySQL and Zend MVC (PHP)
The sample app is available in the *src/zend_app* directory.  It demonstrates a full-stack development environment, including BrowserSync for proxying and cross-browser testing.  To build and run this app, follow these steps:
1. Download and install NodeJS with NPM: https://nodejs.org/en/download/
1. Ensure your Docker containers have been created by running `docker-compose up -d` in the *ramp-dev* directory.
1. run `docker ps` to see a list of open Docker containers.  Find the container ID of your open PHP container with the image *bistormllc/php*.  Copy the container ID.  
1. run `docker exec -ti bash {CONTAINER ID}` to launch an interactive session in the PHP Docker container.
1. run `cd /var/www/html/zend_app` to get to the project folder.
1. run `composer install`
1. run `propel mysql:build` to create a MySQL dump from *schema.xml*.
1. run `propel mysql:insert` to create the MySQL tables
1. run `exit` to quit the Docker interactive terminal session.
1. **IN YOUR HOST MACHINE** Change directories to *src/zend_app*, not in a Docker container: `cd src/zend_app`
1. Run `npm install`. Downloading of NodeJS modules will take a while.
1. Run `npm start`.  This will initiate a BrowserSync session on your host port 3000 and trigger your browser to open.  BrowserSync will compile the Webpack *src/zend_app/webpack.config.js* file and use Webpack Middleware to serve the bundled scripts in your host machine's memory, proxying the rest of your content from your host's mapped port of 8080.  So, if you wish to see just LAMP-based processing, you can visit *http://localhost:8080*, and to see the app with Hot Module Reloading for React components, access *http://localhost:3000*.
1. React files are located under *src/zend_app/module/Application/view/application/index/react-app*.  If you make a change to these components, you should see these changes after saving, without needing to refresh the page. 

### Exposed ports
1. MariaDB (MySQL) exposes port *3366* on your host machine and maps internally to port *3306*.
1. Apache exposes port *8080* and *8081* on your host machine and maps internally to port *80* and *81* respectably.
1. Adminer exposes port *8888* on your host machine and maps internally to port *8080*.
1. **3000-3003**: Running `npm install && npm start` in the zend_app directory, from your host machine, will run BrowserSync and opens a proxy server on your host's 3000 machine. **NOTE** This is not currently a supported command from within the Docker containers. You must install NodeJS with NPM, then run `npm install && npm start` inside the *src/zend_app* directory.  

### Services
1. MariaDB (latest, from base image). See _docker-compose.yml_ for login credentials. *This maps your host's port 3366 to the internal port 3306*.  You can then access the database outside of the Docker virtual network, for example, in MySQL workbench.
1. PHP 7.1.6 (based on docker wodby/drupal-php).  Php.ini config under */usr/local/etc/php*  **NOTE** Changes to this file will be erased if a new container is made.  **Commands** This image has `'composer` and `propel ` installed globally.
1. Apache 2.4.25 (based on docker wodby/drupal-apache:2.4-1.0.0).  Httpd config uder /usr/local/apache2.  *This maps your host's port 8080 to the internal port 80 and host port 8081 to internal port 81.  **NOTE** Changes to this file will be erased if a new container is made.  
1. Adminer (latest, from base image). *This maps your host's port 8888 to the internal port 80*.

#### Composer
Composer is installed globally as an executable inside of the PHP Docker image.  Here is how to run Composer:
1. run `docker ps` to see a list of open Docker containers.  Find the container ID of your open PHP container with the image *bistormllc/php*.  Copy the container ID.  
1. run `docker exec -ti bash {CONTAINER ID}` to launch an interactive session in the PHP Docker container.
1. `cd /var/www/html` to get to the root project folder.
1. run`composer install` to install the Zend Framework and Propel ORM.

#### Propel
Propel is installed globally as an executable inside of the PHP Docker image.  Here is how to run Propel:
Composer is installed globally as an executable inside of the PHP Docker image.  Here is how to run Composer:
1. run `docker ps` to see a list of open Docker containers.  Find the container ID of your open PHP container with the image *bistormllc/php*.  Copy the container ID.  
1. run `docker exec -ti bash {CONTAINER ID}` to launch an interactive session in the PHP Docker container.
1. `cd /var/www/html` to get to the root project folder.


#### Adminer
Adminer is available as an interface for working with MariaDB.  It is available after creating the Docker services by visiting http://localhost:8888

#### Zend MVC Skeleton App comes preinstalled
To get you up and running with MVC, a composer.json configuration file is included in the *src* folder.  The Zend Framework and Propel should be installed using Composer in order to write full-fledged MVC applications. 
##### Installing the full Zend Framework and Propel
1. run `docker ps` to see a list of open Docker containers.  Find the container ID of your open PHP container with the image *bistormllc/php*.  Copy the container ID.  
1. run `docker exec -ti bash {CONTAINER ID}` to launch an interactive session in the PHP Docker container.
1. `cd /var/www/html` to get to project sources folder, containing composer.json.
1. run `ccomposer install`

#### Propel ORM for model development comes preconfigured
You can use Propel both within the _src_ project directory and inside of the Zend MVC Skeleton App.  It is available globally after running `composer install` in the _src_ project directory or locally after running `composer install` inside the _src/zend_app_ directory.
1. Copy the *src/composer.json* file into your project directory.
1. run `docker ps` to see a list of open Docker containers.  Find the container ID of your open PHP container with the image *bistormllc/php*.  Copy the container ID.  
1. run `docker exec -ti bash {CONTAINER ID}` to launch an interactive session in the PHP Docker container.
1. `cd /var/www/html/{your_project}`
1. run `composer install` to install project dependencies.
1. run `propel init` to initialize schema and inheritance classes to manage CRUD operations.
1. Each time you will update your schema, you should run `propel sql:build` and `propel sql:insert`.  Use `propel model:build` to generate Model classes based on your *schema.xml* file.

### Requirements
1. Docker: https://docs.docker.com/engine/installation/
1. Visual Studio Code (for debugging): https://code.visualstudio.com/docs/setup/setup-overview
1. NodeJS with NPM (for running the sample Note Taking app with Hot Module Reloading): https://nodejs.org/en/download/
