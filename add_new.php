<?php

include("mysqli_konekcija.php");
error_reporting(E_ERROR);
$text = $_POST['text'];

$sql = $dbc->prepare("INSERT INTO todos (text) VALUES (?)");
$sql->bind_param('s',$text);
$sql->execute();
$sql->close();

$response['id'] = mysql_insert_id();
$response['error'] = false;
$response['message'] = 'New To Do Added';

echo json_encode($response);
?>