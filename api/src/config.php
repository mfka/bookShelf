<?php
function autoLoader($className)
{
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
                include_once $path;
                return;
            }
        }
    }

}

spl_autoload_register('autoLoader');