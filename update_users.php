<!-- proses update penyakit -->
<?php
// ambil id dari parameter
$id_users = $_GET['id'];

if (isset($_POST['update'])) {
    $role = $_POST['role'];

    // proses update
    $sql = "UPDATE users SET role='$role' WHERE idusers='$id_users'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=users");
    }
}

$sql = "SELECT * FROM users WHERE idusers='$id_users'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!-- proses update Penyakit -->

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>UPDATE USERS</strong></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" value="<?php echo $row['username'] ?>" name="username" id="username" maxlength="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" value="<?php echo $row['password'] ?>" name="password" id="password" maxlength="" readonly>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control chosen" data-placeholder="Pilih Role" id="role" name="role">
                                <option selected disabled value="<?php echo $row['role'] ?>"><?php echo $row['role'] ?></option>
                                <option value="pasien">Pasien</option>
                                <option value="dokter">Dokter</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>

                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                        <a class="btn btn-danger" href="?page=users">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>