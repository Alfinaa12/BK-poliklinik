<?php
if (!isset($_SESSION)) {
    session_start();
}

include_once("koneksi.php");

// Proses registrasi jika pengguna belum memiliki akun
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['register_user'])) {
    $reg_username = $_POST['reg_username'];
    $reg_password = $_POST['reg_password'];
    $reg_confirm_password = $_POST['reg_confirm_password'];

    if ($reg_password === $reg_confirm_password) {
        $query = "SELECT * FROM user WHERE username = '$reg_username'";
        $result = $mysqli->query($query);

        if ($result === false) {
            die("Query error: " . $mysqli->error);
        }

        if ($result->num_rows == 0) {
            $hashed_password = password_hash($reg_password, PASSWORD_DEFAULT);

            $insert_query = "INSERT INTO user (username, password) VALUES ('$reg_username', '$hashed_password')";
            if (mysqli_query($mysqli, $insert_query)) {
                echo "<script>
                alert('Registrasi Berhasil'); 
                </script>";
            } else {
                $error = "Registrasi gagal";
            }
        } else {
            $error = "Username sudah digunakan";
        }
    } else {
        $error = "Password tidak cocok";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Klinik AllCare!</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">Klinik AllCare!</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown"
        aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php">Home</a>
          </li>
          <?php
                    if (isset($_SESSION['username'])) {
                        // Jika admin sudah login, tampilkan menu "Dashboard Admin"
                    ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="dashboard.php">Dashboard Admin</a>
          </li>
          <?php
                    }
                    ?>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="dokterLoginHelper.php">Dokter</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php?page=pasienBaru">PasienBaru</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" aria-current="page" href="index.php?page=pasienLama">Pasien Lama</a>
          </li>


        </ul>
        <?php
                if (isset($_SESSION['username'])) {
                    // Jika pengguna sudah login, tampilkan tombol "Logout"
                ?>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="logoutAdmin.php">Logout (<?php echo $_SESSION['username'] ?>)</a>
          </li>
        </ul>
        <?php
                } else {
                    // Jika pengguna belum login, tampilkan tombol "Login" dan "Register"
                ?>
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link" href="index.php?page=loginAdmin">Login Admin</a>
          </li>
        </ul>
        <?php
                }
                ?>

      </div>
    </div>
  </nav>

  <main role="main" class="container">
    <?php

        if (isset($_GET['page'])) {
            include($_GET['page'] . ".php");
        } else {
           include("landingPage.php");
        }
        ?>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
  </script>
</body>

</html>
