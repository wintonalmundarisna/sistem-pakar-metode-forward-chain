<!-- proses tambah gejala -->
<?php

if (isset($_POST['simpan'])) {
    $NAMA_VAR = $_POST['nmgejala'];

    // Cek duplikat input
    $sql = "SELECT * FROM gejala WHERE nmgejala='$NAMA_VAR'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Gejala Sudah Ada</strong>
        </div>
<?php
    } else {
        //proses simpan
        $sql = "INSERT INTO gejala VALUES (null,'$NAMA_VAR')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=gejala");
        }
    }
}

?>
<!-- proses tambah gejala -->

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>TAMBAH GEJALA</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nmgejala">Nama Gejala</label>
                            <input type="text" class="form-control" name="nmgejala" id="nmgejala" autofocus maxlength="200" required>
                        </div>


                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=gejala">Batal</a>


                    </div>
                </div>
        </form>
    </div>
</div>