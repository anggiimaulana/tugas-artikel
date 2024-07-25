<?php
if (isset($_POST['form_kritik'])) {
    // Include file koneksi, untuk koneksikan ke database
    include 'config/database.php';
    
    // Fungsi untuk mencegah inputan karakter yang tidak sesuai
    function input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $email = input($_POST["email"]);
    $isi_kritik = input($_POST["isi_kritik"]);
    $status=input($_POST["status"]);

    // Query input menginput data kedalam tabel 
    $sql = "INSERT INTO kritik (email, isi_kritik, status) VALUES ('$email', '$isi_kritik', '$status')";
    // Mengeksekusi/menjalankan query 
    $hasil = mysqli_query($kon, $sql);
    
    // Ambil data kategori untuk redireksi
    $sql = "SELECT * FROM kategori";
    $result = mysqli_query($kon, $sql);
    $data = mysqli_fetch_array($result);

    // Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
    if ($hasil) {
        header("Location:index.php?halaman=home&kategori=" . $data['id_kategori'] . "&kritik_berhasil");
    } else {
        header("Location:index.php?halaman=home&kategori=" . $data['id_kategori'] . "&kritik_gagal");
    }
}
?>
