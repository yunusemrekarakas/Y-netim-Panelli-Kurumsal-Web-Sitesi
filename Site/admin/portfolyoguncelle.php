<?php
$sayfa="Portfolyo";
include("incl/adminhead.php");
if ($_SESSION["yetki"]!="1"){
    echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
        echo "<script>Swal.fire({title:'Hata!',text:'Yetkisiz Kullanıcı !',icon:'error',confirmButtonText:'Kapat' }).then((value)=>{
    if (value.isConfirmed){
        window.location.href='portfolyolar.php'}}) </script>";
        exit();
    }
$id=$_GET["id"];
$sorgu = $baglanti->prepare("select * from portfolyalar where id=:id");
$sorgu->execute(['id'=>$id]);
$sonuc = $sorgu->fetch();
if ($_POST){
    $aktif=0;
    if (isset($_POST["aktif"])) $aktif=1;
    $hata='';
    $kfoto='';
    $bfoto='';
    if ( $_FILES["kucukfoto"]['name'] !='' && $_FILES["buyukfoto"]['name'] !=''  ){
        if ($_FILES["kucukfoto"]['error']!=0 && $_FILES["buyukfoto"]['error'] !='' ){
            $hata.='Dosya yüklemede Hata Gerçekleşti';
        }
        elseif (file_exists("../assets/img/portfolio/".strtolower($_FILES["kucukfoto"]['name'])) && file_exists("../assets/img/portfolio/".strtolower($_FILES["buyukfoto"]['name']))){
            $hata.='Aynı Dosyadan Mevcut';
        }
        elseif ($_FILES["kucukfoto"]['size']>(1024*1024*3) && $_FILES["buyukfoto"]['size']>(1024*1024*3) ){
            $hata.='Dosya Boyutu 3mb Fazla Olamaz';
        }
        if ($hata){
            echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script>Swal.fire({title:'Hata',text:'$hata',icon:'error',confirmButtonText:'Kapat' })</script>";
        }
    }
    else{
        $kfoto=$sonuc["kucukfoto"];
        $bfoto=$sonuc["buyukfoto"];
    }
    if ($_POST["sirala"] !='' && $hata==''){
        $sorgu2=$baglanti->prepare("update portfolyalar set aktif=:aktif,baslik=:baslik,tarih=:tarih,kucukfoto=:kucukfoto,buyukfoto=:buyukfoto,client=:client,aciklama=:aciklama,icerik=:icerik,kategori=:kategori,sirala=:sirala where id=:id");
        $guncelle=$sorgu2->execute([
            'aktif'=>$aktif,
            'kucukfoto'=>$kfoto,
            'sirala'=>$_POST["sirala"],
            'client'=>$_POST["client"],
            'aciklama'=>$_POST["aciklama"],
            'icerik'=>$_POST["icerik"],
            'baslik'=>$_POST["baslik"],
            'kategori'=>$_POST["kategori"],
            'tarih'=>$_POST["tarih"],
            'buyukfoto'=>$bfoto,
            'id'=>$id
        ]);
        if ($guncelle){
            echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script>Swal.fire({title:'Başarılı',text:'Güncelleme Başarılı',icon:'success',confirmButtonText:'Kapat' }).then((value)=>{
            if (value.isConfirmed){
                window.location.href='portfolyolar.php'}}) </script>";
        }
    }
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Ürün Guncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Gösterge Paneli</li>
            <li class="breadcrumb-item active">Ürün Guncelle</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
            </div>
            <div class="card-body">
                <form action=""method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Küçük Fotoğraf</label>
                        <img src="../assets/img/portfolio/<?= $sonuc["kucukfoto"]?>" alt="">
                        <input type="file" name="kucukfoto" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Büyük Fotoğraf</label>
                        <img src="../assets/img/portfolio/<?= $sonuc["buyukfoto"]?>" alt="">
                        <input type="file" name="buyukfoto" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" required name="baslik" class="form-control" value="<?= $sonuc["baslik"]?>">
                    </div>
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" required name="icerik" class="form-control" value="<?= $sonuc["icerik"]?>">
                    </div>
                    <div class="form-group">
                        <label>Açıklama</label>
                        <input type="text" required name="aciklama" class="form-control" value="<?= $sonuc["aciklama"]?>">
                    </div>
                    <div class="form-group">
                        <label>Kategori</label>
                        <input type="text" required name="kategori" class="form-control" value="<?= $sonuc["kategori"]?>">
                    </div>
                    <div class="form-group">
                        <label>Tarih</label>
                        <input type="text" required name="tarih" class="form-control" value="<?= $sonuc["tarih"]?>">
                    </div>
                    <div class="form-group">
                        <label>Client</label>
                        <input type="text" required name="client" class="form-control" value="<?= $sonuc["client"]?>">
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

