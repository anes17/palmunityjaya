<?php
require('koneksi.php');
$query = mysqli_query($conn, "SELECT id, nama, harga,foto, detail from produk LIMIT 6");

?>

<!DOCTYPE html>
<html lang="en">
</style>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Online | Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php include('navbar.php') ?>
    <!-- banner -->
    <div class="container-fluid banner d-flex align-items-center">
        <div class="container text-center text-white">
            <h1>Online Shop</h1>
            <h3>Mau Cari Apa?</h3>
            <div class="col-8 offset-2">
                <form action="produk.php" method="get">
                    <div class="input-group input-group-lg my-4">
                        <input type="text" class="form-control" placeholder="Nama Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" name="keyword">
                        <button type="submit" class="btn warna2 text-white">Telusuri</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- highlight kategori -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h4>Kategori Terlaris</h4>

            <div class="row mt-3">
                <div class="col-lg-4">
                    <div class="kategori">
                        <div class="kategori baju-pria d-flex justify-content-center align-items-center">
                            <h3><a class="text-white" href="produk.php?kategori=baju pria">Minyak Goreng</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="kategori">
                        <div class="kategori baju-wanita d-flex justify-content-center align-items-center">
                            <h3><a class="text-white" href="produk.php?kategori=baju wanita">Sabun Piring</a></h3>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="kategori">
                        <div class="kategori jam-tangan d-flex justify-content-center align-items-center">
                            <h3><a class="text-white" href="produk.php?kategori=jam">Sabun Pakaian</a></h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- about us -->
    <div class="container-fluid warna3 py-5">
        <div class="container text-center">
            <h3>Tentang Kami</h3>
            <p class="fs-5 mt-3">Palmunity Indonesia Jaya Dibangun di atas visi yang kokoh, telah menjadi simbol keunggulan dan inovasi. Di balik setiap produk dan layanan PT. Palmunity Indonesia Jaya, terdapat semangat untuk impian yang besar. Perjalanan PT. Palmunity Indonesia Jaya tidak hanya tentang mencapai kesuksesan finansial, tetapi juga tentang membangun hubungan yang berkelanjutan dengan pelanggan dan komunitas.</p>
        </div>
    </div>

    <!-- produk -->
    <div class="container-fluid py-5">
        <div class="container text-center">
            <h3>Produk</h3>

            <div class="row mt-5 ">
                <?php while ($produk = mysqli_fetch_array($query)) {  ?>
                    <div class="col lg-4 mb-3">
                        <div class="card h-100" style="width: 18rem;">
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
            <a href="produk.php" class="btn btn-outline-warning mt-3 p-2 fs-5">See more..</a>
        </div>
    </div>

    <?php include('footer.php'); ?>

    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="fontawesome/js/all.min.js"></script>
</body>

</html>