<?php
require_once '../islemler/baglan.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isim = $_POST['isim'];
    $soyad = $_POST['soyad'];
    $email = $_POST['email'];
    $sifre = $_POST['sifre'];
    $sifre_tekrar = $_POST['sifre_tekrar'];
    $telefon = $_POST['telefon'];
    $ulke = $_POST['ulke'];
    $sehir = $_POST['sehir'];

    if ($sifre != $sifre_tekrar) {
        echo "Şifreler uyuşmuyor!";
        exit();
    }

    // Şifreyi hash'ler.
    $hashed_sifre = password_hash($sifre, PASSWORD_DEFAULT);

    try {
        $sql = "INSERT INTO kullanicilar (kul_isim, kul_soyad, kul_mail, kul_sifre, kul_telefon, kul_ulke, kul_sehir)
                VALUES (:isim, :soyad, :email, :sifre, :telefon, :ulke, :sehir)";
        $stmt= $conn->prepare($sql);
        $stmt->execute(['isim' => $isim, 'soyad' => $soyad, 'email' => $email, 'sifre' => $hashed_sifre, 'telefon' => $telefon, 'ulke' => $ulke, 'sehir' => $sehir]);
        echo "Kullanıcı başarıyla kaydedildi!";
        header('Location: login.php');
        exit();
    } catch(PDOException $e) {
        echo $sql . "<br>" . $e->getMessage();
    }
    $conn = null;
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title><?php echo $ayarcek['site_baslik']; ?></title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
<!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.11.0/baguetteBox.min.css">

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>
<body>

<!DOCTYPE html>
<html>
<head>
    <title>Üye Kaydı</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <main>
    <div class="container">

      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
            
            <div class="d-flex justify-content-center py-4">
                <a href="index.php" class="logo d-flex align-items-center w-auto">
                  <img src="../assets/img/logo.png" alt="">
                  <span class="d-none d-lg-block"><?php echo $ayarcek['site_aciklama']; ?></span>
                </a>
              </div>           
              <!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Giriş Yap</h5>
                    <p class="text-center small">Giriş yapmak için kullanıcı adınızı ve şifrenizi girin</p>
                  </div>

                  <form method="POST" action="register.php">
                                        <div class="form-row">
                                            <div class="form-group col">
                                                <label for="isim">İsim:</label>
                                                <input type="text" name="isim" id="isim" class="form-control" required>
                                            </div>
                                            <div class="form-group col">
                                                <label for="soyad">Soyad:</label>
                                                <input type="text" name="soyad" id="soyad" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="email">E-posta:</label>
                                            <input type="email" name="email" id="email" class="form-control" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="sifre">Şifre:</label>
                                                    <input type="password" name="sifre" id="sifre" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="sifre_tekrar">Şifre Tekrar:</label>
                                                    <input type="password" name="sifre_tekrar" id="sifre_tekrar" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="telefon">Telefon:</label>
                                            <input type="text" name="telefon" id="telefon" class="form-control" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="ulke">Ülke:</label>
                                                    <input type="text" name="ulke" id="ulke" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col">
                                                <div class="form-group">
                                                    <label for="sehir">Şehir:</label>
                                                    <input type="text" name="sehir" id="sehir" class="form-control" required>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between">
                                            <button type="submit" class="btn btn-primary">Kayıt Ol</button>
                                            <a href="javascript:history.go(-1)" class="btn btn-secondary">Geri Git</a>
                                        </div>
                                    </form>

                </div>
              </div>

              

            </div>
          </div>
        </div>

      </section>

    </div>
  </main>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


  <!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->

  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.min.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="../assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>

</body>

</html>
<?php
require_once 'footer.php';
?>
