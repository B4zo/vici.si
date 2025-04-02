<?php ob_start(); ?>
<div class="container">
    <h1>Prijava</h1>
    <?php
        session_start();

        if (isset($_POST['login'])) {
            $uime = strip_tags(trim($_POST['uime']));
            $geslo = $_POST['geslo'];
            $rememberMe = isset($_POST['rememberme']) ? true : false;

            if (empty($uime) || empty($geslo)) {
                echo "<div class='alert alert-danger' role='alert'>Niste izpolnili vseh polj!</div>";
            } else {
                $link = new mysqli("localhost", "root", "", "users");
                if ($link->connect_error) {
                    die("Povezava ni uspela: " . $link->connect_error);
                }

                $sql = "SELECT password FROM users WHERE username = '$uime'";
                $result = mysqli_query($link, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $hashed_password = $row['password'];
                    
                    if (password_verify($geslo, $hashed_password)) {
                        $_SESSION['username'] = $uime;
                        echo "<div class='alert alert-success' role='alert'>Prijava uspešna!</div>";
                        if($rememberMe){
                            $token = bin2hex(random_bytes(32));
                            $token = $link->real_escape_string($token);

                            $sql1 = "UPDATE users SET cookie = '$token' WHERE username = '$uime'";
                            mysqli_query($link, $sql1);

                            $expiry = time() + (30 * 24 * 60 * 60);
                            setcookie("rememberme", $token, $expiry, "/", "", false, true);
                        }
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Napačno geslo!</div>";
                    }
                } else {
                    echo "<div class='alert alert-danger' role='alert'>Uporabniško ime ne obstaja!</div>";
                }
                
                mysqli_close($link);
            }
        }
    ?>

    <div class="row">
        <div class="col">
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputUsername">Uporabniško ime</label>
                    <input name="uime" type="text" class="form-control" id="exampleInputUsername">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Geslo</label>
                    <input name="geslo" type="password" class="form-control" id="exampleInputPassword1">
                </div>
                <div class="form-group">
                    <input type="checkbox" aria-label="Remember me!" name="rememberme">
                    <label for="checkbox">Remember me!</label>
                </div>
                <div class="form-group">
                    <input name="login" type="submit" class="btn btn-primary" value="Sign In"/>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require "template/layout.html.php";
?>
