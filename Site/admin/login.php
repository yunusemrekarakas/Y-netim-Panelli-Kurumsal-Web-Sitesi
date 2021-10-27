<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <title>Admin Giriş</title>
    <link href="css/styles.css" rel="stylesheet"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js"
            crossorigin="anonymous"></script>
</head>
<body class="bg-primary">
<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        <div class="card shadow-lg border-0 rounded-lg mt-5">
                            <div class="card-header"><h3 class="text-center font-weight-light my-4">Kullanıcı
                                    Girişi</h3></div>
                            <div class="card-body">
                                <?php
                                session_start();
                                include("../dbv.php");
                                if (isset($_SESSION["oturum"]) && $_SESSION["oturum"] == "1234") {

                                    header("location:index.php");
                                }
                                elseif (isset($_COOKIE["cerez"])) {
                                    $sorgu = $baglanti->prepare("select kadi,yetki from kullanici where aktif=1");
                                    $sorgu->execute();
                                    while ($sonuc = $sorgu->fetch()) {
                                        if ($_COOKIE["cerez"] == $sonuc["kadi"]) {
                                            $_SESSION["oturum"] = "1234";
                                            $_SESSION["kadi"] = $sonuc["kadi"];
                                            $_SESSION["yetki"] = $sonuc["yetki"];
                                            header("location:index.php");
                                        }
                                    }
                                }

                                if ($_POST) {
                                    $kadi = $_POST["textkadi"];
                                    $sifre = $_POST["textsifre"];
                                }

                                ?>
                                <form method="post" action="login.php">
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputEmailAddress">Kullanıcı Adı</label>
                                        <input class="form-control py-4" id="inputEmailAddress" type="text"
                                               value="<?php echo @$kadi ?>" name="textkadi"
                                               placeholder="Kullanıcı Adı Giriniz"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="small mb-1" for="inputPassword">Password</label>
                                        <input class="form-control py-4" id="inputPassword" type="password"
                                               name="textsifre" placeholder="Parola Giriniz"/>
                                    </div>
                                    <div class="form-group">
                                        <img src="../captca/captcha.php" alt="">
                                        <input class="form-control py-4" id="inputPassword" type="text"
                                               name="captcha" placeholder="Güvenlik Kodu Giriniz"/>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox">
                                            <input class="custom-control-input" id="rememberPasswordCheck"
                                                   name="chbunuttum" type="checkbox"/>
                                            <label class="custom-control-label" for="rememberPasswordCheck">Beni Hatırla
                                                </label>
                                        </div>
                                    </div>
                                    <div class="form-group d-flex align-items-center justify-content-between mt-4 mb-0">
                                        <a class="small" href="password.html">Şifremi Unuttum</a>
                                        <input class="btn btn-primary" type="submit" value="Giriş"/>
                                    </div>
                                </form>
                                <script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>
                                <?php
                                if ($_POST) {
                                    if ($_SESSION["captcha"] == $_POST["captcha"]) {
                                        $sorgu = $baglanti->prepare("select parola,yetki from kullanici where kadi=:kadi and aktif=1");
                                        $sorgu->execute(['kadi' => htmlspecialchars($kadi)]);
                                        $sonuc = $sorgu->fetch();
                                        if ($sifre == $sonuc["parola"]) {
                                            $_SESSION["oturum"] = "1234";
                                            $_SESSION["kadi"] = $kadi;
                                            $_SESSION["yetki"] = $sonuc["yetki"];
                                            if (isset($_POST["chbunuttum"])) {
                                                setcookie("cerez", $kadi, time() + (60 * 60 * 24 * 7));

                                            }
                                            header("location:index.php");
                                        } else
                                            echo "<script> Swal.fire({title:'Başarısız',text:'Kullanıcı Adı veya Şifre Yanlış',icon:'error',confirmButtonText:'Kapat' }) </script>";
                                    }
                                    else
                                        echo "<script> Swal.fire({title:'Başarısız',text:'Güvenlik Kodunu Yanlış Girdiniz',icon:'error',confirmButtonText:'Kapat' }) </script>";
                                }
                                ?>
                            </div>
                            <div class="card-footer text-center">
                                <div class="small"><a href="register.html">Need an account? Sign up!</a></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="py-4 bg-light mt-auto">
            <div class="container-fluid">
                <div class="d-flex align-items-center justify-content-between small">
                    <div class="text-muted">Copyright &copy; Your Website 2020</div>
                    <div>
                        <a href="#">Privacy Policy</a>
                        &middot;
                        <a href="#">Terms &amp; Conditions</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
<script src="js/scripts.js"></script>
</body>
</html>
