<?php require_once "header.php"; ?>

<div class="container">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3 class="mb-4">Fotoğraf Yükleme</h3>
            
            <form action="" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="photo">Fotoğraf Seçin</label>
                    <div class="custom-file">
                        <input type="file" name="photo" id="photo" accept=".jpg, .jpeg, .png, .webp" class="custom-file-input">
                        <label class="custom-file-label" for="photo">Dosya Seçin</label>
                    </div>
                    <small class="form-text text-muted">Yalnızca JPG, JPEG, PNG ve WebP formatlarını destekler.</small>
                </div>
                <button type="submit" class="btn btn-primary">Yükle</button>
            </form>
            
            <?php
            // Veritabanı bağlantı bilgilerini al
            require_once "../islemler/baglan.php";
            
// Form gönderildiğinde çalışacak kod
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Dosyanın geçerli bir resim olduğunu kontrol et
    if (isset($_FILES['photo']) && $_FILES['photo']['error'] === UPLOAD_ERR_OK) {
        $tmpName = $_FILES['photo']['tmp_name'];
        $fileName = $_FILES['photo']['name'];
        $fileSize = $_FILES['photo']['size'];

        // Dosya boyutunu kontrol et (maksimum 5MB)
        if ($fileSize > 5 * 1024 * 1024) {
            echo '<div class="alert alert-danger mt-3">Dosya boyutu çok büyük. Maksimum 5MB olmalıdır.</div>';
            exit;
        }

        // Dosya uzantısını kontrol et
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        if (!in_array($fileExtension, $allowedExtensions)) {
            echo '<div class="alert alert-danger mt-3">Desteklenmeyen dosya formatı. Yalnızca JPG, JPEG, PNG ve WebP formatlarını destekler.</div>';
            exit;
        }

        // Resmi siyah beyaza çevirme işlemi
        if ($fileExtension === 'webp') {
            $image = imagecreatefromwebp($tmpName);
        } elseif ($fileExtension === 'png') {
            $image = imagecreatefrompng($tmpName);
        } else {
            $image = imagecreatefromjpeg($tmpName);
        }
        
        if ($image === false) {
            echo '<div class="alert alert-danger mt-3">Geçersiz bir resim dosyası yüklendi.</div>';
            exit;
        }

        imagefilter($image, IMG_FILTER_GRAYSCALE);

        // Çıktı dosyası için benzersiz bir ad oluştur
        $outputFile = uniqid('siyahbeyaz_', true) . '.' . $fileExtension;

        // WebP formatı için özel işlem
        if ($fileExtension === 'webp') {
            imagewebp($image, 'siyahbeyaz/' . $outputFile);
        } else {
            // Diğer formatlar için standart işlem
            imagejpeg($image, 'siyahbeyaz/' . $outputFile);
        }

        // Veritabanına dosya adını kaydet
        $dosyaAdi = 'siyahbeyaz/' . $outputFile;
        $sql = "INSERT INTO fotograf (dosya_ad) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->execute([$dosyaAdi]);

        // Belleği temizle
        imagedestroy($image);
    } else {
        echo '<div class="alert alert-danger mt-3">Geçerli bir resim dosyası yükleyin.</div>';
    }
}
            ?>
            
            <h3 class="mt-5">Siyah Beyaz Dönüşümü Yapılan Fotoğraflar</h3>
            
            <div class="row mt-4 gallery">
    <?php
    // Siyah beyaz dönüşümü yapılan fotoğrafları sorgula
    $sql = "SELECT * FROM fotograf ORDER BY id DESC LIMIT 50";
    $stmt = $conn->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if ($result) {
        foreach ($result as $row) {
            $dosyaAdi = $row['dosya_ad'];
            
            // Fotoğrafın tam yolu
            $dosyaYolu = $dosyaAdi;
            
            echo '<div class="col-md-4 mb-4">';
            echo '<a href="' . $dosyaYolu . '" data-caption="Siyah Beyaz Fotoğraf ' . $row['id'] . '">';
            echo '<div class="card">';
            echo '<img src="' . $dosyaYolu . '" alt="Siyah Beyaz Fotoğraf" class="card-img-top">';
            echo '<div class="card-body">';
            echo '<h5 class="card-title">Fotoğraf ' . $row['id'] . '</h5>';
            echo '<form action="" method="post" class="delete-form">';
            echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';
            echo '</a>';
            echo '<button type="submit" class="btn btn-danger btn-sm">Sil</button>';
            echo '</form>';
            echo '</div>';
            echo '</div>';            
            echo '</div>';
        }
    } else {
        echo '<div class="col-md-12"><p class="text-center">Henüz siyah beyaz dönüşümü yapılan fotoğraf yok.</p></div>';
    }
    ?>
</div>

            
        </div>
    </div>
</div>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_id'])) {
    $deleteID = $_POST['delete_id'];
    
    // Fotoğrafı veritabanından sil
    $sql = "DELETE FROM fotograf WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->execute([$deleteID]);
    
    // Silme işlemi tamamlandıktan sonra sayfayı yeniden yükle
    header("Location: foto.php");
    exit;
}
?>

<?php require_once "footer.php"; ?>
