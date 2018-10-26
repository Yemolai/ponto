<?php

date_default_timezone_set('America/Belem');

require 'vendor/autoload.php';
require './api.php';

$debug = true;
$_ENV['SLIM_MODE'] = $debug ? 'development' : 'production';
ini_set('display_errors', $debug ? '5' : '0'); // to show/hide all errors

$apiOptions = array('displayErrorDetails' => true);

$app = setupAPI(new \Slim\App(), $apiOptions)->run();
