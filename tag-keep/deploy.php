<?php
namespace Deployer;

require 'recipe/laravel.php';

// Project name
set('application', 'tag-keep');

// Project repository
set('repository', 'git@github.com:mom0tomo/tag-keep.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
add('shared_files', []);
add('shared_dirs', []);

// Writable dirs by web server 
add('writable_dirs', []);


// Hosts

host('project.com')
    ->set('deploy_path', '~/{{application}}');    
    
// Tasks

task('build', function () {
    run('cd {{release_path}} && build');
});

task('test', function () {
	writeln('ʕ ◔ϖ◔ʔ');
});

// [Optional] if deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');

// Migrate database before symlink new release.

before('deploy:symlink', 'artisan:migrate');

