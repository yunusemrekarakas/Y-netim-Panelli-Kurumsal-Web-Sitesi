<?php
$sayfa="Referanslar";
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
                                <a href="referansekle.php" class="btn btn-primary" > Referans Ekle</a>
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Fotoğraf</th>
                                                <th>Link</th>
                                                <th>Sira</th>
                                                <th>Aktif Durumu</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $sorgu=$baglanti->prepare("select * from referans");
                                        $sorgu->execute();
                                        while ($sonuc=$sorgu->fetch()){
                                        ?>
                                            <tr>
                                                <td><?= $sonuc["id"]?></td>
                                                <td><img width="200" src="../assets/img/logos/<?= $sonuc["foto"]?>" alt=""></td>
                                                <td><?=  $sonuc["link"]?></td>
                                                <td><?=  $sonuc["sirala"]?></td>
                                                <td>
                                                    <link href="css/switch.css" rel="stylesheet"/>
                                                    <label class="switch">
                                                        <!-- checkbox a id ve checked bilgilerini ekliyoruz -->
                                                        <input type="checkbox" id='<?php echo $sonuc['id'] ?>' class="aktifPasif" <?php echo $sonuc['aktif']==1?'checked':'' ?>/>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                 <td class="text-center" ><a href="referansguncelle.php?id=<?=  $sonuc["id"]?>">
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
                                                                    <img width="200" src="../assets/img/logos/<?=$sonuc["foto"]?>"alt="">
                                                                              Silmek istediğinizden emin misiniz?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">İptal</button>
                                                                    <a href="sil.php?id=<?= $sonuc["id"] ?>&tablo=referans " class="btn btn-danger">Sil</a>
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
<script>
    $(document).ready(function () {
        $('.aktifPasif').click(function (event) {
            var id = $(this).attr("id");  //id değerini alıyoruz

            var durum = ($(this).is(':checked')) ? '1' : '0';
            //checkbox a göre aktif mi pasif mi bilgisini alıyoruz.

            $.ajax({
                type: 'POST',
                url: 'incl/aktifPasif.php',  //işlem yaptığımız sayfayı belirtiyoruz
                data: { id:id,tablo:'referans',durum: durum }, //datamızı yolluyoruz
                success: function (result) {
                    $('#sonuc').text(result);
                    //gelen sonucu h2 tagında gösteriyoruz
                },
                error: function () {
                    alert('Hata');
                }
            });
        });
    });

</script>
