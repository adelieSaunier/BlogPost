<?php
session_start();
require_once "../vendor/autoload.php";

//error_reporting(E_ALL);
//ini_set('display_errors', '1');

Router::run();