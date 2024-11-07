<!-- proses login -->
<?php
session_start();
require "config.php";


if (isset($_POST["submit"])) {


    $username = $_POST["username"];
    $pass = md5($_POST["password"]);


    $sql = "SELECT*FROM users where username='$username' AND password='$pass'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();

    // jika login berhasil
    if ($result->num_rows > 0) {
        // membuat session sesuai kebutuhan
        $_SESSION['username'] = $row["username"];
        $_SESSION['role'] = $row["role"];
        $_SESSION['status'] = "y"; // apakah sudah login atau belum

        header("Location:index.php");


        // jika login gagal
    } else {
        header("Location:?msg=n");
    }
}
$conn->close();
?>
<!-- proses login -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>LOGIN</title>


    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
</head>

<body>


    <!-- validasi login gagal, letakkan disini -->
    <?php
    if (isset($_GET['msg'])) {
        if ($_GET['msg'] == "n") {
    ?>
            <div class="alert alert-danger" align="center">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Login Gagal</strong>
            </div>
    <?php
        }
    }
    ?>

    <div class="container-fluid" style="margin-top:150px">
        <div class="row">
            <div class="col-lg-4 offset-lg-4">
                <form method="POST">
                    <div class="card border-dark">
                        <div class="card-header bg-primary text-light border-dark">
                            <strong>LOGIN</strong>
                        </div>
                        <div class="card-body border">
                            <div class="form-group">
                                <label for="username">User Name</label>
                                <input type="text" class="form-control" id="username" name="username" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" name="password" autocomplete="off" required>
                            </div>
                            <input type="submit" class="btn btn-primary" name="submit" value="Login">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script src="assets/js/jquery-3.7.0.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
</body>

</html>