<?php 
require_once 'baglan.php';



//ayarlar form güncelleme veritaban işlemleri

if (isset($_POST['ayarkaydet'])) {
	$sorgu=$conn->prepare("UPDATE ayarlar SET

		site_baslik=:site_baslik,
		site_aciklama=:site_aciklama,
		site_link=:site_link,
		site_sahip_mail=:site_sahip_mail,
		site_mail_host=:site_mail_host,
		site_mail_mail=:site_mail_mail,
		site_mail_port=:site_mail_port,
		site_mail_sifre=:site_mail_sifre WHERE id=1
		");

	$sonuc=$sorgu->execute(array(
		'site_baslik' =>$_POST['site_baslik'],
		'site_aciklama'=>$_POST['site_aciklama'],
		'site_link'=>$_POST['site_link'],
		'site_sahip_mail'=>$_POST['site_sahip_mail'],
		'site_mail_host'=>$_POST['site_mail_host'],
		'site_mail_mail'=>$_POST['site_mail_mail'],
		'site_mail_port'=>$_POST['site_mail_port'],
		'site_mail_sifre'=> $_POST['site_mail_sifre']
	));

// DOsya yükleme işlemi

if ($_FILES['site_logo']['error']=="0") {
	$gecici_isim=$_FILES['site_logo']['tmp_name'];
$dosya_ismi=rand(100000,999999).$_FILES['site_logo']['name'];
move_uploaded_file($gecici_isim,"../dosyalar/$dosya_ismi");

	$sorgu=$conn->prepare("UPDATE ayarlar SET

		site_logo=:site_logo WHERE id=1

		");

	$sonuc=$sorgu->execute(array(
		'site_logo' =>$dosya_ismi

	));
}


	if ($sonuc) {
	header("location:../modul/ayarlar.php?durum=ok");
		}
		else {
	 header("location:../modul/ayarlar.php?durum=ok");
		}
		exit;
}



if (isset($_POST['oturumac'])) {
    $sorgu = $conn->prepare("SELECT * FROM kullanicilar WHERE kul_mail=:kul_mail");
    $sorgu->execute(array(
        'kul_mail' => $_POST['kul_mail']
    ));

    $sonuc = $sorgu->fetch(PDO::FETCH_ASSOC);
    
    if ($sonuc && password_verify($_POST['kul_sifre'], $sonuc['kul_sifre'])) {
        $_SESSION['kul_isim'] = $sonuc['kul_isim'];
        $_SESSION['kul_mail'] = $sonuc['kul_mail'];
        $_SESSION['kul_id'] = $sonuc['kul_id'];

        header("location:../modul/index.php?durum=ok");
    } else {
        header("location:../modul/login.php?durum=no");
    }

    exit;
}


 

 ?>