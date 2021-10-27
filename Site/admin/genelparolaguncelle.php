<?php
$sayfa="Kullanıcılar";
include("incl/adminhead.php");
if ($_POST) {

    if ($_POST["parola"] !='' && $_POST["yeniparola"]!='') {
        $sorgu = $baglanti->prepare("select parola from kullanici where kadi=:kadi");
        $sorgu->execute(['kadi'=>$_SESSION['kadi']]);
        $sonuc = $sorgu->fetch();
        if ($_POST["tekrarparola"] == $_POST["yeniparola"]) {
            $sorgu2 = $baglanti->prepare("update kullanici set parola=:parola WHERE kadi=:kadi");
            $guncelle = $sorgu2->execute([
                'parola' => $_POST['yeniparola'],
                'kadi' => $_SESSION['kadi']
            ]);
            if ($guncelle) {
                echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
                echo "<script>Swal.fire({title:'Başarılı',text:'Güncelleme Başarılı',icon:'success',confirmButtonText:'Kapat' })</script>";
            } else {
                echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
                echo "<script>Swal.fire({title:'Hata',text:'Guncelleme Başarısız',icon:'error',confirmButtonText:'Kapat' })</script>";
            }
        }

    } else {
        echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
        echo "<script>Swal.fire({title:'Hata',text:'Eksik Veri',icon:'error',confirmButtonText:'Kapat' })</script>";
    }
}
?>
<main>
    <div class="container-fluid">
        <h1 class="mt-4">Kullanıcı Parola Guncelle</h1>
        <ol class="breadcrumb mb-4">
            <li class="breadcrumb-item active">Gösterge Paneli</li>
            <li class="breadcrumb-item active">Kullanıcı Parola Guncelle</li>
        </ol>
        <div class="card mb-4">
            <div class="card-header">
                <i class="fas fa-table mr-1"></i>

            </div>
            <div class="card-body">
                <form action=""method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Eski Parola</label>
                        <input type="password" required name="parola" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Yeni Parola</label>
                        <input type="password" required name="yeniparola" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Yeni Parola Tekrar</label>
                        <input type="password" required name="tekrarparola" class="form-control">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Değiştir" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>
<?php
include("incl/adminfooter.php");
?>

