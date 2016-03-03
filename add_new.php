<?php

include("mysqli_konekcija.php");
error_reporting(E_ERROR);
$text = $_POST['text'];

$sql = $dbc->prepare("INSERT INTO todos (text) VALUES (?)");
$sql->bind_param('s',$text);
$sql->execute();


$response['id'] = mysqli_insert_id($dbc);
$response['error'] = false;
$response['message'] = 'New To Do Added';

$sql->close();

echo json_encode($response);
?>