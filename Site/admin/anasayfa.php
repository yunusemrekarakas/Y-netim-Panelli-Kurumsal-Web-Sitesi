<?php
$sayfa="Ana Sayfa";
include("incl/adminhead.php");
$sorgu=$baglanti->prepare("select * from anasayfa");
$sorgu->execute();
$sonuc=$sorgu->fetch();
?>
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Ana Sayfa</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Gösterge Paneli</li>
                            <li class="breadcrumb-item active">Ana Sayfa</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>

                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Üst Başlık</th>
                                                <th>Alt Başlık</th>
                                                <th>Link Metin</th>
                                                <th>Link</th>
                                                <th>Tanımla</th>
                                                <th>Anahtar</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><?= $sonuc["ustbaslik"]?></td>
                                                <td><?= $sonuc["altbaslik"]?></td>
                                                <td><?=  $sonuc["linkmetin"]?></td>
                                                <td><?=  $sonuc["link"]?></td>
                                                <td><?=  $sonuc["tanimla"]?></td>
                                                <td><?=  $sonuc["anahtarkelime"]?></td>
                                                 <td class="text-center" ><a href="anasayfaduzenle.php?id=<?=  $sonuc["id"]?>">
                                                         <span class="fa fa-edit fa-2x"></span>
                                                     </a></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
<?php
include("incl/adminfooter.php");
?>
