<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'admin') {
    header("Location: login.php");
    exit;
}

include 'db.php';

$query = "SELECT * FROM mahasiswa WHERE role = 'mahasiswa'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <h2 class="mb-4">Admin Registrasi Data!</h2>
    <p><strong>Email:</strong> <?= $_SESSION['user']['email'] ?></p>
    <a href="logout.php" class="btn btn-danger mb-3">Logout</a>

    <h4>Data Mahasiswa</h4>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Foto</th>
                <th>NIM</th>
                <th>Nama</th>
                <th>Prodi</th>
                <th>Fakultas</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        <?php $no = 1; while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td><?= $no++ ?></td>
                <td>
                    <?php if (!empty($row['foto'])): ?>
                        <img src="uploads/<?= $row['foto'] ?>" width="50" height="50" style="object-fit:cover;">
                    <?php else: echo '-'; endif; ?>
                </td>
                <td><?= $row['nim'] ?></td>
                <td><?= $row['nama'] ?></td>
                <td><?= $row['prodi'] ?></td>
                <td><?= $row['fakultas'] ?></td>
                <td><?= $row['email'] ?></td>
                <td>
                    <a href="edit_mahasiswa.php?nim=<?= $row['nim'] ?>" class="btn btn-warning btn-sm">Edit</a>
                    <a href="hapus_mahasiswa.php?nim=<?= $row['nim'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</body>
</html>
