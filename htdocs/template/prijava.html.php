<?php ob_start(); ?>
<div class="container">
    <h1>Prijava</h1>
    <?php
        session_start();

        if (isset($_POST['login'])) {
            $uime = strip_tags(trim($_POST['uime']));
            $geslo = $_POST['geslo'];

            $hCaptchaResponse = $_POST['h-captcha-response'];
            $secretKey = "ES_e8f9644a352a421ab3362a338a7e9e5a";
            $data = array(
                'secret' => $secretKey,
                'response' => $hCaptchaResponse
            );
        
            $verify = curl_init();
            curl_setopt($verify, CURLOPT_URL, "https://hcaptcha.com/siteverify");
            curl_setopt($verify, CURLOPT_POST, true);
            curl_setopt($verify, CURLOPT_POSTFIELDS, http_build_query($data));
            curl_setopt($verify, CURLOPT_RETURNTRANSFER, true);
            
            $response = curl_exec($verify);
            $responseData = json_decode($response);

            if (!$responseData->success) {
                echo "<div class='alert alert-danger' role='alert'>Captcha validacija ni uspela.</div>";
            } else if (empty($uime) || empty($geslo)) {
                echo "<div class='alert alert-danger' role='alert'>Niste izpolnili vseh polj!</div>";
            } else {
                $link = new mysqli("localhost", "root", "", "users");
                if ($link->connect_error) {
                    die("Povezava ni uspela: " . $link->connect_error);
                }

                // Poizvedba brez pripravljenih stavkov
                $sql = "SELECT password FROM users WHERE username = '$uime'";
                $result = mysqli_query($link, $sql);
                
                if (mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $hashed_password = $row['password'];
                    
                    if (password_verify($geslo, $hashed_password)) {
                        $_SESSION['username'] = $uime;
                        echo "<div class='alert alert-success' role='alert'>Prijava uspešna!</div>";
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
                <div class="h-captcha" data-sitekey="8f0876c4-fa12-4440-8a66-5ab653aa8c32"></div>
                <input name="login" type="submit" class="btn btn-primary" value="Sign In"/>
            </form>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require "template/layout.html.php";
?>
