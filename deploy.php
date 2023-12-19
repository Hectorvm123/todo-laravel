<?php
namespace Deployer;

require 'recipe/laravel.php';

// Config

set('repository', 'https://github.com/Hectorvm123/todo-laravel.git');

add('shared_files', ['.env']);
add('shared_dirs', ['storage', 'public/uploads']);
add('writable_dirs', ['bootstrap/cache', 'storage']);

// Hosts

host('54.211.160.170')->user('prod-ud4-deployer')
    ->identityFile('~/.ssh/id_rsa')
    ->set('ssh_multiplexing', false)
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


task('composer:install', function () {
    run('composer --working-dir=/var/www/prod-ud4-a4/html/todo-laravel/current install');
});
# inclusió en el cicle de desplegament
