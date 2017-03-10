<?php

spl_autoload_register(function($className) {
    $dirs = array(
        '/',
        '/Class/',
    );

    $files = array(
        '%s.php',
    );
    foreach ($dirs as $dir) {

        foreach ($files as $file) {
            $path = __DIR__ . $dir . sprintf($file, $className);
            if (file_exists($path)) {
                return require_once $path;
            }
        }
    }
});
