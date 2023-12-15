<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/Hectorvm123/todo-laravel.git');

add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

host('34.227.81.64')
    ->set('remote_user', 'prod-ud4-deployer')
    ->set('ssh_multiplexing', false)
    ->set('identityFile', '..\\..\\DDAW-KEY-PAIRUD2-hector-valls-mira.pem')
    ->set('deploy_path', '/var/www/prod-ud4-a4/html/todo-laravel');

// Hooks

after('deploy:failed', 'deploy:unlock');

task('upload:env', function () {
    upload('.env.production', '{{deploy_path}}/shared/.env');
})->desc('Environment setup');
      

# Declaració de la tasca
task('reload:php-fpm', function () {
    run('sudo /etc/init.d/php8.1-fpm restart');
   });
   # inclusió en el cicle de desplegament
   after('deploy', 'reload:php-fpm');