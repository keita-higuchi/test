<?php

rename("vendor/codeigniter/framework/application", "./application");
copy("vendor/codeigniter/framework/index.php", "./index.php");
copy("vendor/codeigniter/framework/.gitignore", "./.gitignore");

// change index.php
$file = 'index.php';
$contents = file_get_contents($file);
$contents = str_replace(
    '$system_path = \'system\';',
    '$system_path = \'../vendor/codeigniter/framework/system\';',
    $contents
);

file_put_contents($file, $contents);

// Enable Composer Autoloader
$file = 'application/config/config.php';
$contents = file_get_contents($file);
$contents = str_replace(
    '$config[\'composer_autoload\'] = FALSE;',
    '$config[\'composer_autoload\'] = realpath(APPPATH . \'vendor/autoload.php\');',
    $contents
);
file_put_contents($file, $contents);
