<?php
require 'session.php';
require '../koneksi.php';

$queryKategori = mysqli_query($conn, 'SELECT * FROM kategori');
$countKategori = mysqli_num_rows($queryKategori);

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
                    <li class="breadcrumb-item active" aria-current="page">Kategori</li>
               </ol>
          </nav>

          <div class="my-4 col-12 col-md-6">
               <h3>Tambah Kategori</h3>
               <form action="" method="post">
                    <div>
                         <label for="kategori"></label>
                         <input type="text" id="kategori" name="kategori" class="form-control" required placeholder="Input kategori" autocomplete="off">
                    </div>
                    <div class="my-3">
                         <button type="submit" class="btn btn-primary" name="simpanKategori">Simpan</button>
                    </div>
               </form>
               <?php if (isset($_POST['simpanKategori'])) {
                    $newKategori = htmlspecialchars($_POST['kategori']);
                    $queryExist = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama='$newKategori'");
                    if (mysqli_num_rows($queryExist)) {
               ?>
                         <div class="alert alert-danger" role="alert">
                              <?= $newKategori . " sudah ada dalam database" ?>
                         </div>
                         <?php
                    } else {
                         $save = mysqli_query($conn, "INSERT INTO kategori (nama) VALUES ('$newKategori')");
                         if (!$save) {
                              echo mysqli_error($conn);
                         } else {
                         ?>
                              <div class="alert alert-success" role="alert">
                                   <?= $newKategori . " Berhasil di simpan" ?>
                              </div>
               <?php
                              header('location: kategori.php');
                         }
                    }
               }
               ?>

          </div>

          <div class="mt-3">
               <h2>List Kategori</h2>
               <div class="table-responsive">
                    <table class="table">
                         <thead>
                              <tr>
                                   <th>no</th>
                                   <th>nama</th>
                                   <th>Action</th>
                              </tr>
                         </thead>
                         <tbody>

                              <?php if ($countKategori == 0) {
                              ?>
                                   <tr>
                                        <td colspan="3" class="text-center">tidak ada data</td>
                                   </tr>
                              <?php

                              }
                              $number = 1;
                              while ($kategori = mysqli_fetch_array($queryKategori)) {
                              ?>
                                   <tr>
                                        <td><?= $number ?></td>
                                        <td><?= $kategori['nama'] ?></td>
                                        <td><a href="kategori-detail.php?id=<?= $kategori['id'] ?>" class="btn btn-sm btn-info text-white"><i class="fas fa-search"></i></a></td>
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