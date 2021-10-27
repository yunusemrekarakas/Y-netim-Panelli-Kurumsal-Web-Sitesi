<?php
$sayfa="Portfolyo";
include("dbv.php");
$sorgu = $baglanti->prepare("select * from portfolyo");
$sorgu->execute();
$sonuc = $sorgu->fetch();
$tanimla = $sonuc["tanimla"];
$key = $sonuc["anahtarkelime"];
include("include.php");
   ?>

        <!-- Portfolio Grid-->
        <section class="page-section bg-light " id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase mt-3"><?php echo $sonuc["baslik"] ?></h2>
                    <h3 class="section-subheading text-muted"><?php echo $sonuc["altaciklama"] ?></h3>
                </div>
                <div class="row">
                    <?php
                    $sorgu3 = $baglanti->prepare("select * from portfolyalar WHERE aktif=1 ORDER BY sirala");
                    $sorgu3->execute();
                    while ($sonuc3 = $sorgu3->fetch()) {
                    ?>
                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-toggle="modal" href="#portfolioModal<?php echo $sonuc3["id"] ?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/<?php echo $sonuc3["kucukfoto"] ?>" alt="" />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading"> <?php echo $sonuc3["client"] ?> </div>
                                <div class="portfolio-caption-subheading text-muted"> <?php echo $sonuc3["kategori"] ?> </div>
                            </div>
                        </div>
                    </div>
                    <div class="portfolio-modal modal fade" id="portfolioModal<?php echo $sonuc3["id"] ?>" tabindex="-1" role="dialog" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                                <div class="container">
                                    <div class="row justify-content-center">
                                        <div class="col-lg-8">
                                            <div class="modal-body">
                                                <!-- Project Details Go Here-->
                                                <h2 class="text-uppercase"> <?php echo $sonuc3["baslik"] ?> </h2>
                                                <p class="item-intro text-muted"> <?php echo $sonuc3["aciklama"] ?> </p>
                                                <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/<?php echo $sonuc3["buyukfoto"] ?> " alt="" />
                                                <p> <?php echo $sonuc3["icerik"] ?> </p>
                                                <ul class="list-inline">
                                                    <li>Tarih: <?php echo $sonuc3["tarih"] ?></li>
                                                    <li>Müşteri: <?php echo $sonuc3["client"] ?></li>
                                                    <li>Kategori: <?php echo $sonuc3["kategori"] ?></li>
                                                </ul>
                                                <button class="btn btn-primary" data-dismiss="modal" type="button">
                                                    <i class="fas fa-times mr-1"></i>
                                                    Close Project
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </section>
        <div class="portfolio-modal modal fade" id="portfolioModal1" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <!-- Project Details Go Here-->
                                    <h2 class="text-uppercase">Project Name</h2>
                                    <p class="item-intro text-muted">Lorem ipsum dolor sit amet consectetur.</p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/01-full.jpg" alt="" />
                                    <p>Use this area to describe your project. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est blanditiis dolorem culpa incidunt minus dignissimos deserunt repellat aperiam quasi sunt officia expedita beatae cupiditate, maiores repudiandae, nostrum, reiciendis facere nemo!</p>
                                    <ul class="list-inline">
                                        <li>Tarih: January 2020</li>
                                        <li>Müşteri: Threads</li>
                                        <li>Kategori: Illustration</li>
                                    </ul>
                                    <button class="btn btn-primary" data-dismiss="modal" type="button">
                                        <i class="fas fa-times mr-1"></i>
                                        Close Project
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    include("footer.php");
   ?>

