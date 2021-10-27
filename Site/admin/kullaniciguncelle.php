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

if ($_POST){
    $aktif=0;
    if (isset($_POST["aktif"])) $aktif=1;
    if($_POST["yetki"]!='' &&  $_POST["kadi"]!=''&& $_POST["email"]!=''){
            $sorgu2=$baglanti->prepare("update kullanici set aktif=:aktif,email=:email,yetki=:yetki,kadi=:kadi where id=:id");
            $ekle=$sorgu2->execute([
                    'aktif'=>$aktif,
                    'email'=>$_POST['email'],
                    'yetki'=>$_POST['yetki'],
                    'id'=>$_GET['id'],
                    'kadi'=>$_POST['kadi']
            ]);
            if ($ekle){
                echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
                echo "<script>Swal.fire({title:'Başarılı',text:'Güncelleme Başarılı',icon:'success',confirmButtonText:'Kapat' }).then((value)=>{
                if (value.isConfirmed){
                    window.location.href='kullanici.php'}}) </script>";
            }else{
                echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
                echo "<script>Swal.fire({title:'Hata',text:'Güncelleme Başarısız',icon:'error',confirmButtonText:'Kapat' })</script>";
            }
        }
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Kullanıcı Güncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Gösterge Paneli</li>
            <li class="breadcrumb-item active">Kullanıcı Güncelle</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action=""method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input type="text" required name="kadi" class="form-control-file" value="<?= $sonuc["kadi"]?>">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" required name="email" class="form-control" value="<?= $sonuc["email"]?>">
                    </div>
                    <div class="form-group">
                        <label>Yetki</label><br>
                        <label><input type="radio" name="yetki" value="1"<?= $sonuc["yetki"]=='1'?'checked':''?>>Admin</label><br>
                        <label><input type="radio" name="yetki" value="2"<?= $sonuc["yetki"]=='2'?'checked':''?>> Normal Kullanıcı</label>
                    </div>
                    <div class="form-group">
                        <label>
                        <input type="checkbox" name="aktif" <?= $sonuc["aktif"]=='1'?'checked':''?> class="form-check-input">Aktif mi</label>
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

