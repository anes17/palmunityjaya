<?php
require 'session.php';
require '../koneksi.php';
$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id='$id'");
$kategori = mysqli_fetch_array($query);

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
     <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
     <title>Detail</title>

</head>

<body>
     <?php include('components/navbar.php') ?>
     <div class="container mt-5">
          <h2>Detail kategori</h2>
          <div class="col-12 col-md-6">
               <form action="" method="post">
                    <label for="kategori"></label>
                    <input type="text" name="kategori" class="form-control" value="<?= $kategori['nama'] ?>">
                    <div class="d-flex justify-content-between">
                         <div>
                              <a href="kategori.php" class="btn btn-secondary"><i class="fa-solid fa-backward"></i></a>
                              <button type="submit" name="ubah" class="btn btn-info my-3">Ubah</button>
                         </div>
                         <button type="submit" onclick="confirm('yakin ingin menghapus Kategori <?= $kategori['nama'] ?>?')" name="hapus" class="btn btn-danger my-3">Hapus</button>

                    </div>
               </form>

               <?php if (isset($_POST['ubah'])) {
                    $newKategori = htmlspecialchars($_POST['kategori']);
                    $queryExist = mysqli_query($conn, "SELECT nama FROM kategori WHERE nama='$newKategori'");
                    if (mysqli_num_rows($queryExist)) {
               ?>
                         <div class="alert alert-danger" role="alert">
                              <?= $newKategori . " sudah ada dalam database" ?>
                         </div>
                         <?php
                    } else {
                         $save = mysqli_query($conn, "UPDATE kategori SET nama='$newKategori' WHERE id=$id");
                         if (!$save) {
                              echo mysqli_error($conn);
                         } else {
                         ?>
                              <div class="alert alert-success" role="alert">
                                   <?= $newKategori . " Berhasil di Update" ?>
                              </div>
                         <?php
                              header('location: kategori.php');
                         }
                    }
               }
               if (isset($_POST['hapus'])) {
                    $checking = mysqli_query($conn,"SELECT * FROM produk WHERE kategori_id = '$id'");
                    $alreadyExist = mysqli_num_rows($checking);
                    if($alreadyExist > 0){
                         ?>
                         <div class="alert alert-warning mt-3" role="alert">
                              Upss!! ada produk didalam Kategori ini 
                         </div>
                         <?php
                    }else{
                         $delete = mysqli_query($conn, "DELETE FROM kategori WHERE id='$id'");
                    if ($delete) {
                         ?>
                         <div class="alert alert-success mt-3" role="alert">
                              Kategori berhasil di Hapus
                         </div>
                         <meta http-equiv="refresh" content="2; url=kategori.php" />
               <?php
                    } else {
                         echo mysqli_error($conn);
                    }
               }
                    }
                    
               ?>
          </div>
     </div>


     <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
     <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>