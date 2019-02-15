<?php
define('TEMPLATES_DIR', '../templates/');
define("ENGINE_DIR", '../engine/');
define('LAYOUTS_DIR', '/layouts/');
define('GALLERY_DIR', './gallery-img/');

/* DB config */
define('HOST', 'localhost');
define('USER', 'user');
define('PASS', '123456');
define('DB', 'phpbase');

include_once ENGINE_DIR . 'functions.php';
include_once ENGINE_DIR . 'classSimpleImage.php';
include_once ENGINE_DIR . 'db.php';
include_once ENGINE_DIR . 'renderPages.php';
