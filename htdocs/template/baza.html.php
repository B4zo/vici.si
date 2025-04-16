<?php
function open_database_connection(){
	$link = new mysqli("localhost", "root", "", "users");
	if ($link->connect_error) {
		die("Povezava ni uspela: " . $link->connect_error);
	}
}

function close_database_connection($link){
	mysqli_close($link);
}
?>