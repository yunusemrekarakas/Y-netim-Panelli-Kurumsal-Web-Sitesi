<?php
$sayfa = "Servis";
include("dbv.php");
$sorgu = $baglanti->prepare("select * from servis");
$sorgu->execute();
$sonuc = $sorgu->fetch();
$tanimla = $sonuc["tanimla"];
$key = $sonuc["anahtarkelime"];
include("include.php");
?>
<!-- Services-->
<section class="page-section" id="services">
    <div class="container">
        <div class="text-center">
            <h2 class="section-heading text-uppercase mt-3"><?php echo $sonuc["baslik"] ?></h2>
            <h3 class="section-subheading text-muted"><?php echo $sonuc["altaciklama"] ?></h3>
        </div>
        <div class="row text-center">
            <?php
            $sorgu3 = $baglanti->prepare("select * from servislerimiz WHERE aktif=1 ORDER BY sirala");
            $sorgu3->execute();
            while ($sonuc3 = $sorgu3->fetch()) {
                ?>
                <div class="col-md-4">
                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-primary"></i>
                            <i class="fas <?php echo $sonuc3["fotolar"] ?> fa-stack-1x fa-inverse"></i>
                        </span>
                    <h4 class="my-3"> <?php echo $sonuc3["baslik"] ?> </h4>
                    <p class="text-muted"><?php echo $sonuc3["icerik"] ?> </p>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<!-- Footer-->
<?php
include("footer.php");
?>
