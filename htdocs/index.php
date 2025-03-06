<?php
//front controller
if (isset($_GET['stran'])){ //ce se v URL naslovu nahaja spremenljivka stran
	if (($_GET['stran']=="vici")){
		include 'template/vici.html.php';
	} else if (($_GET['stran']=="registracija")){
		include 'template/registracija.html.php';
  } else if (($_GET['stran']=="prijava")){
		include 'template/prijava.html.php';
  } else {
    include 'template/error.html.php';
  }
} else {
  include 'template/index.html.php';
}
?>
