<?php
$sayfa="Tarihçe";
include("incl/adminhead.php");
$sorgu = $baglanti->prepare("select * from tarihi where id=:id");
$sorgu->execute(['id'=>$_GET["id"]]);
$sonuc = $sorgu->fetch();
if ($_POST){
    $aktif=0;
    $hata='';
    $foto='';
    if ( $_FILES["fotograf"]['name'] !=''){
        if ($_FILES["fotograf"]['error']!=0){
            $hata.='Dosya yüklemede Hata Gerçekleşti';
        }
        elseif (file_exists("../assets/img/about/".strtolower($_FILES["fotograf"]['name']))){
            $hata.='Aynı Dosyadan Mevcut';
        }
        elseif ($_FILES["fotograf"]['size']>(1024*1024*3)){
            $hata.='Dosya Boyutu 3mb Fazla Olamaz';
        }
        else{
            copy($_FILES['fotograf']['tmp_name'],'../assets/img/about/'.strtolower($_FILES["fotograf"]['name']));
            unlink('../assets/img/about/'.$sonuc["fotograf"]);
            $foto=strtolower($_FILES["fotograf"]['name']);
        }
        if ($hata){
            echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script>Swal.fire({title:'Hata',text:'$hata',icon:'error',confirmButtonText:'Kapat' })</script>";
        }
    }
    else{
        $foto=$sonuc["fotograf"];
    }
    if ($hata==''){
        $sorgu2=$baglanti->prepare("update tarihi set tarih=:tarih,fotograf=:fotograf,baslik=:baslik,icerik=:icerik where id=:id");
        $guncelle=$sorgu2->execute([
            'tarih'=>$_POST["tarih"],
            'fotograf'=>$foto,
            'baslik'=>$_POST["baslik"],
            'icerik'=>$_POST["icerik"],
            'id'=>$_GET["id"]
        ]);
        if ($guncelle){
            echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
            echo "<script>Swal.fire({title:'Başarılı',text:'Güncelleme Başarılı',icon:'success',confirmButtonText:'Kapat' }).then((value)=>{
            if (value.isConfirmed){
                window.location.href='tarihi.php'}}) </script>";
        }
    }

}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Tarih Guncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Gösterge Paneli</li>
            <li class="breadcrumb-item active">Tarih Guncelle</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>
            </div>
            <div class="card-body">
                <form action=""method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Fotoğraf</label><br>
                        <img src="../assets/img/about/<?= $sonuc["fotograf"]?>" alt=""> <br><br>
                        <input type="file" name="fotograf" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Başıl</label>
                        <input type="text" required name="baslik" class="form-control" value="<?= $sonuc["baslik"]?>">
                    </div>
                    <div class="form-group">
                        <label>İçerik</label>
                        <input type="text" required name="icerik" class="form-control" value="<?= $sonuc["icerik"]?>">
                    </div>
                    <div class="form-group">
                        <label>Tarih</label>
                        <input type="text" required name="tarih" class="form-control" value="<?= $sonuc["tarih"]?>">
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

