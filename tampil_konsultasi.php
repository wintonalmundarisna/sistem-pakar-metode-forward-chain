<?php

date_default_timezone_set('Asia/Jakarta');

if (isset($_POST['proses'])) {
    // mengambil data dari form
    $namaPasien = $_POST['nama'];
    $tgl = date('Y/m/d');
    $id_gejala = $_POST['idgejala'];

    //proses simpan konsultasi
    $sql = "INSERT INTO konsultasi VALUES (null,'$tgl','$namaPasien')";
    mysqli_query($conn, $sql);

    // proses ambil data konsultasi
    $sql2 = "SELECT * FROM konsultasi ORDER BY idkonsultasi DESC";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_assoc();
    $id_konsultasi = $row2['idkonsultasi'];

    // proses simpan detail_konsultasi
    $jmlDicentang = count($id_gejala);
    $i = 0;
    while ($i < $jmlDicentang) {
        $pecahIdGejalaArray = $id_gejala[$i];
        $sql4 = "INSERT INTO detail_konsultasi VALUES ('$id_konsultasi', '$pecahIdGejalaArray')";
        mysqli_query($conn, $sql4);
        $i++;
    }

    // proses simpan detail_penyakit
    // Mengambil data tabel penyakit untuk di cek di tabel basis aturan
    $sql = "SELECT * FROM penyakit";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $id_penyakit = $row['idpenyakit'];
        // $nmpenyakit = $row['nmpenyakit'];
        $jyes = 0;

        // mencari jumlah gejala di basis aturan berdasarkan penyakitnya, agar mendapatkan presentase
        $sql2 = "SELECT COUNT(idpenyakit) AS jml_gejala
                FROM basis_aturan INNER JOIN detail_basis_aturan ON basis_aturan.idaturan = detail_basis_aturan.idaturan WHERE idpenyakit = '$id_penyakit'";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        $jml_gejala = $row2['jml_gejala'];

        // mencari gejala pada detail_basis_aturan untuk dibandingkan
        $sql3 = "SELECT idpenyakit, idgejala
                FROM basis_aturan INNER JOIN detail_basis_aturan ON basis_aturan.idaturan = detail_basis_aturan.idaturan WHERE idpenyakit = '$id_penyakit'";
        $result3 = $conn->query($sql3);
        while ($row3 = $result3->fetch_assoc()) {

            $id_gejala3 = $row3['idgejala'];

            // membandingkan apakah yang dipilih pada konsultasi sudah sesuai
            $sql4 = "SELECT idgejala
                    FROM detail_konsultasi WHERE idkonsultasi = '$id_konsultasi' AND idgejala = '$id_gejala3'";
            $result4 = $conn->query($sql4);
            if ($result4->num_rows > 0) {
                $jyes += 1;
            }
        }

        // Mencari persentase
        if ($jml_gejala > 0) {
            $peluang = round(($jyes / $jml_gejala) * 100, 2);
        } else {
            $peluang = 0;
        }

        // Simpan data detail penyakit
        if ($peluang > 0) {
            $sql = "INSERT INTO detail_penyakit VALUES ($id_konsultasi,'$id_penyakit','$peluang')";
            mysqli_query($conn, $sql);
        }
        header("Location:?page=konsultasi&action=hasil&idkonsultasi=$id_konsultasi");
    }
}

?>

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="Form" onsubmit="return validasiGejala()">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>KONSULTASI PENYAKIT</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama">Nama Pasien</label>
                            <input type="text" class="form-control" name="nama" id="nama" autofocus maxlength="200" required>
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
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM gejala ORDER BY nmgejala ASC";
                                    $result = $conn->query($sql);
                                    $no = 1;
                                    while ($row = $result->fetch_assoc()) {
                                    ?>
                                        <tr>
                                            <td class="text-center">
                                                <!-- name, ambil idgejala lalu simpan ke dalam array -->
                                                <input type="checkbox" class="check-item" name="<?php echo 'idgejala[]'; ?>" value="<?php echo $row['idgejala']; ?>">
                                            </td>
                                            <td class="text-center"><?php echo $no++ ?></td>
                                            <td><?php echo $row['nmgejala']; ?></td>
                                        </tr>
                                    <?php
                                    }
                                    $conn->close();
                                    ?>

                                </tbody>
                            </table>
                        </div>
                        <!-- tabel gejala -->

                        <input class="btn btn-primary" type="submit" name="proses" value="Proses">
                    </div>
                </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function validasiGejala() {
        // validasi gejala minimal pilih satu, gaboleh kosong
        let namaGejala = document.getElementsByName('<?php echo 'idgejala[]'; ?>');
        let isChecked = false;
        for (let i = 0; i < namaGejala.length; i++) {
            if (namaGejala[i].checked) {
                isChecked = true;
                break;
            }
        }

        // jika belum ada yang di cek
        if (!isChecked) {
            alert("Minimal pilih satu gejala");
            return false;
        }

        return true;
    }
</script>