<?php

include("mysqli_konekcija.php");

$text = $_POST['text'];

$sql = $dbc->prepare("INSERT INTO todos (text) VALUES (?)");

$sql->bind_param('s',$text);

$sql->execute();

$sql->close();

$sql1 = "SELECT * FROM todos WHERE text = '$text'";

$dbc->query($sql1);
		
if(!$results = $dbc->query($sql)){
	die('Došlo je do greške na upitu. ' . $dbc->connect_error);
}

while($row = $results->fetch_assoc()){
	$response['id'] = $row['id'];
}

if($response['id']){
	$response['error'] = false;
	$response['message'] = 'New To Do Added';
}
echo json_encode($response);
?>