<?php
session_start();

if (!isset($_SESSION['user_id']) && isset($_COOKIE['rememberme'])) {
    $token = $_COOKIE['rememberme'];
    $tokenHashed = hash('sha256', $token);

    require_once 'baza.html.php';
    $sqlToken = "SELECT * FROM users WHERE token = '$tokenHashed'";
    $resultToken = mysqli_query($link, $sql);

    if ($resultToken && mysqli_num_rows($resultToken) === 1) {
        $user = mysqli_fetch_assoc($resultToken);
        
    } else {
        setcookie("rememberme", "", time() - 3600, "/", "", false, true);
    }
}
?>