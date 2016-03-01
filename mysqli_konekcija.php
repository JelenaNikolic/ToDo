<?php

DEFINE ('DB_USER','root');
DEFINE ('DB_PASSWORD',"prle09");
DEFINE ('DB_HOST','localhost');
DEFINE ('DB_NAME','to_do');

$dbc=@mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME)
OR die('Greska prilikom uspostavljanja veze sa serverom ' . mysqli_connect_error());

?>