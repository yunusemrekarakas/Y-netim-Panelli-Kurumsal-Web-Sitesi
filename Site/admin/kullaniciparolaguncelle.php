<?php
$sayfa="Kullanıcılar";
include("incl/adminhead.php");
if ($_SESSION["yetki"]!="1"){
    echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
        echo "<script>Swal.fire({title:'Hata!',text:'Yetkisiz Kullanıcı !',icon:'error',confirmButtonText:'Kapat' }).then((value)=>{
    if (value.isConfirmed){
        window.location.href='anasayfa.php'}}) </script>";
        exit();
    }
$sorgu = $baglanti->prepare("select * from kullanici where id=:id");
$sorgu->execute(['id'=>$_GET['id']]);
$sonuc = $sorgu->fetch();
if ($_POST) {
    if ($_POST["parola"] !='' && $_POST["parola"] == $_POST["tekrarparola"]) {
        $sorgu2 = $baglanti->prepare("update kullanici set parola=:parola,kadi=:kadi WHERE id=:id");
        $ekle = $sorgu2->execute([
            'parola'=>$_POST['parola'],
            'kadi' =>$_POST['kadi'],
            'id'=>$_GET['id']
        ]);
        if ($ekle) {
            echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script>Swal.fire({title:'Başarılı',text:'Güncelleme Başarılı',icon:'success',confirmButtonText:'Kapat' }).then((value)=>{
                if (value.isConfirmed){
                    window.location.href='kullanici.php'}}) </script>";
        } else {
            echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script>Swal.fire({title:'Hata',text:'Guncelleme Başarısız',icon:'error',confirmButtonText:'Kapat' })</script>";
        }
    } else {
        echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
        echo "<script>Swal.fire({title:'Hata',text:'Eksik Veri',icon:'error',confirmButtonText:'Kapat' })</script>";
    }
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Kullanıcı Guncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Gösterge Paneli</li>
            <li class="breadcrumb-item active">Kullanıcı Guncelle</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action=""method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input type="text" required name="kadi" class="form-control" value="<?= $sonuc["kadi"]?>">
                    </div>
                    <div class="form-group">
                        <label>Parola</label>
                        <input type="password" required name="parola" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Parola Tekrar</label>
                        <input type="password" required name="tekrarparola" class="form-control">
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

