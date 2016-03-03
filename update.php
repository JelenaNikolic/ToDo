<?php

include("mysqli_konekcija.php");

$id = $_GET['id'];
$text = $_GET['text'];

$sql = $dbc->prepare("UPDATE todos SET 'text' = ? WHERE 'id' = ?");

$sql->bind_param('si', $text, $id);

$sql->execute();
$sql->close();

$response['error'] = false;
$response['message'] = 'Updated on ' . $_GET['id'];

echo json_encode($response);

?>