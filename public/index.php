<?php 
use Router;
require_once "../vendor/autoload.php";

error_reporting(E_ALL);
ini_set('display_errors', '0');

//$router = new Router();
Router::run();