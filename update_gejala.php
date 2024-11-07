<!-- proses update Gejala -->
<?php
// ambil id dari parameter
$id_gejala = $_GET['id'];

if (isset($_POST['update'])) {
    $NAMA_VAR = $_POST['nmgejala'];

    // proses update
    $sql = "UPDATE gejala SET nmgejala='$NAMA_VAR' WHERE idgejala='$id_gejala'";
    if ($conn->query($sql) === TRUE) {
        header("Location:?page=gejala");
    }
}

$sql = "SELECT * FROM gejala WHERE idgejala='$id_gejala'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>

<!-- proses update Gejala -->

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>UPDATE GEJALA</strong></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nmgejala">Nama Gejala</label>
                            <input type="text" class="form-control" value="<?php echo $row['nmgejala'] ?>" name="nmgejala" id="nmgejala" maxlength="" required autofocus>
                        </div>

                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                        <a class="btn btn-danger" href="?page=gejala">Batal</a>

                    </div>
                </div>
        </form>
    </div>
</div>