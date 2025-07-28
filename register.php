<?php
include 'db.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $prodi = $_POST['prodi'];
    $fakultas = $_POST['fakultas'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $foto = $_FILES['foto']['name'];
    $tmp = $_FILES['foto']['tmp_name'];
    $folder = "uploads/" . $foto;

    // Validasi NIM dan Email
    $cek = mysqli_query($conn, "SELECT * FROM mahasiswa WHERE nim='$nim' OR email='$email'");
    if (mysqli_num_rows($cek) > 0) {
        $error = "NIM atau Email sudah terdaftar!";
    } else {
        move_uploaded_file($tmp, $folder);
        $sql = "INSERT INTO mahasiswa (nim, nama, email, prodi, fakultas, password, foto) VALUES 
            ('$nim', '$nama', '$email', '$prodi', '$fakultas', '$password', '$foto')";
        if (mysqli_query($conn, $sql)) {
            $success = "Registrasi berhasil. <a href='login.php'>Login sekarang</a>";
        } else {
            $error = "Error: " . mysqli_error($conn);
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Registrasi Mahasiswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            padding-top: 50px;
        }
        .register-box {
            background: white;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 600px;
        }
        .form-control {
            margin-bottom: 15px;
        }
    </style>
</head>
<body>
    <div class="register-box">
        <h3 class="text-center mb-4">Form Registrasi Mahasiswa</h3>

        <?php if (isset($error)) : ?>
            <div class="alert alert-danger"><?= $error; ?></div>
        <?php elseif (isset($success)) : ?>
            <div class="alert alert-success"><?= $success; ?></div>
        <?php endif; ?>

        <form method="post" enctype="multipart/form-data" autocomplete="off">
            <input type="text" name="nim" class="form-control" placeholder="NIM" required>
            <input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" required>
            <input type="email" name="email" class="form-control" placeholder="Email Aktif" required>
            <input type="text" name="prodi" class="form-control" placeholder="Program Studi" required>
            <input type="text" name="fakultas" class="form-control" placeholder="Fakultas" required>
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <input type="file" name="foto" class="form-control" accept="image/*" required>

            <button type="submit" class="btn btn-success w-100">Daftar</button>
        </form>
    </div>
</body>
</html>
