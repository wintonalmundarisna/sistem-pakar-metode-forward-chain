<!-- proses tambah penyakit -->
<?php

if (isset($_POST['simpan'])) {
    $nama_penyakit = $_POST['nmpenyakit'];
    $keterangan = $_POST['keterangan'];
    $solusi = $_POST['solusi'];

    // Cek duplikat input
    $sql = "SELECT * FROM penyakit WHERE nmpenyakit='$nama_penyakit'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Penyakit Sudah Ada</strong>
        </div>
<?php
    } else {
        //proses simpan
        $sql = "INSERT INTO penyakit VALUES (null,'$nama_penyakit', '$keterangan', '$solusi')";
        if ($conn->query($sql) === TRUE) {
            header("Location:?page=penyakit");
        }
    }
}

?>
<!-- proses tambah penyakit -->

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>TAMBAH PENYAKIT</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nmpenyakit">Nama Penyakit</label>
                            <input type="text" class="form-control" name="nmpenyakit" id="nmpenyakit" autofocus maxlength="200" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan Penyakit</label>
                            <input type="text" class="form-control" name="keterangan" id="keterangan" autofocus maxlength="200" required>
                        </div>
                        <div class="form-group">
                            <label for="solusi">Solusi Penyakit</label>
                            <input type="text" class="form-control" name="solusi" id="solusi" autofocus maxlength="200" required>
                        </div>


                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=penyakit">Batal</a>


                    </div>
                </div>
        </form>
    </div>
</div>