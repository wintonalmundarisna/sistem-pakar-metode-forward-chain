<!-- proses tambah users -->
<?php

if (isset($_POST['simpan'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $role = $_POST['role'];
    
    $sql = "INSERT INTO users VALUES (null,'$username', '$password', '$role')";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=users");
    }
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>TAMBAH USERS</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" class="form-control" name="username" id="username" autofocus maxlength="200" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password" autofocus maxlength="10" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role</label>
                            <select class="form-control chosen" data-placeholder="Pilih Role" id="role" name="role">
                                <option selected disabled></option>
                                <option value="pasien">Pasien</option>
                                <option value="dokter">Dokter</option>
                                <option value="admin">Admin</option>
                            </select>
                        </div>


                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=users">Batal</a>


                    </div>
                </div>
        </form>
    </div>
</div>