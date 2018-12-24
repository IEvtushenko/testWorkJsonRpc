<?php

use PhpJsonRpc\Server;
use App\Controller\LoginController;
use App\Helper\JsonRpc\Mapper;

chdir(dirname(__DIR__));

require 'vendor/autoload.php';
$_ENV;
$map = new Mapper();
$server = new Server();

// Register new mapper
$server->setMapper(new Mapper());

// Register handler and run server
$response = $server->addHandler(new LoginController())->execute();
echo $response;