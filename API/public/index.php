<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

$configuration = [
    'settings' => [
        'displayErrorDetails' => true,
    ],
];
$c = new \Slim\Container($configuration);

$app = new \Slim\App($c);

require_once('../src/fetchAllFlow.php');
require_once('../src/login.php');
require_once('../src/readMsg.php');
require_once('../src/deleteMsg.php');
require_once('../src/fetchMsgs.php');
require_once('../src/getUserData.php');
require_once('../src/getAssociatedfarms.php');
require_once('../src/getMoistureData.php');
require_once('../src/getTemperatureData.php');

$app->run();

?>