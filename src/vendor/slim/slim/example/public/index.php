<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';
/*
$app = new \Slim\App;
$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});
*/

$app = new \Slim\App;
$app->get('/foo', function () {
   // $app->render('foo.php');	// <-- ERROR
   echo "dfs fdsfdsf dsfasdf df";
});

$app->get('/uploads/{id}', function (Request $request, Response $response) {
   // $app->render('foo.php');	// <-- ERROR
  
});
$app->run();