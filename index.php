<?php
session_start(); // session dari login
// koneksi db
include "config.php";

// u/ mengambil halaman
$page = isset($_GET['page']) ? $_GET['page'] : "";
// crud
$action = isset($_GET['action']) ? $_GET['action'] : "";
?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SPFC</title>
  <!-- bootstrap css -->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">

  <!-- dataTables.css u/ tampilan halaman tampil_gejala -->
  <link rel="stylesheet" href="assets/css/datatables.min.css">

  <!-- font awesome css -->
  <link rel="stylesheet" href="assets/css/all.css">

  <!-- bootstrap chosen -->
  <link rel="stylesheet" href="assets/css/bootstrap-chosen.css">
</head>

<body>
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
    <a class="navbar-brand" href="index.php">Sistem Pakar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item <?php if ($page == "") echo "active"; ?>">
          <a class="nav-link" href="index.php">Home</a>
        </li>

        <!-- setting hak akses melalui role -->
        <?php
        if ($_SESSION['role'] == "dokter") {
        ?>
          <li class="nav-item <?php if ($page == "users") echo "active"; ?>">
            <a class="nav-link" href="?page=users">Users</a>
          </li>
          <li class="nav-item <?php if ($page == "aturan") echo "active"; ?>">
            <a class="nav-link" href="?page=aturan">Basis Aturan</a>
          </li>
          <li class="nav-item <?php if ($page == "konsultasiadm") echo "active"; ?>">
            <a class="nav-link" href="?page=konsultasiadm">Konsultasi</a>
          </li>
        <?php
        } elseif ($_SESSION['role'] == "admin") {
        ?>

          <li class="nav-item  <?php if ($page == "gejala") echo "active"; ?>">
            <a class="nav-link" href="?page=gejala">Gejala</a>
          </li>
          <li class="nav-item  <?php if ($page == "penyakit") echo "active"; ?>">
            <a class="nav-link" href="?page=penyakit">Penyakit</a>
          </li>
          <li class="nav-item <?php if ($page == "aturan") echo "active"; ?>">
            <a class="nav-link" href="?page=aturan">Basis Aturan</a>
          </li>
          <li class="nav-item <?php if ($page == "konsultasiadm") echo "active"; ?>">
            <a class="nav-link" href="?page=konsultasiadm">Konsultasi</a>
          </li>

        <?php
        } else {
        ?>

          <li class="nav-item <?php if ($page == "konsultasi") echo "active"; ?>">
            <a class="nav-link" href="?page=konsultasi">Konsultasi</a>
          </li>

        <?php
        }
        ?>

        <li class="nav-item">
          <a class="nav-link" href="?page=logout">Logout</a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- cek status login, kalo status belum y, maka gaboleh akses dibawah-->
  <?php
  if ($_SESSION['status'] != "y") {
    header("Location:halaman_login.php");
  }
  ?>

  <div class="container mt-5">
    <!-- setting menu -->
    <?php
    if ($page == "") {
      include "welcome.php";
    } elseif ($page == "gejala") {
      if ($action == "") {
        include "tampil_gejala.php";
      } elseif ($action == "tambah") {
        include 'tambah_gejala.php';
      } elseif ($action == "update") {
        include 'update_gejala.php';
      } else {
        include "hapus_gejala.php";
      }
    } elseif ($page == "penyakit") {
      if ($action == "") {
        include "tampil_penyakit.php";
      } elseif ($action == "tambah") {
        include 'tambah_penyakit.php';
      } elseif ($action == "update") {
        include 'update_penyakit.php';
      } else {
        include "hapus_penyakit.php";
      }
    } elseif ($page == "aturan") {
      if ($action == "") {
        include "tampil_aturan.php";
      } elseif ($action == "tambah") {
        include 'tambah_aturan.php';
      } elseif ($action == "detail") {
        include 'detail_aturan.php';
      } elseif ($action == "update") {
        include 'update_aturan.php';
      } elseif ($action == "hapus_gejala") {
        include 'hapus_detail_aturan.php';
      } else {
        include "hapus_aturan.php";
      }
    } elseif ($page == "konsultasi") {
      if ($action == "") {
        include "tampil_konsultasi.php";
      } elseif ($action == "hasil") {
        include "hasil_konsultasi.php";
      }
    } elseif ($page == "konsultasiadm") {
      if ($action == "") {
        include "tampil_konsultasiadm.php";
      } elseif ($action == "detail") {
        include "detail_konsultasiadm.php";
      }
    } elseif ($page == "users") {
      if ($action == "") {
        include "tampil_users.php";
      } elseif ($action == "tambah") {
        include 'tambah_users.php';
      } elseif ($action == "update") {
        include 'update_users.php';
      } else {
        include "hapus_users.php";
      }
    } else {
      include 'halaman_logout.php';
    }
    ?>
  </div>


  <!-- jquery -->
  <script src="assets/js/jquery-3.7.0.min.js"></script>
  <!-- bootstrap js -->
  <script src="assets/js/bootstrap.min.js"></script>
  <!-- datatables js -->
  <script src="assets/js/datatables.min.js"></script>
  <!-- font awesome js -->
  <script src="assets/js/all.js"></script>
  <!-- chosen js -->
  <script src="assets/js/chosen.jquery.min.js"></script>
  <script>
    $(document).ready(function() {
      // id ada di tampil_gejala.php
      $("#myTable").DataTable();
    });

    // chosen
    $(function() {
      $('.chosen').chosen();
    });
    // chosen
  </script>
</body>

</html>