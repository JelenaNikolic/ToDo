<?php

include("mysqli_konekcija.php");

$text = $_POST['text'];

$sql = $dbc->prepare("INSERT INTO todos (text) VALUES (?)");
$sql->bind_param('s',$text);
$sql->execute();
$sql->close();

$response['id'] = mysql_insert_id();

if($response['id']){
	$response['error'] = false;
	$response['message'] = 'New To Do Added';
}
echo json_encode($response);
?>