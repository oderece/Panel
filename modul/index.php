<?php require_once "header.php";?>


<head>
  <!-- ... -->
  <!-- CSS only -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">

  <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0c3b1f3e9d28a8d72279b8f4c3879b3fdeb2a36e9b7a887aa9f8a13cf280559b" crossorigin="anonymous">
  <!-- JavaScript Bundle with Popper -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js" integrity="sha384-4mXqP4ZnRzvFKzuvfLH4EQJmGCbXwNfLgsY60BRwagwyPlB+woIftimldYwoC2C0" crossorigin="anonymous"></script>
</head>
           <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header d-md-flex border-bottom-0">
                    <div class="flex-grow-1">
                      <a href="https://dashui.codescandy.com/dashuipro/pages/ecommerce-products.html#!" class="btn btn-primary">+ Add Product</a>
                    </div>
                    <div class="mt-3 mt-md-0">
                      <a href="https://dashui.codescandy.com/dashuipro/pages/ecommerce-products.html#!" class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip" data-template="settingOne">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-settings icon-xs"><circle cx="12" cy="12" r="3"></circle><path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path></svg>
                        <div id="settingOne" class="d-none">
                          <span>Ayarlar</span>
                        </div>
                      </a>

                      <a href="https://dashui.codescandy.com/dashuipro/pages/ecommerce-products.html#!" class="btn btn-outline-white ms-2">Yükle</a>
                      <a href="https://dashui.codescandy.com/dashuipro/pages/ecommerce-products.html#!" class="btn btn-outline-white ms-2">Çıkart</a>
                    </div>
                  </div>
<table class="table table-bordered table-striped table-hover">
  <thead>
    <tr>
      <th scope="col">Ürün Adı</th>
      <th scope="col">Kategori</th>
      <th scope="col">Eklenme Tarihi</th>
      <th scope="col">Fiyat</th>
      <th scope="col">Adet</th>
      <th scope="col">Durum</th>
      <th scope="col">İşlem</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Kalem</td>
      <td>Kırtasiye</td>
      <td>01.01.2023</td>
      <td>1 TL</td>
      <td>100</td>
      <td><span class="badge badge-success-soft">Aktif</span></td>
      <td><button class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip">Düzenle</button> <button class="btn btn-ghost btn-icon btn-sm rounded-circle texttooltip">Sil</button></td>
    </tr>
    <!-- Diğer ürünler için aynı şekilde devam edin -->
  </tbody>
</table>

<style type="text/css">.table thead th {
  background-color: purple;
  color: white;
}
</style>

 

             
<?php require_once "footer.php";?>