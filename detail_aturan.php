<!-- proses memanggil data dari basis_aturan -->
<?php

// mengambil id dari params
$id_aturan = $_GET['id'];

// ambil idaturan  dan idpenyakit dari basis_aturan dan nmpenyakit, keterangan dari tabel penyakit
// Gabungkan dari basis_aturan ke penyakit dalam basis_aturan.idpenyakit = penyakit.idpenyakit
// dimana id basis_aturan = id_aturan dari params
$sql = "SELECT basis_aturan.idaturan, basis_aturan.idpenyakit, penyakit.nmpenyakit, penyakit.keterangan 
        FROM basis_aturan INNER JOIN penyakit ON basis_aturan.idpenyakit = penyakit.idpenyakit
        WHERE basis_aturan.idaturan = '$id_aturan'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>DETAIL BASIS ATURAN</strong></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nmpenyakit">Nama Penyakit</label>
                            <input type="text" id="nmpenyakit" class="form-control" readonly value="<?php echo $row['nmpenyakit'] ?>" name="nmpenyakit" required>
                        </div>
                        <div class="form-group">
                            <label for="keterangan">Keterangan</label>
                            <input type="text" class="form-control" readonly id="keterangan" value="<?php echo $row['keterangan'] ?>" name="keterangan" required>
                        </div>
                        <div class="form-group">
                            <label for="gejala">Gejala</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="50px" class="text-center">No</th>
                                        <th>Nama Gejala</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $nomer = 1;

                                        // ambil idaturan, idgejala dari detail_basis_aturan dan nmgejala dari gejala yang digabungkan dengan gejala diatas idgejala dari detail_basis_aturan = gejala.idgejala
                                        // dimana detail_basis_aturan.idaturan = $id_aturan
                                        $sql = "SELECT detail_basis_aturan.idaturan, detail_basis_aturan.idgejala, gejala.nmgejala 
                                            FROM detail_basis_aturan
                                            INNER JOIN gejala ON detail_basis_aturan.idgejala = gejala.idgejala 
                                            WHERE detail_basis_aturan.idaturan = '$id_aturan'";
                                        $result = $conn->query($sql);
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                    <tr>
                                        <td class="text-center"><?php echo $nomer++; ?></td>
                                        <td class=""><?php echo $row['nmgejala']; ?></td>
                                    </tr>
                                <?php
                                        }
                                        $conn->close();
                                ?>
                                </tr>
                                </tbody>
                            </table>
                        </div>

                        <a class="btn btn-danger" href="?page=aturan">Kembali</a>

                    </div>
                </div>
        </form>
    </div>
</div>