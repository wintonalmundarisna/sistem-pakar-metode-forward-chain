<?php

// ambil dari param
$NAMA_VAR = $_GET['id'];

$sql = "DELETE FROM penyakit WHERE idpenyakit='$NAMA_VAR'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=penyakit");
}
$conn->close();
