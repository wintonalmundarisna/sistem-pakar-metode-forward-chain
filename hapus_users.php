<?php

// ambil dari param
$id_users = $_GET['id'];

$sql = "DELETE FROM users WHERE idusers='$id_users'";
if ($conn->query($sql) === TRUE) {
    header("Location:?page=users");
}
$conn->close();
