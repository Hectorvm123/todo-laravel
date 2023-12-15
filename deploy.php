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
    ->set('identityFile', '..\\..\\DDAW-KEY-PAIRUD2-hector-valls-mira.pem')
    ->set('deploy_path', '/var/www/prod-ud4-a4/html/todo-laravel');

// Hooks

after('deploy:failed', 'deploy:unlock');


task('upload:env', function () {
    upload('.env.production', '{{deploy_path}}/shared/.env');
   })->desc('Environment setup');
   