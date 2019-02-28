<?php
$lib_file = array_slice(scandir(ENGINE_DIR), 2);

foreach ($lib_file as $file) {
    if ($file != 'lib_autoload.php') {
        include_once ENGINE_DIR . '/' . $file;
    }
}
