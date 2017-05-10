<?php

namespace Deployer;

require 'recipe/symfony3.php';

// Configuration

set('repository', 'git@github.com:kseta/demo-deploy.git');
set('git_tty', true); // [Optional] Allocate tty for git on first deployment
add('shared_files', []);
add('shared_dirs', []);
add('writable_dirs', []);

// Hosts

//host('project.com')
//    ->stage('production')
//    ->set('deploy_path', '/var/www/project.com');

host('127.0.0.1')
    ->stage('staging')
    ->user('ubuntu')
    ->port('2230')
    ->identityFile('/Users/kseta/.ghq/github.com/kseta/demo-deploy/.vagrant/machines/staging/virtualbox/private_key')
    ->forwardAgent(true)
    ->set('deploy_path', '~/demo.com');


// Tasks

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo systemctl restart php-fpm.service');
});
//after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

//before('deploy:symlink', 'database:migrate');
