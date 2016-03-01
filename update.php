<?php

$id = $_GET['id'];
$text = $_GET['text'];

$response['error'] = false;
$response['message'] = 'Updated on ' . $_GET['id'];

echo json_encode($response);

?>