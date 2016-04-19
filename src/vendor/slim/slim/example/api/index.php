<?php

/**
 * Step 1: Require the Slim Framework using Composer's autoloader
 *
 * If you are not using Composer, you need to load Slim Framework with your own
 * PSR-4 autoloader.
 */
require '../../../../autoload.php';
include_once('db.php');

// upload file path header('Content-type:application/json');

$targetDir = "../uploads/";
$folder="../uploads/";
//
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * Step 2: Instantiate a Slim application
 *
 *. This example instantiates a Slim application using
 * its default settings. However, you will usually configure
 * your Slim application now by passing an associative array
 * of setting names and values into the application constructor.
 */
$app = new Slim\App();
/*
 $app->view(new \JsonApiView());
 $app->add(new \JsonApiMiddleware());

**/
/**
 * Step 3: Define the Slim application routes
 *
 * Here we define several Slim application routes that respond
 * to appropriate HTTP request methods. In this example, the second
 * argument for `Slim::get`, `Slim::post`, `Slim::put`, `Slim::patch`, and `Slim::delete`
 * is an anonymous function.
 */
$app->get('/', function ($request, $response, $args) {
    
	$data = array('Author' => 'Raghav', 'age' => 20,'EnrollmentNumber'=>'U13Co051');
	//$body=$response->getBody();
	$response = $response->withJson($data, 201);
    //$response->getBody()->write("\n Welcome to Document Search Engine \n");

    return $response;
});
/*  Dummy Method
<!---
$app->get('/hello[/{name}]', function ($request, $response, $args) {
    $response->write("Hello, " . $args['name']);
    $name = htmlspecialchars($args['name']);
    $response->write("<br>html special character Hello World$ "+ $name);
    echo $name;
    return $response;
})->setArgument('name', 'World!');
*/
// search for a document name should be in a url using get method so data will be pass through url
//response will be in Json
$app->get('/search[/{name}]', function ($request, $response, $args) {
    //$response->getBody()->write("Hello Inside the search page");
    //echo "Hello Inside the search page";
    $query= $args['name'];
   // $queryparameter=$args['type'];
	$users;
	
	
	try {
		$db = getDB();
		
		$query = "%".$query."%";
		//$queryparameter ="%".$queryparameter."%";

		//if($args['type'] == "all")
		//{
		$sql = "SELECT name FROM document WHERE tag LIKE :query";
		$stmt = $db->prepare($sql);
		$stmt->bindParam("query", $query);	
		/*
		}
		else
		{
			$sql = "SELECT name FROM document WHERE tag LIKE :query and type LIKE :queryparameter";
				$stmt = $db->prepare($sql);
			$stmt->bindParam("query", $query);
			$stmt->bindParam("type", $queryparameter);		
		}
		*/
		$stmt->execute();
		$users = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		//$data = '{"Document": ' . json_encode($users) . '}';
		echo json_encode(array("Document"=>$users));
	} catch(PDOException $e) {
		$data = '{"Document":["text":'. $e->getMessage() .']}';
		//echo '{"error":["text":'. $e->getMessage() .']}';
	}
	
	
	//$response = $response->withStatus($data, 201);
	
    //return $response;
});

// Insert the file into database
// requrment for this is the pic id of the file and authorid and tag string
// it will give the slim error is the samename file already exists
$app->post('/insert', function ($request, $response, $args) {  
    
    echo $_POST['tag'];
    global $folder;
    $file =$_FILES['pic']['name'];
    $file_loc = $_FILES['pic']['tmp_name'];
	$file_size = $_FILES['pic']['size'];
	$file_type = $_FILES['pic']['type'];
	//$Value = $_POST["Value"];
	
	//$decode = json_decode($Value,true);
	//$tag = $decode['tag'];
	//$authorid=$decode['authorid'];
	$authorid=$_POST['authorid'];
	//echo $authorid;
    $tag = $_POST['tag'];
    //echo $tag;
    //echo $file;
    
    $mime="";
    //$authorid=$_POST['authorid'];
    if(!file_exists($folder.$file)){
    	move_uploaded_file($file_loc,$folder.$file);
    	$pathParts = pathinfo($folder.$file);
		$extension = strtolower($pathParts["extension"]);
		$mime = getExtension($extension);

    }
    else{
    	 $data = array('status' => 'Fail', 'Reason' => 'File(same) already Exist','solution'=>'try with different name of file');
		$response = $response->withJson($data, 200);
		
		echo json_encode($data);
		return $response;
    }
 	
 $sql="INSERT INTO document(name,tag,authorid,type) VALUES(:name,:tag,:authorid,:type)"; 
 try {
 		//'$file','$tag','$authorid'
		$db = getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindParam('name',$file, PDO::PARAM_STR,40);
		$stmt->bindParam('tag',$tag, PDO::PARAM_STR,30);
		$stmt->bindParam('authorid',$authorid, PDO::PARAM_STR,30);
		$stmt->bindParam('type',$mime, PDO::PARAM_STR,30);
		$stmt->execute();
		$db = null;
//		echo 'Inserted The file';
	} catch(PDOException $e) {
//		echo 'Error in File insertion Process';
		echo $e;

		$data = array('status' => 'Fail', 'Reason' => 'At Querry Processing','solution'=>'Try after some time','error'=>$e);
		$response = $response->withJson($data, 299);
		echo json_encode($data);
		return $response;
	}
	

	//echo 'Inside the Insert Function';
	$data = array('status' => 'success','Type'=>$mime,'File'=>'Inserted successfully');
		//$response = $response->withJson($data, 201);
	echo json_encode($data);
   // return $response;

   


});


// this method using file will be reupload at server tag will be change name may be change
// Update the tag only tag will be replace with file and tag
$app->post('/update', function ($request, $response, $args) {
    $response->getBody()->write("Hello Inside the update page ");
    global $folder;
    $name = $_FILES['pic']['name'];
    $file_loc = $_FILES['pic']['tmp_name'];
	$file_size = $_FILES['pic']['size'];
	$file_type = $_FILES['pic']['type'];
    $tag = $_POST['tag'];
    
    
 if(file_exists($folder.$name)){
    	unlink($folder. $name);
    	move_uploaded_file($file_loc,$folder.$name);
    }
	else{

			$data = array('status' => 'unsuccessful','exists'=>'file not exits on server' );
		$response = $response->withJson($data, 200);
		return $response;
	}
    	$sql = "UPDATE document SET tag=:tag WHERE name=:name";
    	try {
		$db = getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("tag",$tag,PDO::PARAM_STR,30);
		$stmt->bindParam("name",$name,PDO::PARAM_STR,40);
		$stmt->execute();
		$db = null;
		echo "File is replaced";
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
		$data = array('status' => 'unsuccessful', 'work' => 'Not replaced file','error'=>'Querry is not Process successfully');
		$response = $response->withJson($data, 200);
		echo "Try Again Later";
		//echo $e;
		return $response;
	}
	$data = array('status' => 'successful', 'work' => 'replaced file');
		$response = $response->withJson($data, 200);
		return $response;
});


$app->delete('/delete/{name}', function ($request, $response, $args) {
global $folder;
    $response->getBody()->write("Hello Inside the search page Delete the page ". $args['name']);
	$sql = "DELETE FROM document WHERE name=:name";
	try {
		$db = getDB();
		$stmt = $db->prepare($sql);
		$stmt->bindParam("name", $args['name']);
		$stmt->execute();
		$db = null;
		echo true;
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
		$data = array('status' => 'unsuccessful', 'work' => 'Not delete file','error'=>'Querry is not Process successfully');
		$response = $response->withJson($data, 200);
	}
	if(unlink($folder. $args['name'])){
		echo "Deleted successfully<br >";
		$data = array('status' => 'successful', 'work' => 'delete file');
		$response = $response->withJson($data, 200);
	}else{
		$data = array('status' => 'unsuccessful', 'work' => 'Not delete file');
		$response = $response->withJson($data, 200);
	}
	
		return $response;
});


//// download document
$app->get('/download[/{name}]', function ($request, $response, $args) {


		$sql = "UPDATE document SET Download=:Download WHERE name=:name";	
    	try {
    		 $db = getDB();
    		 $readStats= $db->prepare("SELECT Download FROM document where name=:name"); 
			 $readStats->bindParam("name",$args['name'],PDO::PARAM_STR,40);
             $readStats->execute();  
             $down = $readStats->fetchAll(PDO::FETCH_OBJ);
		$download = $down['Download']+1;
		$stmt = $db->prepare($sql);
		$stmt->bindParam("Download",$download,PDO::PARAM_STR,30);
		$stmt->bindParam("name",$args['name'],PDO::PARAM_STR,40);
		$stmt->execute();
		$db = null;
		echo "Download Value Updated";
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
		$data = array('status' => 'unsuccessful', 'work' => 'Not replaced file','error'=>'Querry is not Process successfully');
		$response = $response->withJson($data, 200);
		echo " NOT    --Download Value Updated";
		//echo $e;
		return $response;
	}

    global $folder;
    $path = $args['name'];
    $targetFilePath = $folder.$path;
	$a = "attachment; ";
	if(file_exists($targetFilePath)){
		$pathParts = pathinfo($targetFilePath);
		$extension = strtolower($pathParts["extension"]);
		$mime = getExtension($extension);
		$response = $response->withHeader('Content-Type:',$mime);
		$response = $response->withHeader('Content-Disposition', $a.'filename="'.basename($targetFilePath).'"');
		$response = $response->withHeader('Content-Description:', 'File Transfer');
		$response = $response->withHeader('Expires','0');
		$response = $response->withHeader('Cache-Control',' must-revalidate');
		//$response = $response->withHeader('Pragma','public');
		$response = $response->withHeader('Content-Length',filesize($targetFilePath));
		$response = $response->withStatus(200);
		readfile($targetFilePath);
	}else{
		$response = $response->withJson(array("status" => "error", "message" => "Content not found"), 404);
	}


	
    return $response;
});



function getExtension($extension){
	switch($extension) {
		case "pdf":
			$mime = "application/pdf";
			break;
		case "docx":
			$mime = "application/vnd.openxmlformats-officedocument.word";
			break;
		case "doc":
		case "word":
			$mime = "application/msword";
			break;
		case "f":
		case "text":
		case "cxx":
		case "c":
		case "java":
			$mime = "text/plain";
			break;
		case "gif":
			$mime = "image/gif";
			break;
		case "jpe":
		case "jpeg":
		case "jpg":
			$mime = "image/jpeg";
			break;
		case "js":
			$mime = "text/javascript";
			break;
		case "png":
			$mime = "image/png";
			break;
		case "pot":
		case "ppa":
		case "ppt":
			$mime = "application/vnd.ms-powerpoint";
			break;
		case "xla":
		case "xls":
			$mime = "application/x-msexcel";
			break;
		case "zip":
			$mime - "application/x-zip-compressed";
		default:
			$mime = "application/octet-stream";
	}
	return $mime;
}


/**
 * Step 4: Run the Slim application
 *
 * This method should be called last. This executes the Slim application
 * and returns the HTTP response to the HTTP client.
 */
$app->run();
