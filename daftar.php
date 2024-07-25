<?php
$pesan="";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    include "config/database.php";

    // Generate random kode_pengguna between 0 and 100000
    $kode_pengguna = rand(0, 100000);
    $nama_pengguna = input($_POST["nama_pengguna"]);
    $email = input($_POST["email"]);
    $no_telp = input($_POST["no_telp"]);
    $username = input($_POST["username"]);
    $password = input(md5($_POST["password"]));  // Hash password menggunakan md5
    $status = 1; // Default status pengguna aktif

    // Cek apakah username sudah ada
    $cek_username = "SELECT * FROM pengguna WHERE username='".$username."' LIMIT 1";
    $hasil_cek = mysqli_query($kon, $cek_username);
    $jumlah = mysqli_num_rows($hasil_cek);

    if ($jumlah > 0) {
        $pesan="<div class='alert alert-danger'><strong>Error!</strong> Username sudah digunakan.</div>";
    } else {
        // Insert data ke tabel pengguna
        $sql = "INSERT INTO pengguna (kode_pengguna, nama_pengguna, email, no_telp, username, password, status) VALUES ('$kode_pengguna', '$nama_pengguna', '$email', '$no_telp', '$username', '$password', '$status')";

        if (mysqli_query($kon, $sql)) {
            $pesan="<div class='alert alert-success'><strong>Sukses!</strong> Pendaftaran berhasil. <a href='index.php?halaman=login'>Login disini!</a></div>";
        } else {
            $pesan="<div class='alert alert-danger'><strong>Error!</strong> Pendaftaran gagal.</div>";
        }
    }
}
?>

<div class="card mb-4">
  <div class="card-header">Halaman Pendaftaran</div>
  <div class="card-body">
    <?php if ($_SERVER["REQUEST_METHOD"] == "POST") echo $pesan; ?>
    <div class="row">
      <div class="col-sm-5">
        <form action="index.php?halaman=daftar" method="post">
          <div class="form-group">
            <label for="nama_pengguna">Nama Pengguna:</label>
            <input type="text" class="form-control" name="nama_pengguna" placeholder="Masukan nama pengguna" required>
          </div>
          <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" name="email" placeholder="Masukan email" required>
          </div>
          <div class="form-group">
            <label for="no_telp">No. Telp:</label>
            <input type="text" class="form-control" name="no_telp" placeholder="Masukan no. telp" required>
          </div>
          <div class="form-group">
            <label for="username">Username:</label>
            <input type="text" class="form-control" name="username" placeholder="Masukan username" required>
          </div>
          <div class="form-group">
            <label for="pwd">Password:</label>
            <input type="password" name="password" class="form-control" placeholder="Masukan password" required>
          </div>
          <button type="submit" class="btn btn-primary">Daftar</button>
        </form>
      </div>
    </div>
  </div>
</div>
