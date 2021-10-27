   <?php
		$sayfa="Ana Sayfa";
		include("dbv.php");
		$sorgu=$baglanti->prepare("select * from anasayfa");
		$sorgu->execute();
		$sonuc=$sorgu->fetch();
		$tanimla=$sonuc["tanimla"];
		$key=$sonuc["anahtarkelime"];
   include("include.php");
   ?>
       <!-- Masthead-->
        <header class="masthead" style="color:#1b1e21;margin-top:75px; background-image:url('assets/img/anaresim.jpg')">
            <div class="container">
                <div class="masthead-subheading"><?php echo $sonuc["ustbaslik"]  ?></div>
                <div></div>
                <a class="btn btn-primary btn-xl text-uppercase js-scroll-trigger" href="<?php echo $sonuc["link"] ?>"><?php echo $sonuc["linkmetin"]  ?></a>
            </div>
        </header>
        <!-- Clients-->
        <div class="py-5 te">
            <h3 class="text-center"><i>Referanslar</i></h3>
            <div class="container te">
                <div class="row te">
                    <?php
                    $sorgu2=$baglanti->prepare("select * from referans WHERE aktif=1 ORDER BY sirala");
                    $sorgu2->execute();
                    while ($sonuc2=$sorgu2->fetch())
                    {
                    ?>
                    <div class="col-md-3 col-sm-6 my-3">
                        <a href="<?php echo $sonuc2["link"] ?>"><img class="img-fluid d-block mx-auto" src="assets/img/logos/<?php echo $sonuc2["foto"]  ?>" alt="" /></a>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <!-- Footer-->
        <?php
    	include("footer.php");
   		?>
