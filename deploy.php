<?php

namespace Deployer;

require 'recipe/symfony.php';

// Configuration

set('ssh_type', 'native');
set('ssh_multiplexing', true);

set('repository', 'git@github.com:kseta/demo-deploy.git');

add('shared_files', []);
add('shared_dirs', []);

add('writable_dirs', []);

// Servers

// see output this command: vagrant ssh-config
server('staging', '127.0.0.1', 2230)
    ->user('ubuntu')
    ->identityFile('~/.ssh/id_rsa.pub', '/Users/kseta/.ghq/github.com/kseta/demo-deploy/.vagrant/machines/staging/virtualbox/private_key')
    ->set('deploy_path', '~/demo.com')
    ->pty(true);


// Tasks

desc('Restart PHP-FPM service');
task('php-fpm:restart', function () {
    // The user must have rights for restart service
    // /etc/sudoers: username ALL=NOPASSWD:/bin/systemctl restart php-fpm.service
    run('sudo systemctl restart php-fpm.service');
});
after('deploy:symlink', 'php-fpm:restart');

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'database:migrate');
