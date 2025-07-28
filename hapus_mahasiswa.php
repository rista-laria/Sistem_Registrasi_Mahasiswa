<?php
include 'db.php';

if (!isset($_GET['nim'])) {
    die("NIM tidak ditemukan.");
}

$nim = $_GET['nim'];

// Hapus data
mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim = '$nim'");

header("Location: dashboard_admin.php");
exit;
?>
