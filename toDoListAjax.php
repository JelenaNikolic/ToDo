<?php
include('mysqli_konekcija.php');

$sql = "SELECT * FROM todos";

$dbc->query($sql);
		
if(!$results = $dbc->query($sql)){
	die('Došlo je do greške na upitu. ' . $dbc->connect_error);
}

$toDoArr = array();

while($row = $results->fetch_assoc()){
  $toDoArr[] = $row;
}

$data = json_encode($toDoArr);

//$data = file_get_contents("data.json");

echo $data;

?>