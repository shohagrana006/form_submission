<?php

// trobule shooting if error occur
error_reporting(E_ALL);
ini_set('display_errors', 1);


require __DIR__ . '/vendor/autoload.php';

define('ROOT_PATH', realpath(dirname(__FILE__)));

require __DIR__ . '/routes/web.php';






