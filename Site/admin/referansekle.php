<?php
$sayfa="Referanslar";
include("incl/adminhead.php");
if ($_SESSION["yetki"]!="1"){
    echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
        echo "<script>Swal.fire({title:'Hata!',text:'Yetkisiz Kullanıcı !',icon:'error',confirmButtonText:'Kapat' }).then((value)=>{
    if (value.isConfirmed){
        window.location.href='referans.php'}}) </script>";
        exit();
    }
if ($_POST){
    $aktif=0;
    if (isset($_POST["aktif"])) $aktif=1;
    $hata='';
    if ($_POST["link"] !='' && $_POST["sirala"] !='' && $_FILES["foto"]['name'] !=''){
        if ($_FILES["foto"]['error']!=0){
            $hata.='Dosya yüklemede Hata Gerçekleşti';
        }
        elseif (file_exists("../assets/img/logos/".strtolower($_FILES["foto"]['name']))){
            $hata.='Aynı Dosyadan Mevcut';
        }
        elseif ($_FILES["foto"]['size']>(1024*1024*3)){
            $hata.='Dosya Boyutu 3mb Fazla Olamaz';
        }
        else{
            copy($_FILES['foto']['tmp_name'],'../assets/img/logos/'.strtolower($_FILES["foto"]['name']));
            $sorgu2=$baglanti->prepare("insert into referans set aktif=:aktif,foto=:foto,sirala=:sirala,link=:link");
            $ekle=$sorgu2->execute([
                    'aktif'=>$aktif,
                    'foto'=>strtolower($_FILES["foto"]['name']),
                    'sirala'=>$_POST["sirala"],
                    'link'=>$_POST["link"]
            ]);
            if ($ekle){
                echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
                echo "<script>Swal.fire({title:'Başarılı',text:'Ekleme Başarılı',icon:'success',confirmButtonText:'Kapat' }).then((value)=>{
            if (value.isConfirmed){
                window.location.href='referans.php'}}) </script>";
            }
        }
        if ($hata){
            echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script>Swal.fire({title:'Hata',text:'$hata',icon:'error',confirmButtonText:'Kapat' })</script>";
        }
    }

}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Referan Ekle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Gösterge Paneli</li>
            <li class="breadcrumb-item active">Referans Ekle</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action=""method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Fotoğraf</label>
                        <input type="file" required name="foto" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Link</label>
                        <input type="text" required name="link" class="form-control" value="<?= @$_POST["link"]?>">
                    </div>
                    <div class="form-group">
                        <label>Sıra</label>
                        <input type="text" required name="sirala" class="form-control" value="<?= @$_POST["sirala"]?>">
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

