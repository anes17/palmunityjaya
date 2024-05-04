<?php
require 'session.php';
require '../koneksi.php';

$queryProduk = mysqli_query($conn, 'SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id');
$countProduk = mysqli_num_rows($queryProduk);

$queryKategori = mysqli_query($conn, 'SELECT * FROM kategori');
$countKategori = mysqli_num_rows($queryKategori);

function generateRandomString($length = 10)
{
     $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
     $charactersLength = strlen($characters);
     $randomString = '';
     for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[random_int(0, $charactersLength - 1)];
     }
     return $randomString;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Document</title>
     <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">

</head>

<body>
     <?php include('components/navbar.php') ?>
     <div class="container mt-5">
          <nav aria-label="breadcrumb">
               <ol class="breadcrumb">
                    <li class="breadcrumb-item active" aria-current="page"><a class="text-muted" style="text-decoration: none;" href="../adminpanel/"><i class="fa-solid fa-house"></i> Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Produk</li>
               </ol>
          </nav>
          <div class="my-4 col-12 col-md-6">
               <div class="accordion" id="accordionExample">
                    <div class="accordion-item">
                         <h2 class="accordion-header" id="headingOne">
                              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                   <h4>Tambah Produk</h4>
                              </button>
                         </h2>
                         <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                              <div class="accordion-body">
                                   <form action="" method="post" enctype="multipart/form-data">
                                        <div class="row gap-2">
                                             <div>
                                                  <label for="nama">Nama</label>
                                                  <input type="text" id="nama" name="nama" class="form-control" required autocomplete="off">
                                             </div>
                                             <div>
                                                  <label for="kategori">Select kategori</label>
                                                  <select name="kategori" id="kategori" class="form-control" required>
                                                       <option selected disabled></option>
                                                       <?php
                                                       while ($kategori = mysqli_fetch_array($queryKategori)) {
                                                       ?>
                                                            <option value="<?= $kategori['id'] ?>"><?= $kategori['nama'] ?></option>
                                                       <?php
                                                       }
                                                       ?>
                                                  </select>
                                             </div>
                                             <div>
                                                  <label for="harga">Harga</label>
                                                  <input type="text" id="harga" name="harga" class="form-control" required autocomplete="off">
                                             </div>
                                             <div>
                                                  <input type="file" id="foto" name="foto" class="form-control" autocomplete="off">
                                             </div>
                                             <div>
                                                  <label for="harga">Detail</label>
                                                  <textarea name="detail" id="detail" cols="20" rows="5" class="form-control"></textarea>
                                             </div>
                                             <div>
                                                  <label for="stok">Stok barang</label>
                                                  <select name="stok" id="stok" class="form-control">
                                                       <option selected value="tersedia">tersedia</option>
                                                       <option value="habis">habis</option>
                                                  </select>
                                             </div>

                                             <div class="my-3">
                                                  <button type="submit" class="btn btn-primary" name="simpanProduk">Simpan</button>
                                             </div>
                                        </div>
                                   </form>
                                   <?php if (isset($_POST['simpanProduk'])) {
                                        $namaProduk = htmlspecialchars($_POST['nama']);
                                        $kategori = htmlspecialchars($_POST['kategori']);
                                        $harga = htmlspecialchars($_POST['harga']);
                                        $detail = htmlspecialchars($_POST['detail']);
                                        $stok = htmlspecialchars($_POST['stok']);

                                        $target_dir = "../image/";
                                        $nama_file = basename($_FILES["foto"]["name"]);
                                        $target_file = $target_dir . $nama_file;
                                        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
                                        $sizeFoto = $_FILES["foto"]["size"];
                                        $randStr = generateRandomString();
                                        $randName = $randStr . "." . $imageFileType;



                                        if ($namaProduk == '' || $kategori == '' || $harga == '') {
                                   ?>
                                             <div class="alert alert-danger" role="alert">
                                                  Nama, Kategori dan Harga wajib di isi !
                                             </div>
                                             <?php
                                        } else {
                                             if ($nama_file != '') {
                                                  if ($sizeFoto > 5000000) {
                                             ?>
                                                       <div class="alert alert-danger" role="alert">
                                                            File melebihi 500kb
                                                       </div>
                                                       <?php
                                                  } else {
                                                       if ($imageFileType != 'jpg' && $imageFileType != 'png' && $imageFileType != 'jpeg') {
                                                       ?>
                                                            <div class="alert alert-danger" role="alert">
                                                                 File harus format png,jpg dan jpeg.
                                                            </div>
                                                  <?php
                                                       } else {
                                                            move_uploaded_file($_FILES['foto']['tmp_name'], $target_dir . $randStr . "." . $imageFileType);
                                                       }
                                                  }
                                             }
                                             // query
                                             $save = mysqli_query($conn, "INSERT INTO produk (kategori_id,nama,harga,foto,detail,ketersediaan_stok) VALUES ('$kategori', '$namaProduk','$harga','$randName','$detail','$stok')");
                                             if ($save) {
                                                  ?>
                                                  <div class="alert alert-success" role="alert">
                                                       Data berhasil Di simpan
                                                  </div>
                                                  <meta http-equiv="refresh" content="0; url=produk.php" />
                                   <?php
                                             } else {
                                                  echo mysqli_error($conn);
                                             }
                                        }
                                   }
                                   ?>
                              </div>
                         </div>
                    </div>
               </div>
          </div>

          <div class="mt-3">
               <h2>List Produk</h2>
               <div class="table-responsive">
                    <table class="table">
                         <thead>
                              <tr>
                                   <th>No.</th>
                                   <th>Nama</th>
                                   <th>Kategori</th>
                                   <th>Harga</th>
                                   <th>Stok</th>
                                   <th>Action</th>
                              </tr>
                         </thead>
                         <tbody>

                              <?php if ($countProduk == 0) {
                              ?>
                                   <tr>
                                        <td colspan="6" class="text-center">tidak ada data</td>
                                   </tr>
                              <?php

                              }
                              $number = 1;
                              while ($produk = mysqli_fetch_array($queryProduk)) {
                              ?>
                                   <tr>
                                        <td><?= $number ?></td>
                                        <td><?= $produk['nama'] ?></td>
                                        <td><?= $produk['nama_kategori'] ?></td>
                                        <td><?= $produk['harga'] ?></td>
                                        <td><?= $produk['ketersediaan_stok'] ?></td>
                                        <td><a href="produk-detail.php?id=<?= $produk['id'] ?>" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i></a></td>
                                   </tr>
                              <?php

                                   $number++;
                              }
                              ?>
                         </tbody>
                    </table>
               </div>
          </div>

     </div>


     <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>