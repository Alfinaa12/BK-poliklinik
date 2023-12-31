<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  </head>
  <body>
  <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">
      Sistem Informasi Poliklinik
    </a>
    <button class="navbar-toggler"
    type="button" data-bs-toggle="collapse"
    data-bs-target="#navbarNavDropdown"
    aria-controls="navbarNavDropdown" aria-expanded="false"
    aria-label="Toggle navigation">
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="index.php">
            Home
          </a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button"
          data-bs-toggle="dropdown" aria-expanded="false">
            Data Master
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item" href="dokter.php?page=dokter">
                Dokter
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="pasien.php?page=pasien">
                Pasien
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="obat.php?page=obat">
                Obat
              </a>
            </li>
            <li>
              <a class="dropdown-item" href="detail_periksa.php?page=detail_periksa">
                Detail Periksa
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" 
          href="periksa.php?page=periksa">
            Periksa
          </a>
        </li>
      </ul>
    </div>
  </div>
</nav>  
<?php
include'koneksi.php';
?>
<?php


if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE detail_periksa SET 
                                            id_periksa = '" . $_POST['id_periksa'] . "',
                                            id_obat = '" . $_POST['id_obat'] . "'
                                            WHERE
                                            id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO detail_periksa (id_periksa, id_obat) 
                                            VALUES (
                                                '" . $_POST['id_periksa'] . "',
                                                '" . $_POST['id_obat'] . "'
                                                
                                            )");
    }
    echo "<script> 
                document.location='detail_periksa.php?page=detail_periksa';
                </script>";
}
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM detail_periksa WHERE id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
                document.location='detail_periksa.php?page=detail_perika';
                </script>";
}
?>

<div class="container">
    <!--Form Input Data-->
    <h2>Detail Periksa</h2>
<br>
    <form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">
        <!-- Kode php untuk menghubungkan form dengan database -->
        <?php
        $id_periksa = '';
        $id_obat = '';
        if (isset($_GET['id'])) {
            $ambil = mysqli_query($mysqli, "SELECT * FROM detail_periksa
                    WHERE id='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $id_periksa = $row['id_periksa'];
                $id_obat = $row['id_obat'];
            }
        ?>
            <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <?php
        }
        ?>
        <div class="col">
        <label for="inputNama" class="form-label fw-bold">
            Biaya Periksa
        </label>
        <select class="form-control" name="id_periksa">
        <?php
        $selected = '';
        $periksa = mysqli_query($mysqli, "SELECT * FROM Periksa");
        while ($data = mysqli_fetch_array($periksa)) {
            if ($data['id'] == $id_periksa) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        ?>
            <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['biaya_periksa'] ?></option>
        <?php
        }
        ?>
    </select>
    </div>
    <div class="col">
        <label for="inputNama" class="form-label fw-bold">
          Harga Obat
        </label>
        <select class="form-control" name="id_obat">
        <?php
        $selected = '';
        $obat = mysqli_query($mysqli, "SELECT * FROM obat");
        while ($data = mysqli_fetch_array($obat)) {
            if ($data['id'] == $id_obat) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        ?>
            <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['harga'] ?></option>
        <?php
        }
        ?>
    </select>
    </div>
    <div class="col">
        <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
    </div>
    </form>
    <br>
    <br>
    <!-- Table-->
    <table class="table table-hover">
        <!--thead atau baris judul-->
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Periksa</th>
                <th scope="col">Obat</th>
                <th scope="col">Jumlah</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <!--tbody berisi isi tabel sesuai dengan judul atau head-->
        <tbody>
            <!-- Kode PHP untuk menampilkan semua isi dari tabel urut-->
            <?php
            $result = mysqli_query($mysqli, "SELECT detail_periksa.*,periksa.biaya_periksa as 'biaya_periksa', obat.harga as 'harga' FROM detail_periksa LEFT JOIN periksa ON (detail_periksa.id_periksa=periksa.id) LEFT JOIN obat ON (detail_periksa.id_obat=obat.id) ORDER BY id ASC");
            $no = 1;
            while ($data = mysqli_fetch_array($result)) {
              $total_biaya = $data['biaya_periksa'] + $data['harga'];
            ?>
                <tr>
                    <th scope="row"><?php echo $no++ ?></th>
                    <td><?php echo $data['biaya_periksa'] ?></td>
                    <td><?php echo $data['harga'] ?></td>
                    <td><?php echo $total_biaya ?></td>
                    <td>
                        <a class="btn btn-success rounded-pill px-3" href="detail_periksa.php?page=detail_periksa&id=<?php echo $data['id'] ?>">Ubah</a>
                        <a class="btn btn-danger rounded-pill px-3" href="detail_periksa.php?page=detail_periksa&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus</a>
                    </td>
                </tr>
            <?php
            }
            ?>
        </tbody>
    </table>