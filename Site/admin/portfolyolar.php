<?php
$sayfa="Portfolyo";
include("incl/adminhead.php");
?>
 <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Ürün</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Gösterge Paneli</li>
                            <li class="breadcrumb-item active">Ürün</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <a href="portfolyoekle.php" class="btn btn-primary" > Ürün Ekle</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Küçük Fotoğraf</th>
                                                <th>Büyük Fotoğraf</th>
                                                <th>tarih</th>
                                                <th>baslik</th>
                                                <th>icerik</th>
                                                <th>Client</th>
                                                <th>Açıklama</th>
                                                <th>Kategori</th>
                                                <th>Sıra</th>
                                                <th>Aktif</th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sorgu=$baglanti->prepare("select * from portfolyalar");
                                        $sorgu->execute();
                                        while ($sonuc=$sorgu->fetch()){
                                        ?>
                                            <tr>
                                                <td><img width="100" src="../assets/img/portfolio/<?= $sonuc["kucukfoto"]?>" alt=""</td>
                                                <td><img width="100" src="../assets/img/portfolio/<?= $sonuc["buyukfoto"]?>" alt=""</td>
                                                <td><?=  $sonuc["tarih"]?></td>
                                                <td><?=  $sonuc["baslik"]?></td>
                                                <td><?=  $sonuc["icerik"]?></td>
                                                <td><?=  $sonuc["client"]?></td>
                                                <td><?=  $sonuc["aciklama"]?></td>
                                                <td><?=  $sonuc["kategori"]?></td>
                                                <td><?=  $sonuc["sirala"]?></td>
                                                <td><?=  $sonuc["aktif"]?></td>
                                                 <td class="text-center" ><a href="portfolyoguncelle.php?id=<?=  $sonuc["id"]?>">
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
                                                                    <img width="200" src="../assets/img/portfolio/<?=$sonuc["kucukfoto"]?>"alt="">
                                                                              Silmek istediğinizden emin misiniz?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                                                    <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=portfolyalar " class="btn btn-danger">Sil</a>
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
