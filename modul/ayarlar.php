<?php require_once "header.php";



?>
    <div class="pagetitle">      

    </div><!-- End Page Title -->
 <link href="../assets/css/style.css" rel="stylesheet">

    <section class="section">
    <div class="card-body">
    <div class="card-header" class="mb-3"><h3>Sayfa Ayarları</h3></div>	
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              

              <!-- General Form Elements -->
              
              <form action="../islemler/ajax.php" method="POST" accept-charset="utf-8" class="col-md-12" enctype="multipart/form-data">
              	 <div class="row mb-3">
                  <label for="inputNumber" class="col-sm-1 col-form-label">Site logo</label>
                  <div class="col-sm-10">
                    <input class="form-control" type="file" name="site_logo" >
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-1 col-form-label">Site Başlık</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_baslik" value="<?php echo $ayarcek['site_baslik'];  ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputText" class="col-sm-1 col-form-label">Site Açıklama</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_aciklama" value="<?php echo $ayarcek['site_aciklama'];  ?>">
                  </div>
                </div>
                 <div class="row mb-3">
                  <label for="inputText" class="col-sm-1 col-form-label">Site Link</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_link" value="<?php echo $ayarcek['site_link'];  ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-1 col-form-label">Site Sahibinin  Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="site_sahip_mail" value="<?php echo $ayarcek['site_sahip_mail'];  ?>">
                  </div>
                </div>
                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-1 col-form-label">Mail Host Adresi</label>
                  <div class="col-sm-5">
                    <input type="text" class="form-control" name="site_mail_host" value="<?php echo $ayarcek['site_mail_host'];  ?>">
                  </div>
                  <label for="inputEmail" class="col-sm-1 col-form-label">Mail Adresi</label>
                  <div class="col-sm-4">
                    <input type="email" class="form-control" name="site_mail_mail" value="<?php echo $ayarcek['site_mail_mail'];  ?>">
                  </div>
                </div>
                 <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-1 col-form-label">Mail Port</label>
                  <div class="col-sm-5">
                    <input type="inputNumber" class="form-control" name="site_mail_port" value="<?php echo $ayarcek['site_mail_port'];  ?>">
                  </div>
                  <label for="inputNumber" class="col-sm-1 col-form-label">Mail Şifre</label>
                  <div class="col-sm-4">
                    <input type="inputNumber" class="form-control" name="site_mail_sifre" value="<?php echo $ayarcek['site_mail_sifre'];  ?>">
                  </div>
                </div>
               </div>

               <div class="row mb-3 text-center">
                  
                  <div class="col-md-12">
                    <button type="submit"class="btn btn-primary col-md-10" name="ayarkaydet">Kaydet</button>
                  </div>

                </div>

              </form>
               

            </div>

          </div>

        </div>

        
      </div>

    </section>

 

             
<?php require_once "footer.php";?>