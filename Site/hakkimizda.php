<?php
$sayfa="Hakkımızda";
include("dbv.php");
$sorgu = $baglanti->prepare("select * from hakkimizda");
$sorgu->execute();
$sonuc = $sorgu->fetch();
$tanimla = $sonuc["tanimla"];
$key = $sonuc["anahtarkelime"];
    include("include.php");
 ?>
        <!-- About-->
        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase mt-3"><?php echo $sonuc["baslik"] ?></h2>
                    <h3 class="section-subheading text-muted"><?php echo $sonuc["altaciklama"] ?></h3>
                </div>
                <ul class="timeline">
                    <?php
                    $sorgu3 = $baglanti->prepare("select * from tarihi");
                    $sorgu3->execute();
                    $yon=false;
                    while ($sonuc3 = $sorgu3->fetch()) {
                    ?>
                    <li <?php if ($yon==true)echo 'class="timeline-inverted"';?> >
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/<?php echo $sonuc3["fotograf"] ?>" alt="" /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                                <h4><?php echo $sonuc3["tarih"] ?></h4>
                                <h4 class="subheading"><?php echo $sonuc3["baslik"] ?></h4>
                            </div>
                            <div class="timeline-body"><p class="text-muted"><?php echo $sonuc3["icerik"] ?></p></div>
                        </div>
                    </li>
                   <?php
                        $yon=!$yon;
                    }
                   ?>
                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4>
                                <br />
                                <br />
                            </h4>
                        </div>
                    </li>
                </ul>
            </div>
        </section>
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $sonuc["ikincibaslik"] ?></h2>
                    <h3 class="section-subheading text-muted"><?php echo $sonuc["ikinciicerik"] ?></h3>
                </div>
                <div class="row">
                    <?php
                    $sorgu4 = $baglanti->prepare("select * from kisiler");
                    $sorgu4->execute();
                    while ($sonuc4 = $sorgu4->fetch()) {
                    ?>
                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/<?php echo $sonuc4["foto"] ?>" alt="" />
                            <h4><?php echo $sonuc4["adsoyad"] ?></h4>
                            <p class="text-muted"><?php echo $sonuc4["gorevi"] ?></p>
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $sonuc4["twitter"] ?>"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $sonuc4["facebook"] ?>"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $sonuc4["linkedin"] ?>"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center"><p class="large text-muted"><?php echo $sonuc["sonicerik"] ?></p></div>
                </div>
            </div>
        </section>


        <?php
    include("footer.php");
   ?>
