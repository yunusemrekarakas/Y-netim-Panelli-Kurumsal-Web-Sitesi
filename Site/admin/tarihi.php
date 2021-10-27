<?php
$sayfa="Tarihçe";
include("incl/adminhead.php");
?>
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><?= $sayfa ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Gösterge Paneli</li>
                            <li class="breadcrumb-item active"><?= $sayfa ?></li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="tarihekle.php" class="btn btn-primary" > Tarih Ekle</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Fotoğraf</th>
                                                <th>Tarih</th>
                                                <th>Başlık</th>
                                                <th>icerik</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sorgu=$baglanti->prepare("select * from tarihi");
                                        $sorgu->execute();
                                        while ($sonuc=$sorgu->fetch()){
                                        ?>
                                            <tr>
                                                <td><img width="100" src="../assets/img/about/<?= $sonuc["fotograf"]?>" alt=""></td>
                                                <td><?=  $sonuc["tarih"]?></td>
                                                <td><?=  $sonuc["baslik"]?></td>
                                                <td><?=  $sonuc["icerik"]?></td>
                                                 <td class="text-center" ><a href="tarihguncelle.php?id=<?=  $sonuc["id"]?>">
                                                         <span class="fa fa-edit fa-2x"></span>
                                                     </a></td>
                                                <td class="text-center">
                                                    <a href="#" data-toggle="modal" data-target="#silModal<?=  $sonuc["id"]?>"> <span class="fa fa-trash fa-2x text-danger"></span></a>
                                                    <!-- Modal -->
                                                    <div class="modal fade" id="silModal<?= $sonuc["id"]?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="exampleModalLabel">Sil</h5>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <img width="200" src="../assets/img/logos/<?=$sonuc["fotograf"]?>"alt="">
                                                                              Silmek istediğinizden emin misiniz?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                                                    <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=tarihi " class="btn btn-danger">Sil</a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
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
