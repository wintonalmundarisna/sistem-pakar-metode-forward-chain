<!-- proses -->
<?php
// mengambil id dari params
$id_konsultasi = $_GET['id'];

$sql = "SELECT * FROM konsultasi WHERE idkonsultasi = '$id_konsultasi'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>HASIL KONSULTASI</strong></div>
                    <div class="card-body">

                        <div class="form-group">
                            <label for="nama">Nama Pasien</label>
                            <input type="text" id="nama" class="form-control" readonly value="<?php echo $row['nama'] ?>" name="nmpenyakit" required>
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
                                    <?php
                                    $nomer = 1;

                                    $sql2 = "SELECT detail_konsultasi.idkonsultasi, detail_konsultasi.idgejala, gejala.nmgejala 
                                            FROM detail_konsultasi
                                            INNER JOIN gejala ON detail_konsultasi.idgejala = gejala.idgejala 
                                            WHERE idkonsultasi = '$id_konsultasi'";
                                    $result2 = $conn->query($sql2);
                                    while ($row2 = $result2->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $nomer++; ?></td>
                                            <td class=""><?php echo $row2['nmgejala']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    // $conn->close();
                                    ?>
                                </tbody>
                            </table>

                            <!-- Penyakitnya -->
                            <label for="nmpenyakit">Penyakit</label>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th width="50px" class="text-center">No</th>
                                        <th>Nama Penyakit</th>
                                        <th>Persentase</th>
                                        <th>Solusi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php
                                        $nomer = 1;

                                        $sql3 = "SELECT detail_penyakit.idkonsultasi, detail_penyakit.idpenyakit, penyakit.nmpenyakit, penyakit.solusi, detail_penyakit.persentase 
                                            FROM detail_penyakit
                                            INNER JOIN penyakit ON detail_penyakit.idpenyakit = penyakit.idpenyakit 
                                            WHERE idkonsultasi = '$id_konsultasi' ORDER BY persentase DESC";
                                        $result3 = $conn->query($sql3);
                                        while ($row3 = $result3->fetch_assoc()) {
                                        ?>
                                    </tr>
                                    <tr>
                                        <td class="text-center"><?php echo $nomer++; ?></td>
                                        <td class=""><?php echo $row3['nmpenyakit']; ?></td>
                                        <td class="" align="center"><?php echo $row3['persentase'] . "%"; ?></td>
                                        <td class=""><?php echo $row3['solusi']; ?></td>
                                    </tr>
                                <?php
                                        }
                                        $conn->close();
                                ?>
                                </tbody>
                            </table>
                            <a class="btn btn-danger" href="?page=konsultasiadm">Kembali</a>

                            <!-- Penyakitnya -->
                        </div>

                        <!-- <a class="btn btn-danger" href="?page=aturan">Kembali</a> -->

                    </div>
                </div>
        </form>
    </div>
</div>