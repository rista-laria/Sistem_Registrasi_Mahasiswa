<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 'mahasiswa') {
    header("Location: login.php");
    exit;
}
$data = $_SESSION['user'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .profile-card {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            padding: 30px;
            border-radius: 10px;
        }
        .footer {
            background-color: #343a40;
            color: white;
            padding: 20px 0;
            position: absolute;
            bottom: 0;
            width: 100%;
        }
        .footer a {
            color: #ffc107;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
  <div class="container">
    <a class="navbar-brand" href="#">Sistem Registrasi</a>
    <div class="d-flex">
      <a href="logout.php" class="btn btn-outline-danger">Logout</a>
    </div>
  </div>
</nav>

<div class="profile-card">
    <h3 class="mb-4">Profil Mahasiswa</h3>
    <div class="row">
        <div class="col-md-4 text-center">
            <img src="uploads/<?= htmlspecialchars($data['foto']) ?>" alt="Foto Mahasiswa" class="img-thumbnail" style="width: 200px;">
        </div>
        <div class="col-md-8">
            <table class="table">
                <tr>
                    <th>NIM</th>
                    <td><?= htmlspecialchars($data['nim']) ?></td>
                </tr>
                <tr>
                    <th>Nama</th>
                    <td><?= htmlspecialchars($data['nama']) ?></td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td><?= htmlspecialchars($data['email']) ?></td>
                </tr>
                <tr>
                    <th>Program Studi</th>
                    <td><?= htmlspecialchars($data['prodi']) ?></td>
                </tr>
                <tr>
                    <th>Fakultas</th>
                    <td><?= htmlspecialchars($data['fakultas']) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>

<div class="footer mt-5">
    <div class="container text-center">
        <div>© <?= date('Y') ?> Sistem Registrasi Mahasiswa</div>
        <div>
            <a href="#">Tentang</a> |
            <a href="#">Kontak</a> |
            <a href="#">Kebijakan</a>
        </div>
    </div>
</div>

</body>
</html>
