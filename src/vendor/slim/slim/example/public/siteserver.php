<?php
require 'vendor/autoload.php';
include_once 'db.php';
require '../vendor/slim/slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/search','getDocument');
$app->get('/updates','getUserUpdates');
$app->post('/updates', 'insertUpdate');
$app->delete('/users/delete/:update_id','deleteusers');
$app->get('/users/search/:query','getUserSearch');

$app->run();

function getDocument($query) {
	$sql = "SELECT name FROM document WHERE name LIKE :query ORDER BY name";
	try {
		$db = getDB();
		$stmt = $db->query($sql);
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		//echo '{"users": ' . json_encode($users) . '}';
		echo json_encode($users);
	} catch(PDOException $e) {
	    //error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getUserUpdates() {
	$sql = "SELECT A.user_id, A.username, A.name, A.profile_pic, B.update_id, B.user_update, B.created FROM users A, updates B WHERE A.user_id=B.user_id_fk  ORDER BY B.update_id DESC";
	try {
		$db = getDB();
		$stmt = $db->query($sql);
		$updates = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		//echo '{"updates": ' . json_encode($updates) . '}';
		echo json_encode($updates);
	} catch(PDOException $e) {
	    //error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getUserUpdate($update_id) {
	$sql = "SELECT A.user_id, A.username, A.name, A.profile_pic, B.update_id, B.user_update, B.created FROM users A, updates B WHERE A.user_id=B.user_id_fk AND B.update_id=:update_id";
	try {
		$db = getDB();
		$stmt = $db->prepare($sql);
        $stmt->bindParam("update_id", $update_id);
		$stmt->execute();
		$updates = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo '{"updates": ' . json_encode($updates) . '}';

	} catch(PDOException $e) {
	    //error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function insertUpdate() {
	$request = \Slim\Slim::getInstance()->request();
	$update = json_decode($request->getBody());
	$sql = "INSERT INTO updates (user_update, user_id_fk, created, ip) VALUES (:user_update, :user_id, :created, :ip)";
	try {
		$db = getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("user_update", $update->user_update);
		$stmt->bindParam("user_id", $update->user_id);
		$time=time();
		$stmt->bindParam("created", $time);
		$ip=$_SERVER['REMOTE_ADDR'];
		$stmt->bindParam("ip", $ip);
		$stmt->execute();
		$update->id = $db->lastInsertId();
		$db = null;
		$update_id= $update->id;
		getUserUpdate($update_id);
	} catch(PDOException $e) {
		//error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function deleteusers($update_id) {

	$sql = "DELETE FROM users WHERE update_id=:update_id";
	try {
		$db = getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("update_id", $update_id);
		$stmt->execute();
		$db = null;
		echo true;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}

}

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
?>
