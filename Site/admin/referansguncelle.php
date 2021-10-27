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
$id=$_GET["id"];
$sorgu = $baglanti->prepare("select * from referans where id=:id");
$sorgu->execute(['id'=>$id]);
$sonuc = $sorgu->fetch();
if ($_POST){
    $aktif=0;
    if (isset($_POST["aktif"])) $aktif=1;
    $hata='';
    $foto='';
    if ( $_FILES["foto"]['name'] !=''){
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
            unlink('../assets/img/logos/'.$sonuc["foto"]);
            $foto=strtolower($_FILES["foto"]['name']);
        }
        if ($hata){
            echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script>Swal.fire({title:'Hata',text:'$hata',icon:'error',confirmButtonText:'Kapat' })</script>";
        }
    }
    else{
        $foto=$sonuc["foto"];
    }
    if ($_POST["link"] !='' && $_POST["sirala"] !='' && $hata==''){
        $sorgu2=$baglanti->prepare("update referans set aktif=:aktif,foto=:foto,sirala=:sirala,link=:link where id=:id");
        $guncelle=$sorgu2->execute([
            'aktif'=>$aktif,
            'foto'=>$foto,
            'sirala'=>$_POST["sirala"],
            'link'=>$_POST["link"],
            'id'=>$id
        ]);
        if ($guncelle){
            echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script>Swal.fire({title:'Başarılı',text:'Güncelleme Başarılı',icon:'success',confirmButtonText:'Kapat' }).then((value)=>{
            if (value.isConfirmed){
                window.location.href='referans.php'}}) </script>";
        }
    }

}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Referans Guncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Gösterge Paneli</li>
            <li class="breadcrumb-item active">Referans Guncelle</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
            </div>
            <div class="card-body">
                <form action=""method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Fotoğraf</label><br>
                        <img src="../assets/img/logos/<?= $sonuc["foto"]?>" alt=""> <br><br>
                        <input type="file" name="foto" class="form-control-file">
                    </div>
                    <div class="form-group">

                        <label>Link</label>
                        <input type="text" required name="link" class="form-control" value="<?= $sonuc["link"]?>">
                    </div>
                    <div class="form-group">
                        <label>Sıra</label>
                        <input type="text" required name="sirala" class="form-control" value="<?= $sonuc["sirala"]?>">
                    </div>
                    <div class="form-group">
                        <label>
                        <input type="checkbox" name="anahtarkelime" class="form-check-input" <?= $sonuc["aktif"]==1?'checked':''?> >Aktif mi</label>
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

