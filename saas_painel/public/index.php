<?php
session_start();
require __DIR__ . '/../app/helpers.php';

$controller = $_GET['c'] ?? 'auth';
$action = $_GET['a'] ?? 'showLogin';
$controllerClass = ucfirst($controller) . 'Controller';
require_once __DIR__ . "/../app/Controllers/{$controllerClass}.php";

$ctl = new $controllerClass();
$ctl->$action();
