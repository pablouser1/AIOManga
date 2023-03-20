<?php
require __DIR__ . '/../vendor/autoload.php';

// -- ENV -- //
$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/..');
$dotenv->safeLoad();

// -- Viewi -- //
require __DIR__ . '/../src/ViewiApp/viewi.php';
Viewi\App::handle();
