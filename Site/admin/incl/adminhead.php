<?php
session_start();
if (!(isset($_SESSION["oturum"]) && $_SESSION["oturum"] == "1234")) {
    header("location:login.php");
}
include("../dbv.php");
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title> <?=$sayfa?></title>
    <link href="css/styles.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">
<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
    <a class="navbar-brand" href="index.php">Yönetim Paneli</a>
    <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
    <!-- Navbar Search-->
    <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
        <div class="input-group">
            <input class="form-control" type="text" placeholder="Arama için" aria-label="Search" aria-describedby="basic-addon2" />
            <div class="input-group-append">
                <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </form>
    <!-- Navbar-->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="genelparolaguncelle">Parola Değiştir</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Çıkış</a>
            </div>
        </li>
    </ul>
</nav>
<!-- Modal -->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Çıkış</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Çıkış yapmak istediğinizden emin misiniz?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                <a href="logout.php" class="btn btn-danger">Çıkış</a>
            </div>
        </div>
    </div>
</div>
<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <div class="sb-sidenav-menu-heading">Core</div>
                    <a class="nav-link <?= $sayfa=="Dashboard"?"active":""?>" href="index.php">
                        <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                        Gösterge Paneli
                    </a>
                    <div class="sb-sidenav-menu-heading">sayfalar</div>
                    <a class="nav-link collapsed" <?= $sayfa=="Ana Sayfa"||$sayfa=="Referanslar" ?"active":""?> href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Ana Sayfa
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?=$sayfa=="Ana Sayfa"?"active":""?>" href="anasayfa.php">Ana Sayfa</a>
                            <a class="nav-link <?=$sayfa=="Referanslar"?"active":""?>" href="referans.php">Referanslar</a>
                        </nav>
                    </div>
                    <a class="nav-link <?=$sayfa=="İletişim Formu"?"active":""?>" href="iletisimform.php">İletişim Formu</a>
                    <a class="nav-link collapsed" <?= $sayfa=="Hakkımızda"||$sayfa=="Tarihçe" ?"active":""?> href="#" data-toggle="collapse" data-target="#hakkimizda" aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Hakkımızda
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="hakkimizda" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link <?=$sayfa=="Referanslar"?"active":""?>" href="tarihi.php">Tarihçe</a>
                        </nav>
                    </div>
                    <a class="nav-link <?=$sayfa=="Kullanıcılar"?"active":""?>" href="kullanici.php">Kullanıcılar</a>
                    <a class="nav-link <?=$sayfa=="Portfolyo"?"active":""?>" href="portfolyolar.php">Portfolyo</a>
                    <a class="nav-link <?=$sayfa=="Servis"?"active":""?>" href="servissayfasi.php">Servis</a>
                </div>
            </div>
            <div class="sb-sidenav-footer">
                <div class="small">KULLANICI</div>
                <?= $_SESSION["kadi"]; ?>
            </div>
        </nav>
    </div>
    <div id="layoutSidenav_content">
