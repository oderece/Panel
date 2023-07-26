<?php require_once 'header.php'; ?>





  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">
<!-- page content -->

  <div class="">

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>KARt numaratör <small> -</small></h2>

            <!-- Div İçerik Başlangıç -->

            <form action="karttip2.php" method="post">
        <label for="sabit_baslangic_1">İlk Dörtlük:</label><br>
        <input type="text" id="sabit_baslangic_1" name="sabit_baslangic_1" value="3200"><br>
        <label for="sabit_baslangic_2">İkinci Dörtlük:</label><br>
        <input type="text" id="sabit_baslangic_2" name="sabit_baslangic_2" value="1000"><br>
        <label for="kart_sayisi">Kart Sayısı:</label><br>
        <input type="number" id="kart_sayisi" name="kart_sayisi" value="33000"><br>
        <label for="son_iki_dortluk">Son İki Dörtlük 4 Haneli Olsun:</label><br>
        <input type="checkbox" id="son_iki_dortluk" name="son_iki_dortluk" value="1"><br>
        <input type="submit" value="CSV Oluştur">
    </form>

            <!-- Div İçerik Bitişi -->


          </div>
        </div>
      </div>
    </div>




  </div>
</div>
<!-- /page content -->

<?php require_once 'footer.php'; ?>
