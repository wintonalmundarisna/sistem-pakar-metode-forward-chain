<!-- proses update penyakit -->
<?php
// ambil id dari parameter
$id_penyakit = $_GET['id'];

if (isset($_POST['update'])) {
    $nama_penyakit = $_POST['nmpenyakit'];
    $keterangan = $_POST['keterangan'];
    $solusi = $_POST['solusi'];

    // proses update
    $sql = "UPDATE penyakit SET nmpenyakit='$nama_penyakit', keterangan='$keterangan', solusi='$solusi' WHERE idpenyakit='$id_penyakit'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=penyakit");
    }
}

$sql = "SELECT * FROM penyakit WHERE idpenyakit='$id_penyakit'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!-- proses update Penyakit -->

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>UPDATE PENYAKIT</strong></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nmpenyakit">Nama Penyakit</label>
                            <input type="text" class="form-control" value="<?php echo $row['nmpenyakit'] ?>" name="nmpenyakit" id="nmpenyakit" maxlength="" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan Penyakit</label>
                            <input type="text" class="form-control" value="<?php echo $row['keterangan'] ?>" name="keterangan" id="keterangan" maxlength="" required autofocus>
                        </div>
                        <div class="form-group">
                            <label for="solusi">Solusi Penyakit</label>
                            <input type="text" class="form-control" value="<?php echo $row['solusi'] ?>" name="solusi" id="solusi" maxlength="" required autofocus>
                        </div>

                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                        <a class="btn btn-danger" href="?page=penyakit">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>