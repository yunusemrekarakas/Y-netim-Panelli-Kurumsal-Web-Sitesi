<?php
$sayfa="Ana Sayfa";
include("incl/adminhead.php");
if ($_SESSION["yetki"]!="1"){
    echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
        echo "<script>Swal.fire({title:'Hata!',text:'Yetkisiz Kullanıcı !',icon:'error',confirmButtonText:'Kapat' }).then((value)=>{
    if (value.isConfirmed){
        window.location.href='anasayfa.php'}}) </script>";
        exit();
    }
$sorgu=$baglanti->prepare("select * from anasayfa where id=:id");
$sorgu->execute(['id'=>(int)$_GET["id"]]);
$sonuc=$sorgu->fetch();
if ($_POST){
    $sorguguncelle=$baglanti->prepare("update anasayfa set ustbaslik=:ustbaslik,altbaslik=:altbaslik,linkmetin=:linkmetin,link=:link,tanimla=:tanimla,anahtarkelime=:anahtarkelime where id=:id");
    $guncelle=$sorguguncelle->execute([
        'ustbaslik'=>$_POST["ustbaslik"],
        'altbaslik'=>$_POST["altbaslik"],
        'linkmetin'=>$_POST["linkmetin"],
        'link'=>$_POST["link"],
        'tanimla'=>$_POST["tanimla"],
        'anahtarkelime'=>$_POST["anahtarkelime"],
        'id'=>(int)$_GET["id"]
    ]);
    if ($guncelle){
        echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
        echo "<script>Swal.fire({title:'Başarılı',text:'Güncelleme Başarılı',icon:'success',confirmButtonText:'Kapat' }).then((value)=>{
    if (value.isConfirmed){
        window.location.href='anasayfa.php'}}) </script>";
    }
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Ana Sayfa Guncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Gösterge Paneli</li>
            <li class="breadcrumb-item active">Ana Sayfa Guncelle</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action=""method="post">
                    <div class="form-group">
                        <label>Üst Başlık</label>
                        <input type="text" required name="ustbaslik" class="form-control" value="<?= $sonuc["ustbaslik"]?>">
                    </div>
                    <div class="form-group">
                        <label>Alt Başlık</label>
                        <input type="text" required name="altbaslik" class="form-control" value="<?= $sonuc["altbaslik"]?>">
                    </div>
                    <div class="form-group">
                        <label>Link Metin</label>
                        <input type="text" required name="linkmetin" class="form-control" value="<?= $sonuc["linkmetin"]?>">
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" required name="link" class="form-control" value="<?= $sonuc["link"]?>">
                    </div>
                    <div class="form-group">
                        <label>Tanimlama</label>
                        <input type="text" required name="tanimla" class="form-control" value="<?= $sonuc["tanimla"]?>">
                    </div>
                    <div class="form-group">
                        <label>Anahtar</label>
                        <input type="text" required name="anahtarkelime" class="form-control" value="<?= $sonuc["anahtarkelime"]?>">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Güncelle" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
<?php
$sayfa="index";
include("incl/adminfooter.php");
?>

