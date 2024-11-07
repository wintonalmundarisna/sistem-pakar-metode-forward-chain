<!-- proses menampilkan data penyakit berdasarkan basis_aturan yang dipilih -->
<?php
// ambil id dari parameter
$id_aturan = $_GET['id'];

// AMBIL idaturan, idpenyakit, nmpenyakit DARI basis_aturan YANG DIGABUNGKAN DENGAN tabel penyakit PADA basis_aturan.idpenyakit = penyakit.idpenyakit DIMANA idaturan = $id_aturan
$sql = "SELECT basis_aturan.idaturan, basis_aturan.idpenyakit, penyakit.nmpenyakit FROM basis_aturan INNER JOIN penyakit ON basis_aturan.idpenyakit = penyakit.idpenyakit WHERE idaturan='$id_aturan'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// proses update
if (isset($_POST['update'])) {
    $id_gejala = $_POST['idgejala'];

    // proses simpan...Kalo ga kosong maka akan ditambahkan
    if ($idgejala != null) {
        $jmlDicentang = count($id_gejala);
        $i = 0;
        while ($i < $jmlDicentang) {
            $pecahIdGejalaArray = $id_gejala[$i];
            $sql4 = "INSERT INTO detail_basis_aturan VALUES ('$id_aturan', '$pecahIdGejalaArray')";
            mysqli_query($conn, $sql4);
            $i++;
        }
    }
    // kalo kosong maka hanya lewat
    header("Location:?page=aturan");
}
?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>EDIT BASIS ATURAN</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nmpenyakit">Nama Penyakit</label>
                            <input type="text" class="form-control" name="nmpenyakit" readonly value="<?php echo $row['nmpenyakit'] ?>">
                        </div>

                        <!-- tabel gejala -->
                        <div class="form-group">
                            <label for="">Pilih gejala-gejala berikut: </label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="30px" class="text-center">Pilih</th>
                                        <th width="30px" class="text-center">No</th>
                                        <th width="700px">Nama Gejala</th>
                                        <th width="100px" class="text-center">Hapus</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM gejala ORDER BY nmgejala ASC";
                                    $result = $conn->query($sql);
                                    $no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                        $idgejala = $row['idgejala'];
                                        // cek ke tabel detail_basis_aturan
                                        $sql2 = "SELECT * FROM detail_basis_aturan WHERE idaturan = '$id_aturan' AND idgejala='$idgejala'";
                                        $result2 = $conn->query($sql2);
                                        if ($result2->num_rows > 0) {
                                            // jika ditemukan maka tampilkan datanya, checklist mati, hapus menyala
                                    ?>
                                            <tr>
                                                <td class="text-center">
                                                    <!-- name, ambil idgejala lalu simpan ke dalam array -->
                                                    <input type="checkbox" class="check-item" disabled checked>
                                                </td>
                                                <td class="text-center"><?php echo $no++ ?></td>
                                                <td><?php echo $row['nmgejala']; ?></td>
                                                <td>
                                                    <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=aturan&action=hapus_gejala&idaturan=<?php echo $id_aturan ?>&idgejala=<?php echo $idgejala ?>">
                                                        <i class="fas fa-trash"></i> Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php
                                        } else {
                                            // jika tidak ditemukan maka checklist aktif dan hapus mati
                                        ?>
                                            <tr>
                                                <td class="text-center">
                                                    <input type="checkbox" class="check-item" name="<?php echo 'idgejala[]'; ?>" value="<?php echo $row['idgejala']; ?>">
                                                </td>
                                                <td class="text-center"><?php echo $no++ ?></td>
                                                <td><?php echo $row['nmgejala']; ?></td>
                                                <td>
                                                    <!-- <button class="btn btn-secondary"> -->
                                                        <!-- <i class="fas fa-trash"></i> Hapus -->
                                                    <!-- </button> -->
                                                </td>
                                            </tr>
                                    <?php
                                        }
                                    }
                                    $conn->close();
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- tabel gejala -->

                        <input class="btn btn-primary" type="submit" name="update" value="Update">
                        <a class="btn btn-danger" href="?page=aturan">Batal</a>


                    </div>
                </div>
        </form>
    </div>
</div>