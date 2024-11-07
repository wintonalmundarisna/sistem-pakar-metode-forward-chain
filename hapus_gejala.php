<?php

// ambil dari param
$NAMA_VAR = $_GET['id'];

$sql = "DELETE FROM gejala WHERE idgejala='$NAMA_VAR'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=gejala");
}
$conn->close();
