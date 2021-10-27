<?php
$sayfa="Ana Sayfa";
include("incl/adminhead.php");
if ($_SESSION["yetki"]!="1"){
    echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
        echo "<script>Swal.fire({title:'Hata!',text:'Yetkisiz Kullanıcı !',icon:'error',confirmButtonText:'Kapat' }).then((value)=>{
    if (value.isConfirmed){
        window.location.href='index.php'}}) </script>";
        exit();
    }
if ($_GET)
{
    $tablo=$_GET["tablo"];
    $id=(int)$_GET["id"];
    $sorgusil=$baglanti->prepare("Delete from $tablo where id=:id");
    $sil=$sorgusil->execute(["id"=>$id]);
    if ($sil){
        echo '<script type="text/javascript" src="../js/sweetalert2.all.min.js"></script>';
        echo "<script>Swal.fire({title:'BAŞARILI!',text:'Silme Başarılı !',icon:'success',confirmButtonText:'Kapat' }).then((value)=>{
        if (value.isConfirmed){
        window.location.href='$tablo.php'}}) </script>";
        exit();
    }
}

include("incl/adminfooter.php");
?>
