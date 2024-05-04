<?php
require('koneksi.php');;
$queryKategori = mysqli_query($conn, "SELECT * FROM kategori");

if (isset($_GET['keyword'])) {
     $queryProduk = mysqli_query($conn, "SELECT * from produk WHERE nama LIKE '%$_GET[keyword]%'");
} elseif (isset($_GET['kategori'])) {
     $queryKategoriId = mysqli_query($conn, "SELECT id from kategori WHERE nama LIKE '%$_GET[kategori]%'");
     $kategoriId = mysqli_fetch_array($queryKategoriId);
     $queryProduk = mysqli_query($conn, "SELECT * from produk WHERE kategori_id='$kategoriId[id]'");
} else {
     $queryProduk = mysqli_query($conn, "SELECT * from produk");
}
$countProduct = mysqli_num_rows($queryProduk);
?>

<!DOCTYPE html>
<html lang="en">
</style>

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Toko Online | Produk</title>
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
     <link rel="stylesheet" href="css/style.css">

</head>

<body>
     <?php include('navbar.php') ?>
     <!-- banner -->
     <div class="container-fluid banner-produk d-flex align-items-center">
          <div class="container text-center text-white">
               <h1>Produk</h1>
          </div>
     </div>
     <!-- body -->
     <div class="container py-5">
          <div class="row">
               <div class="col-lg-3 mb-5">
                    <h3>Kategori</h3>
                    <ul class="list-group">
                         <?php while ($kategori = mysqli_fetch_array($queryKategori)) { ?>
                              <a href="produk.php?kategori=<?= $kategori['nama'] ?>">
                                   <li class="list-group-item"><?= $kategori['nama'] ?></li>
                              </a>
                         <?php } ?>
                    </ul>
               </div>
               <div class="col-lg-9">
                    <h3 class="text-center mb-3">Produk</h3>
                    <div class="row">
                         <?php if (!$countProduct) { ?>
                              <h5 class="text-center">Tidak ada barang yang tersedia</h5>
                         <?php } ?>
                         <?php while ($produk = mysqli_fetch_array($queryProduk)) {  ?>
                              <div class="col-lg-4 mb-3">
                                   <div class="card h-100">
                                        <div class="images-box">
                                             <img class="card-img-top" src="image/<?= $produk['foto'] ?>">
                                        </div>
                                        <div class="card-body">
                                             <h5 class="card-title"><?= $produk['nama'] ?></h5>
                                             <p class="card-text text-truncate"><?= $produk['detail'] ?></p>
                                             <p class="card-text font-weight-light">Rp. <?= $produk['harga'] ?></p>
                                             <a href="produk-detail.php?nama=<?= $produk['nama'] ?>" class="btn warna2 text-white">lihat Detail</a>
                                        </div>
                                   </div>
                              </div>
                         <?php } ?>
                    </div>
               </div>
          </div>
     </div>
     <?php include('footer.php'); ?>

     <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="fontawesome/js/all.min.js"></script>
</body>

</html>