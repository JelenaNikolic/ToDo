<?php

$text = $_POST['text'];

$response['id'] = 7;
$response['error'] = false;
$response['message'] = 'New To Do Added';

echo json_encode($response);

?>