<?php
if ($_POST) { //post var mı diye bakıyoruz
    include("../../dbv.php"); //veri tabanına bağlanıyoruz

    //değişkenleri integer olarak alıyoruz
    $id = (int)$_POST['id'];
    $durum = (int)$_POST['durum'];
    $tablo =$_POST['tablo'];

    //Güncellme sorgumuzu yazıyoruz
    $sorgu = $baglanti->query("UPDATE $tablo SET aktif=$durum WHERE  id=$id");

    //gerekli ise geriye değer döndürüyoruz
    echo $id . " nolu kayıt değiştirildi";
}
?>