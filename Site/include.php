<!DOCTYPE html>
<html lang="tr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="<?= $tanimla ?>" />
        <meta name="keyword" content="<?= $key ?>" />
        <meta name="author" content="" />
        <title><?= $sayfa ?>
        </title>
        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.1/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top bg-secondary" id="mainNav">
            <div class="container">
                <a class="navbar-brand js-scroll-trigger" href="index.php"><img src="assets/img/Weibe_Logo1.png" alt="" /></a>
                <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="fas fa-bars ml-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ml-auto ">
						<li class="nav-item"><a class="nav-link js-scroll-trigger <?php if($sayfa=="Ana Sayfa")echo"active"?>" href="anasayfa">Ana Sayfa</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger <?php if($sayfa=="Servis")echo"active"?>" href="servis">Servis</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger <?php if($sayfa=="Portfolyo")echo"active"?>" href="portfolyo">Ürünler</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger <?php if($sayfa=="Hakkımızda")echo"active"?>" href="hakkimizda">Hakkımızda</a></li>
                        <li class="nav-item"><a class="nav-link js-scroll-trigger <?php if($sayfa=="İletişim")echo"active"?>" href="iletisim">İletişim</a></li>
                    </ul>
                </div>
            </div>
        </nav>