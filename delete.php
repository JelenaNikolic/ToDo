<?php

$id = $_GET['id'];

$response['error'] = false;
$response['message'] = 'OK';

//$response['error'] = true;
//$response['message'] = 'User not valid';

echo json_encode($response);

?>