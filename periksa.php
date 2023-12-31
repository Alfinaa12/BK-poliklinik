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
<body>
<div class="container">
    </nav><div class="form-group mx-sm-3 mb-2">
    <form class="form row" method="POST" action="" name="myForm" onsubmit="return validate()">
    <!-- Kode php untuk menghubungkan form dengan database -->
    <?php
   
$id_pasien = '';
$id_dokter = '';
$tgl_periksa = '';
$catatan = '';
$biaya_periksa = '';
$id = '';
   
if (isset($_GET['id']) && $_GET['aksi'] == 'edit') {
  $id = $_GET['id'];
  $query = "SELECT * FROM periksa WHERE id = $id";
  $result = mysqli_query($mysqli, $query);

  if (mysqli_num_rows($result) == 1) {
      $data = mysqli_fetch_assoc($result);
      $id_pasien = $data['id_pasien'];
      $id_dokter = $data['id_dokter'];
      $tgl_periksa = $data['tgl_periksa'];
      $catatan = $data['catatan'];
      $biaya_periksa = $data['biaya_periksa'];
  }

    ?>
        <input type="hidden" name="id" value="<?php echo
        $_GET['id'] ?>">
    <?php
    }
    ?>
    <div class="col">
        <label for="inputNama" class="form-label fw-bold">
            Nama Pasien
        </label>
        <select class="form-control" name="id_pasien">
        <?php
        $selected = '';
        $pasien = mysqli_query($mysqli, "SELECT * FROM pasien");
        while ($data = mysqli_fetch_array($pasien)) {
            if ($data['id'] == $id_pasien) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        ?>
            <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
        <?php
        }
        ?>
    </select>
    </div>
    <div class="col">
        <label for="inputAlamat" class="form-label fw-bold">
            Nama Dokter
        </label>
        <select class="form-control" name="id_dokter">
        <?php
        $selected = '';
        $dokter = mysqli_query($mysqli, "SELECT * FROM dokter");
        while ($data = mysqli_fetch_array($dokter)) {
            if ($data['id'] == $id_dokter) {
                $selected = 'selected="selected"';
            } else {
                $selected = '';
            }
        ?>
            <option value="<?php echo $data['id'] ?>" <?php echo $selected ?>><?php echo $data['nama'] ?></option>
        <?php
        }
        ?>
    </select>
    </div>
    <div class="col mb-2">
        <label for="inputTanggal Periksa" class="form-label fw-bold">
        Tanggal Periksa
        </label>
        <input type="date" class="form-control" name="tgl_periksa" id="inputTgl_periksa" placeholder="Tanggal Periksa" value="<?php echo $tgl_periksa; ?>">
    </div>
    <div class="col mb-2">
        <label for="inputCatatan" class="form-label fw-bold">
        Catatan
        </label>
        <input type="text" class="form-control" name="catatan" id="inputCatatan" placeholder="Catatan" value="<?php echo $catatan; ?>">
    </div>
    <div class="col mb-2">
        <label for="inputBiaya_periksa" class="form-label fw-bold">
        Biaya Periksa
        </label>
        <input type="integer" class="form-control" name="biaya_periksa" id="inputBiaya_periksa" placeholder="Biaya Periksa" value="<?php echo $biaya_periksa; ?>">
    </div>
    <div class="col">
        <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
    </div>
    <!-- Table-->
<table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Nama Pasien</th>
            <th scope="col">Nama Dokter</th>
            <th scope="col">Tanggal Periksa</th>
            <th scope="col">Catatan</th>
            <th scope="col">Biaya Periksa</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <!--tbody berisi isi tabel sesuai dengan judul atau head-->
    <tbody>
</div>
<form method="post" action="periksa.php">
<?php
$result = mysqli_query($mysqli, "SELECT pr.*,d.nama as 'nama_dokter', p.nama as 'nama_pasien' FROM periksa pr LEFT JOIN dokter d ON (pr.id_dokter=d.id) LEFT JOIN pasien p ON (pr.id_pasien=p.id) ORDER BY id ASC");
$no = 1;
while ($data = mysqli_fetch_array($result)) {
?>
                                <tr>
                                <th scope="row"><?php echo $data['id'] ?></th>
                                <td><?php echo $data['nama_pasien'] ?></td>
                                <td><?php echo $data['nama_dokter'] ?></td>
                                <td><?php echo $data['tgl_periksa'] ?></td>
                                <td><?php echo $data['catatan'] ?></td>
                                <td><?php echo $data['biaya_periksa'] ?></td>
                                <td>
                                    <div class="action-buttons">
                                        <a class="btn btn-primary rounded-pill px-3" href="periksa.php?page=periksa&aksi=edit&id=<?php echo $data['id'] ?>">Edit</a>
                                        <a class="btn btn-danger rounded-pill px-3" href="periksa.php?page=periksa&aksi=hapus&id=<?php echo $data['id'] ?>">Hapus</a>
                                    </div>
                                </td>
                            </tr>
    <?php
}
?>
</form>
<?php

$id_pasien = '';
$id_dokter = '';
$tgl_periksa = '';
$catatan = '';
$biaya_periksa = '';
$id = '';

$daftar_dokter = mysqli_query($mysqli, "SELECT id_dokter, nama FROM dokter");
$daftar_pasien = mysqli_query($mysqli, "SELECT id_pasien, nama FROM pasien");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['simpan'])) {
    $id_pasien = $_POST['id_pasien'];
    $id_dokter = $_POST['id_dokter'];
    $tgl_periksa = $_POST['tgl_periksa'];
    $catatan = $_POST['catatan'];
    $biaya_periksa = $_POST['biaya_periksa'];

    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $query = "UPDATE periksa SET id_pasien = $id_pasien, id_dokter = $id_dokter, tgl_periksa = '$tgl_periksa', catatan = '$catatan', biaya_periksa = '$biaya_periksa' WHERE id = $id";
    } else {
        $query = "INSERT INTO periksa (id_pasien, id_dokter, tgl_periksa, catatan, biaya_periksa) VALUES ($id_pasien, $id_dokter, '$tgl_periksa', '$catatan', '$biaya_periksa')";
    }

    if (mysqli_query($mysqli, $query)) {
        echo "<script>alert('Data berhasil disimpan');</script>";
    } else {
        echo "<script>alert('Terjadi kesalahan: " . mysqli_error($mysqli) . "');</script>";
    }
}


if (isset($_GET['id']) && $_GET['aksi'] == 'hapus') {
  $id = $_GET['id'];
  $query = "DELETE FROM periksa WHERE id = $id";
  if (mysqli_query($mysqli, $query)) {
      echo "<script>
          if (confirm('Data berhasil dihapus. Kembali ke halaman Periksa?')) {
              window.location.href = 'periksa.php?page=periksa';
          } else {
              window.location.href = 'periksa.php';
          }
      </script>";
  } else {
      echo "<script>alert('Terjadi kesalahan: " . mysqli_error($mysqli) . "');</script>";
  }
}

if (isset($_GET['id']) && $_GET['aksi'] == 'edit') {
  $id = $_GET['id'];
  $query = "SELECT * FROM periksa WHERE id = $id";
  $result = mysqli_query($mysqli, $query);

  if (mysqli_num_rows($result) == 1) {
      $data = mysqli_fetch_assoc($result);
      $id_pasien = $data['id_pasien'];
      $id_dokter = $data['id_dokter'];
      $tgl_periksa = $data['tgl_periksa'];
      $catatan = $data['catatan'];
      $biaya_periksa = $data['biaya_periksa'];
  }
}

$query = "SELECT periksa.id, 
               periksa.id_pasien, 
               periksa.id_dokter, 
               periksa.tgl_periksa, 
               periksa.catatan, 
               periksa.biaya_periksa, 
               pasien.nama AS nama_pasien, 
               dokter.nama AS nama_dokter
        FROM periksa
        LEFT JOIN pasien ON periksa.id_pasien = pasien.id_pasien
        LEFT JOIN dokter ON periksa.id_dokter = dokter.id_dokter";

$result = mysqli_query($mysqli, $query);

?>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>
</html>