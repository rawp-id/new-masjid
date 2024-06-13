<?php
require ("../vendor/autoload.php");

$openapi = \OpenApi\Generator::scan([
    __DIR__ . '/../app/Controllers',
    __DIR__ . '/../src/Core/Controller.php'
]);

header('Content-Type: application/json');
echo $openapi->toJson();

