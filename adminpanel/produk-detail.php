<?php
require 'session.php';
require '../koneksi.php';
$id = $_GET['id'];

$query = mysqli_query($conn, "SELECT a.*, b.nama AS nama_kategori FROM produk a JOIN kategori b ON a.kategori_id=b.id WHERE a.id='$id'");
$produk = mysqli_fetch_array($query);
$qKategori = mysqli_query($conn, "SELECT * FROM kategori WHERE id!='$produk[kategori_id]'");


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
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="../fontawesome/css/fontawesome.min.css">
    <title>Detail</title>

</head>

<body>
    <?php include('components/navbar.php') ?>
    <div class="container mt-5">
        <h2>Detail Produk</h2>
        <div class="col-12 col-md-6">
            <form action="" method="post" enctype="multipart/form-data">
                <div class="row gap-2">
                    <div>
                        <label for="nama_produk"></label>
                        <input type="text" name="nama" class="form-control" value="<?= $produk['nama'] ?>">
                    </div>
                    <div>
                        <label for="kategori">Select kategori</label>
                        <select name="kategori" id="kategori" class="form-control" required>
                            <option selected value="<?= $produk['kategori_id'] ?>"><?= $produk['nama_kategori'] ?></option>
                            <?php
                            while ($kategori = mysqli_fetch_array($qKategori)) {
                            ?>
                                <option value="<?= $kategori['id'] ?>"><?= $kategori['nama'] ?></option>
                            <?php
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="harga">Harga</label>
                        <input type="text" name="harga" class="form-control" value="<?= $produk['harga'] ?>">
                    </div>
                    <div>
                        <label for="detail">Detail</label>
                        <textarea name="detail" id="detail" cols="20" rows="5" class="form-control"><?= $produk['detail'] ?></textarea>
                    </div>
                    <div>
                        <img width="300px" src="../image/<?= $produk['foto'] ?>" alt="">
                    </div>
                    <div>
                        <input type="file" id="foto" name="foto" class="form-control" autocomplete="off">
                    </div>
                    <div>
                        <label for="stok">Stok barang</label>
                        <select name="stok" id="stok" class="form-control">
                            <option selected value="<?= $produk['ketersediaan_stok'] ?>"><?= $produk['ketersediaan_stok'] ?></option>
                            <?php if ($produk['ketersediaan_stok'] == 'tersedia') {
                            ?>
                                <option value="habis">habis</option>
                            <?php
                            } else {
                            ?>
                                <option value="tersedia">tersedia</option>
                            <?php
                            }
                            ?>

                        </select>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div>
                            <a href="produk.php" class="btn btn-secondary"><i class="fa-solid fa-backward"></i></a>
                            <button type="submit" name="ubah" class="btn btn-info my-3">Ubah</button>
                        </div>
                        <button type="submit" onclick="confirm('yakin ingin menghapus produk <?= $produk['nama'] ?>?')" name="hapus" class="btn btn-danger my-3">Hapus</button>

                    </div>
                </div>

            </form>

            <?php if (isset($_POST['ubah'])) {
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
                    $save = mysqli_query($conn, "UPDATE produk SET nama='$namaProduk', kategori_id='$kategori',harga='$harga',ketersediaan_stok='$stok', detail='$detail' WHERE id=$id");
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
                                $updateFoto = mysqli_query($conn, "UPDATE produk SET foto='$randName' WHERE id='$id'");
                                if (!$updateFoto) {
                                    echo mysqli_error($conn);
                                } else {
                                ?>
                                    <div class="alert alert-success" role="alert">
                                        Foto berhasil di update
                                    </div>
                                    <meta http-equiv="refresh" content="2; url=produk.php" />
                        <?php
                                }
                            }
                        }
                    }
                    if (!$save) {
                        echo mysqli_error($conn);
                    } else {
                        ?>
                        <div class="alert alert-success" role="alert">
                            <?= $namaProduk . " Berhasil di Update" ?>
                        </div>
                        <meta http-equiv="refresh" content="2; url=produk.php" />
                    <?php
                    }
                }
            }
            if (isset($_POST['hapus'])) {
                $delete = mysqli_query($conn, "DELETE FROM produk WHERE id='$produk[id]'");
                if ($delete) {
                    ?>
                    <div class="alert alert-success mt-3" role="alert">
                        Produk berhasil di Hapus
                    </div>
                    <meta http-equiv="refresh" content="2; url=produk.php" />
            <?php
                } else {
                    echo mysqli_error($conn);
                }
            }

            ?>
        </div>
    </div>


    <script src="../bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="../fontawesome/js/all.min.js"></script>
</body>

</html>