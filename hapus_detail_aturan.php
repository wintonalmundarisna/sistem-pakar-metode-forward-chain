<?php

// ambil dari param
$id_aturan = $_GET['idaturan'];
$id_gejala = $_GET['idgejala'];

var_dump($id_aturan, $id_gejala);

$sql = "DELETE FROM detail_basis_aturan WHERE idaturan='$id_aturan' AND idgejala='$id_gejala'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=aturan");
}
$conn->close();
