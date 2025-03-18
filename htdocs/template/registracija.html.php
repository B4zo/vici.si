<?php ob_start(); ?>
<div class="container">
    <h1>Registracija</h1>
    <?php
        if (isset($_POST['signup'])) {
            $uime = strip_tags(trim($_POST['uime']));
            $geslo = $_POST['geslo'];
            $pgeslo = $_POST['pgeslo'];

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
            } else if (empty($uime) || empty($geslo) || empty($pgeslo)) {
                echo "<div class='alert alert-danger' role='alert'>Niste izpolnili vseh polj!</div>";
            } elseif (strlen($uime) > 30) {
                echo "<div class='alert alert-danger' role='alert'>Uporabniško ime je predolgo!</div>";
            } elseif (strlen($geslo) > 60) {
                echo "<div class='alert alert-danger' role='alert'>Geslo je predolgo!</div>";
            } elseif ($geslo !== $pgeslo) {
                echo "<div class='alert alert-danger' role='alert'>Gesli se ne ujemata!</div>";
            } elseif (!preg_match('/^(?=.*\d)(?=.*[A-Za-z])[0-9A-Za-z!@#$%]{8,12}$/', $pgeslo)) {
                echo "<div class='alert alert-danger' role='alert'>Geslo mora vsebovati črke, številke in posebne znake.</div>";
            } else {
                $link = new mysqli("localhost", "root", "", "users");
                if ($link->connect_error) {
                    die("Povezava ni uspela: " . $link->connect_error);
                }

                $sql = "SELECT username FROM users WHERE username = '$uime'";
                $result = mysqli_query($link, $sql);

                if (mysqli_num_rows($result) > 0) {
                    echo "<div class='alert alert-danger' role='alert'>Uporabniško ime je že zasedeno!</div>";
                } else {

                    $gkodirano = password_hash($geslo, PASSWORD_DEFAULT);
                    $date = date("Y-m-d");

                    $sql = "INSERT INTO users (username, password, date) VALUES ('$uime', '$gkodirano', '$date')";

                    if (mysqli_query($link, $sql)) {
                        echo "<div class='alert alert-success' role='alert'>Uspešno ste se registrirali.</div>";
                    } else {
                        echo "<div class='alert alert-danger' role='alert'>Napaka pri registraciji.</div>";
                    }
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
                    <label for="exampleInputPassword2">Ponovi geslo</label>
                    <input name="pgeslo" type="password" class="form-control" id="exampleInputPassword2">
                </div>
                <div class="h-captcha" data-sitekey="8f0876c4-fa12-4440-8a66-5ab653aa8c32"></div>
                <input name="signup" type="submit" class="btn btn-primary" value="Sign In"/>
            </form>
        </div>
    </div>
</div>
<?php
$content = ob_get_clean();
require "template/layout.html.php";
?>
