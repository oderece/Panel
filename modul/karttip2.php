<?php
// Formdan gelen verileri alın.
$sabit_baslangic_1 = $_POST['sabit_baslangic_1'];
$sabit_baslangic_2 = $_POST['sabit_baslangic_2'];
$kart_sayisi = $_POST['kart_sayisi'];
$son_iki_dortluk = isset($_POST['son_iki_dortluk']) ? $_POST['son_iki_dortluk'] : 0;

// İki dörtlüğü birleştirin.
$sabit_baslangic = $sabit_baslangic_1 . ' ' . $sabit_baslangic_2;

// HTTP başlıklarını ayarlayın.
header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="kart_numaralari.csv"');

// CSV çıktısını oluşturun.
$output = fopen('php://output', 'w');

// Belirlenen kart sayısı kadar numaraları al.
for ($i = 1; $i <= $kart_sayisi; $i++) {
    if ($son_iki_dortluk == 1) {
        // Numarayı 8 haneli bir string haline getirin.
        $numara = str_pad($i, 8, "0", STR_PAD_LEFT);
        // Tüm numarayı oluşturun.
        $tam_numara = $sabit_baslangic . ' ' . substr($numara, 0, 4) . ' ' . substr($numara, 4, 4);
    } else {
        // Numarayı 5 haneli bir string haline getirin.
        $numara = str_pad($i, 5, "0", STR_PAD_LEFT);
        // Tüm numarayı oluşturun.
        $tam_numara = $sabit_baslangic . ' ' . substr($numara, 0, 4) . ' ' . substr($numara, 4, 1);
    }

    // CSV dosyasına satırı ekleyin.
    fputcsv($output, array($tam_numara));
}

// Dosyayı kapatın.
fclose($output);
?>
