<?php
// Inisialisasi variabel input & error
$nama = $email = $nomor = $jenis = $keluhan = $alamat = "";
$namaErr = $emailErr = $nomorErr = $jenisErr = $keluhanErr = $alamatErr = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi Nama
    $nama = trim($_POST["nama"]);
    if (empty($nama)) {
        $namaErr = "Nama wajib diisi";
    }

    // Validasi Email
    $email = trim($_POST["email"]);
    if (empty($email)) {
        $emailErr = "Email wajib diisi";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Format email tidak valid";
    }

    // Validasi Nomor Telepon
    $nomor = trim($_POST["nomor"]);
    if (empty($nomor)) {
        $nomorErr = "Nomor telepon wajib diisi";
    } elseif (!ctype_digit($nomor)) {
        $nomorErr = "Nomor telepon hanya boleh angka";
    }

    // Validasi Jenis Perangkat
    $jenis = $_POST["jenis"] ?? "";
    if (empty($jenis)) {
        $jenisErr = "Pilih jenis perangkat";
    }

    // Validasi Keluhan
    $keluhan = trim($_POST["keluhan"]);
    if (empty($keluhan)) {
        $keluhanErr = "Keluhan wajib diisi";
    }

    // Validasi Alamat
    $alamat = trim($_POST["alamat"]);
    if (empty($alamat)) {
        $alamatErr = "Alamat wajib diisi";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pemesanan Teknisi Online</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Form Pemesanan Teknisi Online</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="nama">Nama:</label>
        <input type="text" name="nama" value="<?php echo $nama; ?>">
        <span class="error"><?php echo $namaErr ? "* $namaErr" : ""; ?></span>

        <label for="email">Email:</label>
        <input type="text" name="email" value="<?php echo $email; ?>">
        <span class="error"><?php echo $emailErr ? "* $emailErr" : ""; ?></span>

        <label for="nomor">Nomor Telepon:</label>
        <input type="text" name="nomor" value="<?php echo $nomor; ?>">
        <span class="error"><?php echo $nomorErr ? "* $nomorErr" : ""; ?></span>

        <label for="jenis">Jenis Perangkat:</label>
        <select name="jenis">
            <option value="">-- Pilih --</option>
            <option value="Laptop" <?php if ($jenis=="Laptop") echo "selected"; ?>>Laptop</option>
            <option value="PC" <?php if ($jenis=="PC") echo "selected"; ?>>PC</option>
            <option value="Printer" <?php if ($jenis=="Printer") echo "selected"; ?>>Printer</option>
            <option value="Smartphone" <?php if ($jenis=="Smartphone") echo "selected"; ?>>Smartphone</option>
        </select>
        <span class="error"><?php echo $jenisErr ? "* $jenisErr" : ""; ?></span>

        <label for="keluhan">Keluhan:</label>
        <textarea name="keluhan"><?php echo $keluhan; ?></textarea>
        <span class="error"><?php echo $keluhanErr ? "* $keluhanErr" : ""; ?></span>

        <label for="alamat">Alamat Servis:</label>
        <textarea name="alamat"><?php echo $alamat; ?></textarea>
        <span class="error"><?php echo $alamatErr ? "* $alamatErr" : ""; ?></span>

        <div class="button-container">
            <button type="submit">Pesan Teknisi</button>
        </div>
    </form>

    <?php if ($_SERVER["REQUEST_METHOD"] == "POST" && !$namaErr && !$emailErr && !$nomorErr && !$jenisErr && !$keluhanErr && !$alamatErr): ?>
        <h3>Data Pemesanan:</h3>
        <div class="table-container">
            <table>
                <tr>
                    <th>Nama</th>
                    <th>Email</th>
                    <th>Nomor Telepon</th>
                    <th>Jenis Perangkat</th>
                    <th>Keluhan</th>
                    <th>Alamat</th>
                </tr>
                <tr>
                    <td><?php echo $nama; ?></td>
                    <td><?php echo $email; ?></td>
                    <td><?php echo $nomor; ?></td>
                    <td><?php echo $jenis; ?></td>
                    <td><?php echo $keluhan; ?></td>
                    <td><?php echo $alamat; ?></td>
                </tr>
            </table>
        </div>
    <?php endif; ?>
</div>
</body>
</html>
