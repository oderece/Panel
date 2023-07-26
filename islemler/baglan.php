
<?php 
header('Content-Type: text/html; charset=utf-8');

session_start();

$servername ="localhost";
$dbname="kursayarlar";
$username  ="root";
$password  ="";


try {

	$conn = new PDO("mysql:host=$servername;dbname=$dbname;","$username","$password");
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //echo "Bağlantı başarılı"; 
} catch(PDOException $e) {
    echo "Bağlantı hatası: " . $e->getMessage();
}
	
 ?>

<?php 
// ayarlar baglan sayfası veri çekme işleimi


//veritabanından veri çekme işlemi

  $sorgu=$conn->prepare("SELECT * FROM ayarlar");  //"prepare" de veri çekme için stadanrt kullanım şekli 
  $sorgu->execute();
  $ayarcek=$sorgu->fetch(PDO::FETCH_ASSOC); //buradaki  ayar degişkenide formdaki verileri çekme için kullanılacak
  
 ?>