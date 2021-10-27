<?php
$sayfa="Tarihçe";
include("incl/adminhead.php");
if ($_SESSION["yetki"]!="1"){
    echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
        echo "<script>Swal.fire({title:'Hata!',text:'Yetkisiz Kullanıcı !',icon:'error',confirmButtonText:'Kapat' }).then((value)=>{
    if (value.isConfirmed){
        window.location.href='tarihi.php'}}) </script>";
        exit();
    }
if ($_POST){
    $hata='';
    if ($_POST["tarih"] !='' && $_POST["baslik"] !='' && $_POST["icerik"] !='' && $_FILES["fotograf"]['name'] !=''){
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
            $sorgu2=$baglanti->prepare("insert into tarihi set fotograf=:fotograf,icerik=:icerik,baslik=:baslik,tarih=:tarih");
            $ekle=$sorgu2->execute([
                    'fotograf'=>strtolower($_FILES["fotograf"]['name']),
                    'icerik'=>$_POST["icerik"],
                    'baslik'=>$_POST["baslik"],
                    'tarih'=>$_POST["tarih"]
            ]);
            if ($ekle){
                echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
                echo "<script>Swal.fire({title:'Başarılı',text:'Ekleme Başarılı',icon:'success',confirmButtonText:'Kapat' }).then((value)=>{
            if (value.isConfirmed){
                window.location.href='tarihi.php'}}) </script>";
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
        <h1 class="mt-4">Tarihçe Ekle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Gösterge Paneli</li>
            <li class="breadcrumb-item active">Tarihçe Ekle</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action=""method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Fotoğraf</label>
                        <input type="file" required name="fotograf" class="form-control-file">
                    </div>
                    <div class="form-group">
                        <label>Tarih</label>
                        <input type="text" required name="tarih" class="form-control" value="<?= @$_POST["tarih"]?>">
                    </div>
                    <div class="form-group">
                        <label>Başlık</label>
                        <input type="text" required name="baslik" class="form-control" value="<?= @$_POST["baslik"]?>">
                    </div>
                    <div class="form-group">
                        <script src="js/ckeditor5/ckeditor.js"></script>
                        <label>İçerik</label>
                        <textarea name="icerik" id="icerik"><?= @$_POST["icerik"]?></textarea>
                        <script>
                            ClassicEditor
                                .create( document.querySelector( '#icerik' ) )
                                .then( editor => {
                                    console.log( editor );
                                } )
                                .catch( error => {
                                    console.error( error );
                                } );
                        </script>
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

