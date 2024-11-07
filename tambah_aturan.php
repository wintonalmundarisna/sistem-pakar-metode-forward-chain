<!-- proses tambah aturan -->
<?php

if (isset($_POST['simpan'])) {
    $nama_penyakit = $_POST['nmpenyakit'];
    $id_gejala = $_POST['idgejala'];

    // Cek duplikat input
    $sql = "SELECT basis_aturan.idaturan, basis_aturan.idpenyakit, penyakit.nmpenyakit FROM basis_aturan INNER JOIN penyakit ON basis_aturan.idpenyakit = penyakit.idpenyakit WHERE nmpenyakit='$nama_penyakit'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Aturan sudah ada</strong>
        </div>
<?php
    } else {
        // ambil id penyakit karena value inputan isinya nmpenyakit
        $sql = "SELECT * FROM penyakit WHERE nmpenyakit = '$nama_penyakit'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $id_penyakit = $row['idpenyakit'];

        //proses simpan basis_aturan
        $sql3 = "INSERT INTO basis_aturan VALUES (null,'$id_penyakit')";
        mysqli_query($conn, $sql3);


        // ambil id basis_aturan, DESC agar ambil terakhir
        $sql2 = "SELECT * FROM basis_aturan ORDER BY idaturan DESC";
        $result2 = $conn->query($sql2);
        $row2 = $result2->fetch_assoc();
        $id_aturan = $row2['idaturan'];

        // proses simpan detail_basis_aturan
        // berapa jumlah gejala yang dicentang
        $jmlDicentang = count($id_gejala);
        $i = 0;
        while ($i < $jmlDicentang) {
            $pecahIdGejalaArray = $id_gejala[$i];
            $sql4 = "INSERT INTO detail_basis_aturan VALUES ('$id_aturan', '$pecahIdGejalaArray')";
            mysqli_query($conn, $sql4);
            $i++;
        }
        header("Location:?page=aturan");
    }
}

?>
<!-- proses tambah aturan -->

<div class="row">
    <div class="col-sm-12">
        <form action="" method="POST" name="Form" onsubmit="return validasiGejala()">
            <div class="card border-dark">
                <div class="card">
                    <div class="card-header bg-primary text-white border-dark"><strong>TAMBAH BASIS ATURAN</strong></div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nmpenyakit">Nama Penyakit</label>
                            <select class="form-control chosen" data-placeholder="Pilih Penyakit" id="nmpenyakit" name="nmpenyakit">
                                <option selected disabled></option>
                                <?php
                                $sql = "SELECT * FROM penyakit ORDER BY nmpenyakit ASC";
                                $result = $conn->query($sql);
                                while ($row = $result->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $row['nmpenyakit']; ?>"><?php echo $row['nmpenyakit']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
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

                        <input class="btn btn-primary" type="submit" name="simpan" value="Simpan">
                        <a class="btn btn-danger" href="?page=aturan">Batal</a>


                    </div>
                </div>
        </form>
    </div>
</div>

<script type="text/javascript">
    function validasiGejala() {
        // validasi nama penyakit apakah kosong atau sudah diisi
        let namaPenyakit = document.forms["Form"]["nmpenyakit"].value;
        if (namaPenyakit == "") {
            alert("Pilih nama penyakit");
            return false;
        }

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


<!-- Menggunakan select chosen karena ada searchnya -->
<!-- cuma butuh css, js, function pada index...Tambahkan juga chosen pada select -->