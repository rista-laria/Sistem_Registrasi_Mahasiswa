<?php
include 'db.php';

if (!isset($_GET['nim'])) {
    die("NIM tidak ditemukan.");
}

$nim = $_GET['nim'];
$query = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim = '$nim'");
$data = mysqli_fetch_assoc($query);

if (!$data) {
    die("Data tidak ditemukan.");
}

if (isset($_POST['simpan'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $prodi = $_POST['prodi'];
    $fakultas = $_POST['fakultas'];

    mysqli_query($conn, "UPDATE mahasiswa SET 
        nama='$nama', email='$email', prodi='$prodi', fakultas='$fakultas' 
        WHERE nim='$nim'");

    header("Location: dashboard_admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2>Edit Data Mahasiswa</h2>
    <form method="POST">
        <div class="mb-2">
            <label>NIM</label>
            <input type="text" name="nim" class="form-control" value="<?= $data['nim'] ?>" readonly>
        </div>
        <div class="mb-2">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
        </div>
        <div class="mb-2">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required>
        </div>
        <div class="mb-2">
            <label>Prodi</label>
            <input type="text" name="prodi" class="form-control" value="<?= $data['prodi'] ?>">
        </div>
        <div class="mb-2">
            <label>Fakultas</label>
            <input type="text" name="fakultas" class="form-control" value="<?= $data['fakultas'] ?>">
        </div>
        <button type="submit" name="simpan" class="btn btn-primary">Simpan Perubahan</button>
        <a href="dashboard_admin.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>
