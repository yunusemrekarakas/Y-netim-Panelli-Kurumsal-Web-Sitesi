<?php
$sayfa="Servis";
include("incl/adminhead.php");
if ($_SESSION["yetki"]!="1"){
    echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
        echo "<script>Swal.fire({title:'Hata!',text:'Yetkisiz Kullanıcı !',icon:'error',confirmButtonText:'Kapat' }).then((value)=>{
    if (value.isConfirmed){
        window.location.href='anasayfa.php'}}) </script>";
        exit();
    }
$sorgu = $baglanti->prepare("select * from servislerimiz where id=:id");
$sorgu->execute(['id'=>$_GET['id']]);
$sonuc = $sorgu->fetch();
if ($_POST){
    $aktif=0;
    if (isset($_POST["aktif"])) $aktif=1;
    if ($_POST["sirala"] !=''){
        $sorgu2=$baglanti->prepare("update servislerimiz set aktif=:aktif,sirala=:sirala,baslik=:baslik,icerik=:icerik where id=:id");
        $guncelle=$sorgu2->execute([
            'aktif'=>$aktif,
            'sirala'=>$_POST["sirala"],
            'baslik'=>$_POST["baslik"],
            'icerik'=>$_POST["icerik"],
            'id'=>$_GET['id']
        ]);
        if ($guncelle){
            echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script>Swal.fire({title:'Başarılı',text:'Güncelleme Başarılı',icon:'success',confirmButtonText:'Kapat' }).then((value)=>{
            if (value.isConfirmed){
                window.location.href='servissayfasi.php'}}) </script>";
        }
    }

}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Servis Guncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Gösterge Paneli</li>
            <li class="breadcrumb-item active">Servis Guncelle</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
            </div>
            <div class="card-body">
                <form action=""method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" required name="baslik" class="form-control" value="<?= $sonuc["baslik"]?>">
                    </div>
                    <div class="form-group">
                        <label>İçerik</label>
                        <input type="text" required name="icerik" class="form-control" value="<?= $sonuc["icerik"]?>">
                    </div>
                    <div class="form-group">
                        <label>Sıra</label>
                        <input type="text" required name="sirala" class="form-control" value="<?= $sonuc["sirala"]?>">
                    </div>
                    <div class="form-group">
                        <label>
                        <input type="checkbox" name="aktif" class="form-check-input" <?= $sonuc["aktif"]==1?'checked':''?> >Aktif mi</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Guncelle" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
<?php
include("incl/adminfooter.php");
?>

