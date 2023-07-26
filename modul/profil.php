<?php
require_once("header.php"); // Header dosyasını dahil ediyoruz
require_once("../islemler/baglan.php"); // Veritabanı bağlantı dosyasını dahil ediyoruz
?>

<!-- Profil Düzenleme İşlemi -->
<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['profil_duzenle'])) {
    // Profil düzenleme formu verilerini alalım
    $ad = $_POST['ad'];
    $soyad = $_POST['soyad'];
    $hakkimda = $_POST['hakkimda'];
    $sirket = $_POST['sirket'];
    $meslek = $_POST['meslek'];
    $ulke = $_POST['ulke'];
    $sehir = $_POST['sehir'];
    $adres = $_POST['adres'];
    $telefon = $_POST['telefon'];
    $email = $_POST['email'];
    $twitter = $_POST['twitter'];
    $facebook = $_POST['facebook'];
    $instagram = $_POST['instagram'];
    $linkedin = $_POST['linkedin'];
    
    // Kullanıcı ID'sini alalım
    $kullaniciId = $_SESSION['kul_id'];
    
    // Profil düzenleme sorgusunu hazırlayalım
    $sql = "UPDATE kullanicilar SET kul_isim = :ad, kul_soyad = :soyad, hakkimda = :hakkimda, sirket = :sirket, meslek = :meslek, kul_ulke = :ulke, kul_sehir = :sehir, adres = :adres, kul_telefon = :telefon, kul_mail = :email, twitter = :twitter, facebook = :facebook, instagram = :instagram, linkedin = :linkedin WHERE kul_id = :kullaniciId";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':ad', $ad);
    $stmt->bindValue(':soyad', $soyad);
    $stmt->bindValue(':hakkimda', $hakkimda);
    $stmt->bindValue(':sirket', $sirket);
    $stmt->bindValue(':meslek', $meslek);
    $stmt->bindValue(':ulke', $ulke);
    $stmt->bindValue(':sehir', $sehir);
    $stmt->bindValue(':adres', $adres);
    $stmt->bindValue(':telefon', $telefon);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':twitter', $twitter);
    $stmt->bindValue(':facebook', $facebook);
    $stmt->bindValue(':instagram', $instagram);
    $stmt->bindValue(':linkedin', $linkedin);
    $stmt->bindValue(':kullaniciId', $kullaniciId);
    
    // Sorguyu çalıştıralım
    if ($stmt->execute()) {
        echo "Profil başarıyla güncellendi.";
    } else {
        echo "Profil güncelleme hatası.";
    }
}

// Şifre Değiştirme İşlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['sifre_degistir'])) {
    // Şifre değiştirme formu verilerini alalım
    $eskiSifre = $_POST['eski_sifre'];
    $yeniSifre = $_POST['yeni_sifre'];
    $yeniSifreTekrar = $_POST['yeni_sifre_tekrar'];
    
    // Kullanıcı ID'sini alalım
    $kullaniciId = $_SESSION['kul_id'];
    
    // Kullanıcının mevcut şifresini veritabanından alalım
    $sql = "SELECT kul_sifre FROM kullanicilar WHERE kul_id = :kullaniciId";
    $stmt = $conn->prepare($sql);
    $stmt->bindValue(':kullaniciId', $kullaniciId);
    $stmt->execute();
    $kullanici = $stmt->fetch(PDO::FETCH_ASSOC);
    
    // Mevcut şifreyi doğrulayalım
    if (password_verify($eskiSifre, $kullanici['kul_sifre'])) {
        // Yeni şifreleri kontrol edelim
        if ($yeniSifre === $yeniSifreTekrar) {
            // Yeni şifreyi hashleyelim
            $yeniSifreHash = password_hash($yeniSifre, PASSWORD_DEFAULT);
            
            // Şifre güncelleme sorgusunu hazırlayalım
            $sql = "UPDATE kullanicilar SET kul_sifre = :yeniSifre WHERE kul_id = :kullaniciId";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':yeniSifre', $yeniSifreHash);
            $stmt->bindValue(':kullaniciId', $kullaniciId);
            
            // Sorguyu çalıştıralım
            if ($stmt->execute()) {
                echo "Şifre başarıyla değiştirildi.";
            } else {
                echo "Şifre değiştirme hatası.";
            }
        } else {
            echo "Yeni şifreler uyuşmuyor.";
        }
    } else {
        echo "Mevcut şifre yanlış.";
    }
}

// Profil Fotoğrafı Yükleme İşlemi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['profil_fotografi'])) {
    // Dosya yükleme işlemini kontrol edelim
    if ($_FILES['profil_fotografi']['error'] === 0) {
        $profilFotoDosya = $_FILES['profil_fotografi']['tmp_name'];
        $hedefDizin = 'profilfoto/';
        $hedefDosya = $hedefDizin . basename($_FILES['profil_fotografi']['name']);
        if (move_uploaded_file($profilFotoDosya, $hedefDosya)) {
            echo "<br>"."Profil fotoğrafı başarıyla yüklendi.";
            
            // Profil fotoğrafının adını veritabanına kaydedelim
            $profilFotoAdi = basename($_FILES['profil_fotografi']['name']);
            $kullaniciId = $_SESSION['kul_id'];
            
            $sql = "UPDATE kullanicilar SET profil_fotografi = :profilFotoAdi WHERE kul_id = :kullaniciId";
            $stmt = $conn->prepare($sql);
            $stmt->bindValue(':profilFotoAdi', $profilFotoAdi);
            $stmt->bindValue(':kullaniciId', $kullaniciId);
            
            if ($stmt->execute()) {
                //echo "Profil fotoğrafı veritabanına kaydedildi.";
            } else {
                echo "Profil fotoğrafı kaydetme hatası.";
            }
        } else {
            echo "Profil fotoğrafı yükleme hatası.";
        }
    }
}
?>
  <div class="pagetitle">
      <h1>Profil</h1>

    </div>

<!-- End Page Title -->

    <section class="section profile">
      <div class="row">
        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

                <?php
                // Profil detayları için sorguyu yapalım ve $kullanicilar dizisini oluşturalım
                $sql = "SELECT * FROM kullanicilar";
                $stmt = $conn->prepare($sql);
                $stmt->execute();
                $kullanicilar = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <?php foreach ($kullanicilar as $kullanici): ?>
        <div class="mt-3">
            <?php showProfilePhoto($kullanici['profil_fotografi']); ?>
           
        </div>
    <?php endforeach; ?>
              <h2><?php echo $_SESSION['kul_isim']; ?></h2>
              <h3>Web Designer</h3>

              <div class="social-links mt-2">
                <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
              </div>
            </div>
          </div>

        </div>

        <div class="col-xl-8">

          <div class="card">
            <div class="card-body pt-3">
              <!-- Bordered Tabs -->
             <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" data-bs-toggle="tab" href="#profil-detaylari">Profil Detayları</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#profil-duzenle">Profil Düzenle</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#ayarlar">Ayarlar</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" href="#sifre-degistir">Şifre Değiştir</a>
        </li>
    </ul>
              <div class="tab-content mt-4">
        <div class="tab-pane fade show active" id="profil-detaylari">
  <h5 class="card-title">Hakkında</h5>
  

  <h5 class="card-title">Profile Detayları</h5>
<?php
$sql = "SELECT * FROM kullanicilar";
$stmt = $conn->prepare($sql);
$stmt->execute();
$kullanicilar = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<?php foreach ($kullanicilar as $kullanici): ?>
        <div class="mt-3">
            <?php if (isset($kullanici['profil_fotografi'])): ?>
                
            <?php endif; ?>
            <p>Ad: <?php echo $kullanici['kul_isim']; ?></p>
            <p>Soyad: <?php echo $kullanici['kul_soyad']; ?></p> 
            <p>Hakkımda: <?php echo $kullanici['hakkimda']; ?></p>          
            <p>Şirket: <?php echo $kullanici['sirket']; ?></p>
            <p>Meslek: <?php echo $kullanici['meslek']; ?></p>
            <p>Ülke: <?php echo $kullanici['kul_ulke']; ?></p>
            <p>Şehir: <?php echo $kullanici['kul_sehir']; ?></p>
            <p>Adres: <?php echo $kullanici['adres']; ?></p>
            <p>Telefon: <?php echo $kullanici['kul_telefon']; ?></p>
            <p>Email: <?php echo $kullanici['kul_mail']; ?></p>
            <p>Twitter Profil: <?php echo $kullanici['twitter']; ?></p>
            <p>Facebook Profil: <?php echo $kullanici['facebook']; ?></p>
            <p>Instagram Profil: <?php echo $kullanici['instagram']; ?></p>
            <p>Linkedin Profil: <?php echo $kullanici['linkedin']; ?></p>
        </div>
    <?php endforeach; ?>

<?php //fotografı başka yerde göstermek için fonksiyon oluuşturdum mk :)
function showProfilePhoto($photoPath) {
    if (isset($photoPath)) {
        echo '<p><img src="profilfoto/' . $photoPath . '" alt="Profil Fotoğrafı" style="max-width: 300px;"></p>';
    }
}
?>

</div>


                <!-- Profil detay -->

                <div class="tab-pane fade" id="profil-duzenle">

                  <!-- Profile Edit Form -->
                   
                  <form method="POST" enctype="multipart/form-data">
                <div class="mb-3">
                    <label for="profil_fotografi" class="form-label">Profil Fotoğrafı</label>
                    <input type="file" class="form-control" id="profil_fotografi" name="profil_fotografi">
                </div>
                <div class="mb-3">
                    <label for="ad" class="form-label">Ad</label>
                    <input type="text" class="form-control" id="ad" name="ad" value="<?php echo $kullanici['kul_isim']; ?>">
                </div>
                <div class="mb-3">
                    <label for="soyad" class="form-label">Soyad</label>
                    <input type="text" class="form-control" id="soyad" name="soyad" value="<?php echo $kullanici['kul_soyad']; ?>">
                </div>
                <div class="mb-3">
                    <label for="hakkimda" class="form-label">Hakkında</label>
                    <textarea class="form-control" id="hakkimda" name="hakkimda"><?php echo $kullanici['hakkimda']; ?></textarea>
                </div>
                <div class="mb-3">
                    <label for="sirket" class="form-label">Şirket</label>
                    <input type="text" class="form-control" id="sirket" name="sirket" value="<?php echo $kullanici['sirket']; ?>">
                </div>
                <div class="mb-3">
                    <label for="meslek" class="form-label">Meslek</label>
                    <input type="text" class="form-control" id="meslek" name="meslek" value="<?php echo $kullanici['meslek']; ?>">
                </div>
                <div class="mb-3">
                    <label for="ulke" class="form-label">Ülke</label>
                    <input type="text" class="form-control" id="ulke" name="ulke" value="<?php echo $kullanici['kul_ulke']; ?>">
                </div>
                <div class="mb-3">
                    <label for="sehir" class="form-label">Şehir</label>
                    <input type="text" class="form-control" id="sehir" name="sehir" value="<?php echo $kullanici['kul_sehir']; ?>">
                </div>
                <div class="mb-3">
                    <label for="adres" class="form-label">Adres</label>
                    <input type="text" class="form-control" id="adres" name="adres" value="<?php echo $kullanici['adres']; ?>">
                </div>
                <div class="mb-3">
                    <label for="telefon" class="form-label">Telefon</label>
                    <input type="text" class="form-control" id="telefon" name="telefon" value="<?php echo $kullanici['kul_telefon']; ?>">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $kullanici['kul_mail']; ?>">
                </div>
                <div class="mb-3">
                    <label for="twitter" class="form-label">Twitter Profil</label>
                    <input type="text" class="form-control" id="twitter" name="twitter" value="<?php echo $kullanici['twitter']; ?>">
                </div>
                <div class="mb-3">
                    <label for="facebook" class="form-label">Facebook Profil</label>
                    <input type="text" class="form-control" id="facebook" name="facebook" value="<?php echo $kullanici['facebook']; ?>">
                </div>
                <div class="mb-3">
                    <label for="instagram" class="form-label">Instagram Profil</label>
                    <input type="text" class="form-control" id="instagram" name="instagram" value="<?php echo $kullanici['instagram']; ?>">
                </div>
                <div class="mb-3">
                    <label for="linkedin" class="form-label">Linkedin Profil</label>
                    <input type="text" class="form-control" id="linkedin" name="linkedin" value="<?php echo $kullanici['linkedin']; ?>">
                </div>
                <button type="submit" class="btn btn-primary" name="profil_duzenle">Değişiklikleri Kaydet</button>
            </form>


                  <!-- End Profile Edit Form -->

                </div>

                <div class="tab-pane fade" id="ayarlar">
            <h3>Ayarlar</h3>
            <!-- Ayarlar İçeriği -->
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="ozellik" name="ozellik">
                <label class="form-check-label" for="ozellik">Özellik</label>
            </div>
        </div>
       
 <div class="tab-pane fade" id="sifre-degistir">
            <h3>Şifre Değiştir</h3>
           
            <form method="POST">
                <div class="mb-3">
                    <label for="eski_sifre" class="form-label">Eski Şifre</label>
                    <input type="password" class="form-control" id="eski_sifre" name="eski_sifre">
                </div>
                <div class="mb-3">
                    <label for="yeni_sifre" class="form-label">Yeni Şifre</label>
                    <input type="password" class="form-control" id="yeni_sifre" name="yeni_sifre">
                </div>
                <div class="mb-3">
                    <label for="yeni_sifre_tekrar" class="form-label">Yeni Şifre Tekrar</label>
                    <input type="password" class="form-control" id="yeni_sifre_tekrar" name="yeni_sifre_tekrar">
                </div>
                <button type="submit" class="btn btn-primary" name="sifre_degistir">Şifreyi Değiştir</button>
            </form>
        </div>

                  <!-- End settings Form -->

                </div>

                

              </div><!-- End Bordered Tabs -->

            </div>
          </div>

        </div>
      </div>
    
    

 <?php require_once "footer.php";?>
