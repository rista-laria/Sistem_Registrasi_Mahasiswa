<?php
include 'db.php';
$nim = $_GET['nim'];
mysqli_query($conn, "DELETE FROM mahasiswa WHERE nim='$nim'");
header("Location: dashboard_admin.php");
