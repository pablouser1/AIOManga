<?php
use Viewi\App;

$config = require 'config.php';
include __DIR__ . '/routes/main.php';
App::init($config);
