# lamp-dev
Docker Compose setup for initiating a LAMP environment with XDEBUG enabled

### To create a LAMP environment with XDebug enabled, follow these steps
1. Clone this project into your working directory
`git clone https://github.com/jenmcquade/lamp-dev.git`
1. Modify line 37 of docker-compose to your host IP address
`PHP_XDEBUG_REMOTE_HOST: "XXX.XXX.XXX.XXX"`
1. _[Optional]_ If you have Visual Studio Code installed, Modify line 14 of .vscode/launch.json to the full directory path of the project's _src_ folder
`"localSourceRoot": "localSourceRoot": "{YOUR PROJECT FOLDER ROOT}\\src"`
1. Copy your PHP project files into the _src_ folder
1. In a terminal, pointed at the root lamp-dev project folder, run `docker-compose up -d`. This will run the containers in the background. You can use a UI like Kitematic to view the container logs. 
1. Begin your debugger and visit http://localhost:8888/{Your_folder_under_./src}

### Services
1. MariaDB (latest, from base image)
1. PHP 7.1.6 (based on docker pull wodby/drupal-php).  Php.ini config nder /usr/local/etc/php
1. Apache 2.4.25 (based on wodby/drupal-apache:2.4-1.0.0).  Httpd config uder /usr/local/apache2

### Requirements
1. Docker: https://docs.docker.com/engine/installation/
2. Visual Studio Code (for debugging): https://code.visualstudio.com/docs/setup/setup-overview

