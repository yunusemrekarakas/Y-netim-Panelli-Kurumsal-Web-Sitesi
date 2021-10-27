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
if ($_POST){
    $aktif=0;
    if (isset($_POST["aktif"])) $aktif=1;
    if($_POST["parola"]!='' && $_POST["yetki"]!='' &&  $_POST["kadi"]!=''&& $_POST["email"]!=''){
            $sorgu2=$baglanti->prepare("insert into kullanici set aktif=:aktif,email=:email,yetki=:yetki,parola=:parola,kadi=:kadi");
            $ekle=$sorgu2->execute([
                    'aktif'=>$aktif,
                    'email'=>$_POST['email'],
                    'yetki'=>$_POST['yetki'],
                    'parola'=>$_POST['parola'],
                    'kadi'=>$_POST['kadi']
            ]);
            if ($ekle){
                echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
                echo "<script>Swal.fire({title:'Başarılı',text:'Ekleme Başarılı',icon:'success',confirmButtonText:'Kapat' }).then((value)=>{
                if (value.isConfirmed){
                    window.location.href='kullanici.php'}}) </script>";
            }else{
                echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
                echo "<script>Swal.fire({title:'Hata',text:'Ekleme Başarısız',icon:'error',confirmButtonText:'Kapat' })</script>";
            }
        }
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Kullanıcı Ekle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Gösterge Paneli</li>
            <li class="breadcrumb-item active">Kullanıcı Ekle</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action=""method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Kullanıcı Adı</label>
                        <input type="text" required name="kadi" class="form-control-file" value="<?= @$_POST["kadi"]?>">
                    </div>
                    <div class="form-group">
                        <label>Parola</label>
                        <input type="password" required name="parola" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" required name="email" class="form-control" value="<?= @$_POST["email"]?>">
                    </div>
                    <div class="form-group">
                        <label>Yetki</label><br>
                        <label><input type="radio" name="yetki" value="1">Admin</label><br>
                        <label><input type="radio" name="yetki" value="2" checked> Normal Kullanıcı</label>
                    </div>
                    <div class="form-group">
                        <label>
                        <input type="checkbox" name="aktif" class="form-check-input">Aktif mi</label>
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Ekle" class="btn btn-primary">
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>
<?php
include("incl/adminfooter.php");
?>

