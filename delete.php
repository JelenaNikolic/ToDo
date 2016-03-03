<?php

include("mysqli_konekcija.php");

$id = $_GET['id'];

$sql = "DELETE FROM todos WHERE id = '$id'";

$dbc->query($sql);

$dbc->close();

$response['error'] = false;
$response['message'] = 'OK';

//$response['error'] = true;
//$response['message'] = 'User not valid';

echo json_encode($response);

?>