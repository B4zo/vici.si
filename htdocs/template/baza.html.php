<?php
function open_database_connection(){
	$link=new mysqli("localhost","3r3_2025","3r3_2025","3r3_2025");
	$link->query("SET NAMES 'utf8'");
	return $link;
}

function close_database_connection($link){
	mysqli_close($link);
}
?>