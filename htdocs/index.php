<?php
//front controller
if (isset($_COOKIE['rememberme'])) {
  $cookie = $_COOKIE['rememberme'];
  $link = new mysqli("localhost", "root", "", "users");
  if ($link->connect_error) {
      die("Povezava ni uspela: " . $link->connect_error);
  }

  $sql = "SELECT username FROM users WHERE cookie = '$cookie'";
  $result = mysqli_query($link, $sql);
  $row = mysqli_fetch_assoc($result);
  $username = $row['username'];

  $_SESSION['useranme'] = $username;
  mysqli_close($link);
}

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