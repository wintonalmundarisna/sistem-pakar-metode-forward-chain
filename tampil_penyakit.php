<div class="card">
    <div class="card-header bg-primary text-white border-dark"><strong>DATA PENYAKIT</strong></div>
    <div class="card-body">
        <a class="btn btn-primary mb-2" href="?page=penyakit&action=tambah"><i class="fas fa-plus"></i> Tambah</a>

        <!-- menggunakan jquery bernama dataTables -->
        <table class="table table-bordered" id="myTable">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center w-25">Nama Penyakit</th>
                    <th class="text-center">Keterangan</th>
                    <th class="text-center">Solusi</th>
                    <th class="w-25 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- proses menampilkan data -->
                <?php
                $nomer = 1;
                $sql = "SELECT * FROM penyakit ORDER BY nmpenyakit ASC";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td class="text-center"><?php echo $nomer++; ?></td>
                        <td class="text-center"><?php echo $row['nmpenyakit']; ?></td>
                        <td class="text-center"><?php echo $row['keterangan']; ?></td>
                        <td class="text-center"><?php echo $row['solusi']; ?></td>
                        <td class="d-flex justify-content-around">
                            <a class="btn btn-warning" href="?page=penyakit&action=update&id=<?php echo $row['idpenyakit']; ?>">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <a onclick="return confirm('Yakin menghapus data ini ?')" class="btn btn-danger" href="?page=penyakit&action=hapus&id=<?php echo $row['idpenyakit']; ?>">
                                <i class="fas fa-trash"></i> Hapus
                            </a>
                        </td>
                    </tr>
                <?php
                }
                $conn->close();
                ?>

            </tbody>
        </table>
    </div>
</div>