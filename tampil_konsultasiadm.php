<div class="card">
    <div class="card-header bg-primary text-white border-dark"><strong>Hasil Konsultasi</strong></div>
    <div class="card-body">

        <!-- menggunakan jquery bernama dataTables -->
        <table class="table table-bordered" id="myTable">
            <thead>
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center w-25">Tanggal</th>
                    <th class="text-center">Nama Pasien</th>
                    <th class="text-center" width="250px">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <!-- proses menampilkan data -->
                <?php
                $nomer = 1;
                $sql = "SELECT * FROM konsultasi ORDER BY tanggal DESC, nama ASC";
                $result = $conn->query($sql);
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td class="text-center"><?php echo $nomer++; ?></td>
                        <td class="text-center"><?php echo $row['tanggal']; ?></td>
                        <td class="text-center"><?php echo $row['nama']; ?></td>
                        <td class="d-flex justify-content-center">
                            <a class="btn btn-success" href="?page=konsultasiadm&action=detail&id=<?php echo $row['idkonsultasi']; ?>">
                                <i class="fas fa-eye"></i> Detail
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