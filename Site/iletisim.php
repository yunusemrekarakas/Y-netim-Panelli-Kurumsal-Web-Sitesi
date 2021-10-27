<?php
$sayfa="İletişim";
    include("dbv.php");
    $tanimlama="İletisim Sayfasi";
    $key="iletisim";
    include('include.php');
    session_start();
   ?>
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase mt-3">İLETİŞİM</h2>
                </div>
                <form id="contactForm" name="sentMessage" novalidate method="post" action="iletisim.php">
                    <div class="row align-items-stretch mb-5">
                        <div class="col-md-6">
                            <div class="form-group">
                                <input class="form-control" id="name" name="adtext" type="text" placeholder="Adınız *" required data-validation-required-message="Please enter your name." />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group">
                                <input class="form-control" id="email" name="emailtext" type="email" placeholder="Email *" required data-validation-required-message="Please enter your email address." />
                                <p class="help-block text-danger"></p>
                            </div>
                            <div class="form-group mb-md-0">
                                <img src="captca/captcha.php" alt="">
                                <input type="text" class="form-control" placeholder="Güvenlik kodunu giriniz *" name="captcha" required="required">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-group-textarea mb-md-0">
                                <textarea class="form-control" id="message" name="mesajtext" placeholder="Mesajınız *" required data-validation-required-message="Please enter a message."></textarea>
                                <p class="help-block text-danger"></p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center">
                        <div id="success"></div>
                        <button class="btn btn-primary btn-xl text-uppercase" id="sendMessageButton" type="submit">Gonder</button>
                    </div>
                </form>
                <script type="text/javascript" src="js/sweetalert2.all.min.js"></script>
                <?php
                    if ($_POST)
                    {
                        if ($_SESSION['captcha']==$_POST['captcha']) {
                            $sorgu = $baglanti->prepare("insert into iletisimform set ad=:ad,mail=:mail,mesaj=:mesaj");
                            $ekle = $sorgu->execute(
                                [
                                    'ad' => htmlspecialchars($_POST["adtext"]),
                                    'mail' => htmlspecialchars($_POST["emailtext"]),
                                    'mesaj' => htmlspecialchars($_POST["mesajtext"]),
                                ]
                            );
                            if ($ekle) {

                                function mailgonder(){
                                    require "captca/class.phpmailer.php"; // PHPMailer dosyamızı çağırıyoruz
                                    $mail = new PHPMailer();
                                    $mail->IsSMTP();
                                    $mail->From     = "deneme@mesutd.com"; //Gönderen kısmında yer alacak e-mail adresi
                                    $mail->Sender   = $_POST["emailtext"];
                                    $mail->FromName = $_POST["adtext"];
                                    $mail->Host     = "mail.mesutd.com"; //SMTP server adresi
                                    $mail->SMTPAuth = true;
                                    $mail->Username = "deneme@mesutd.com"; //SMTP kullanıcı adı
                                    $mail->Password = "*****"; //SMTP şifre
                                    $mail->SMTPSecure="";
                                    $mail->Port = "587";
                                    $mail->CharSet = "utf-8";
                                    $mail->WordWrap = 50;
                                    $mail->IsHTML(true); //Mailin HTML formatında hazırlanacağını bildiriyoruz.
                                    $mail->Subject  = "Web Mesaj".$_POST["adtext"];

                                    $mail->Body = $_POST["mesajtext"];
                                    $mail->AltBody = strip_tags("mesaj");
                                    $mail->AddAddress("deneme@mesutd.com");
                                    return ($mail->Send())?true:false;
                                    $mail->ClearAddresses();
                                    $mail->ClearAttachments();
                                }
                                if(mailgonder()) echo "<script>Swal.fire({title:'Başarılı',text:'Mesajınız Bize Ulaştı',icon:'success',confirmButtonText:'Kapat' }) </script>";
                                else echo "<script> Swal.fire({title:'Başarısız',text:'Zorunlu Alanları Doldurunuz',icon:'error',confirmButtonText:'Kapat' }) </script>";


                            }
                        }
                    }
                ?>
            </div>
        </section>
        <?php
    include("footer.php");
   ?>
