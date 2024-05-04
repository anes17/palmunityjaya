<?php
require('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">
</style>

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Toko Online | Tetntang Kami</title>
     <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
     <link rel="stylesheet" href="css/style.css">

</head>

<body>
     <?php include('navbar.php') ?>

     <!-- banner -->
     <div class="container-fluid banner-produk d-flex align-items-center">
          <div class="container text-center text-white">
               <h1>Tentang kami</h1>
          </div>
     </div>
     <div class="container-fluid py-5">
          <div class="container fs-5 text-center">
               <p>Palmunity Indonesia Jaya Dibangun di atas visi yang kokoh, telah menjadi simbol keunggulan dan inovasi. Di balik setiap produk dan layanan PT. Palmunity Indonesia Jaya, terdapat semangat untuk impian yang besar. Perjalanan PT. Palmunity Indonesia Jaya tidak hanya tentang mencapai kesuksesan finansial, tetapi juga tentang membangun hubungan yang berkelanjutan dengan pelanggan dan komunitas.</p>
          </div>
     </div>

     <?php include('footer.php'); ?>

     <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="fontawesome/js/all.min.js"></script>
</body>

</html>