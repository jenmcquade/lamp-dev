# lamp-dev
Docker Compose setup for initiating a LAMP environment with XDEBUG enabled

### To create a LAMP environment with XDebug enabled, follow these steps
1. Clone this project into your working directory
`git clone https://github.com/jenmcquade/lamp-dev.git`
2. Modify line 37 of docker-compose to your host IP address
`PHP_XDEBUG_REMOTE_HOST: "XXX.XXX.XXX.XXX"`
3. _[Optional]_ If you have Visual Studio Code installed, Modify line 14 of .vscode/launch.json to the full directory path of the project's _src_ folder
`"localSourceRoot": "localSourceRoot": "{YOUR PROJECT FOLDER ROOT}\\src"
4. Copy your PHP project files into the _src_ folder
5. Begin your debugger and visit http://localhost:8888

### Services
1. MariaDB (latest, from base image)
2. PHP 7.1.6 (based on docker pull wodby/drupal-php)
3. Apache 2.4.25 (based on wodby/drupal-apache:2.4-1.0.0)
