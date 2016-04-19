<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../../src/vendor/autoload.php';
include_once 'db.php';
require '../../src/vendor/slim/slim/Slim.php';

$app = new \Slim\App();

$app->get('/search','getDocument');
$app->get('/updates','getUserUpdates');
$app->post('/updates', 'insertUpdate');
$app->delete('/users/delete/:update_id','deleteusers');
$app->get('/users/search/:query','getUserSearch');

$app->run();



function getDocumentSearch($query) {
	$sql = "SELECT name FROM document WHERE name LIKE :query ORDER BY name";
	try {
		$db = getDB();
		$stmt = $db->prepare($sql);
		$query = "%".$query."%";
		$stmt->bindParam("query", $query);
		$stmt->execute();
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"users": ' . json_encode($users) . '}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

$app->get('/hello/{name}', function (Request $request, Response $response) {
    $name = $request->getAttribute('name');
    $response->getBody()->write("Hello, $name");

    return $response;
});

function insertDocument(){

}
?>
