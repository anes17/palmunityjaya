<?php
require('koneksi.php');
$nama = htmlspecialchars($_GET['nama']);
$queryProduk = mysqli_query($conn, "SELECT * from produk WHERE nama='$nama'");
$produk = mysqli_fetch_array($queryProduk);
$queryKategori = mysqli_query($conn, "SELECT * from produk WHERE kategori_id='$produk[kategori_id]' AND id!='$produk[id]' LIMIT 4");
?>

<!DOCTYPE html>
<html lang="en">
</style>

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Toko Online | Produk Detail</title>
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
     <link rel="stylesheet" href="css/style.css">

</head>

<body>
     <?php include('navbar.php') ?>
     <div class="container-fluid py-5">
          <div class="container">
               <div class="row">
                    <div class="col-lg-5">
                         <img src="image/<?= $produk['foto'] ?>" class="w-100">
                    </div>
                    <div class="col-lg-6 offset-lg-1">
                         <h1><?= $produk['nama'] ?></h1>
                         <p class="fs-5"><?= $produk['detail'] ?></p>
                         <p class="fs-3 text-warning">Rp. <?= $produk['harga'] ?></p>
                         <p>Status : <b><?= $produk['ketersediaan_stok'] ?></b></p>
                    </div>
               </div>
          </div>
     </div>

     <div class="container-fluid py-5 warna2">
          <div class="container">
               <h2 class="text-center text-white mb-5">Produk terkait</h2>
               <div class="row">
                    <?php while ($produkByKategori = mysqli_fetch_array($queryKategori)) { ?>
                         <div class="col-md-6 col-lg-3 mb-3 images-box">
                              <a href="produk-detail.php?nama=<?= $produkByKategori['nama'] ?>"><img src="image/<?= $produkByKategori['foto'] ?>" alt="" class="img-fluid img-thumbnail"></a>
                         </div>
                    <?php } ?>
               </div>
          </div>
     </div>


     <?php include('footer.php'); ?>

     <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="fontawesome/js/all.min.js"></script>
</body>

</html>