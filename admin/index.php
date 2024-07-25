<?php 
  session_start();
  if (!$_SESSION["id_pengguna"]){
        header('Location:../index.php?halaman=login&pesan=login_dulu');
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Halaman Adminstrartor</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <?php
        include '../config/database.php';
        $ambil_kategori = mysqli_query ($kon,"select * from profil limit 1");
        $row = mysqli_fetch_assoc($ambil_kategori); 
        $nama_website = $row['nama_website'];
        $copy_right = $row['nama_website'];
    ?>
    <a 
        style="font-size: 22px; margin-left: 20px; font-style: italic; font-weight: 600; background: linear-gradient(to right, #ff0b0b, #fff, #ccc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;" class="navbar-brand" href="#"><?php echo $nama_website;?>
    </a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
        <ul class="navbar-nav  ml-auto">
        <li class="text-light" style=" margin-right: 20px;">Login Sebagai :  <?php echo $_SESSION["nama_pengguna"]; ?> </li>
        </ul>
    </div>
   
</nav>
<div class="jumbotron text-center">
<?php 
if(isset($_GET['halaman']) && !isset($_GET['kategori'])){
    $halaman = $_GET['halaman'];
   echo "<h1>".ucwords($halaman)."</h1>";
}

if(isset($_GET['halaman']) &&  isset($_GET['kategori'])){

    include '../config/database.php';
    $ambil_kategori = mysqli_query ($kon,"select * from kategori where id_kategori='".$_GET['kategori']."' limit 1");
    $row = mysqli_fetch_assoc($ambil_kategori); 
    $kategori = $row['nama_kategori'];
    $halaman = $_GET['halaman'];
   echo "<h1>".ucwords($halaman)." ".ucwords($kategori)."</h1>";
}
?>
</div>
<div class="container">
    <div class="row">
        <div class="col-sm-2">
            <div class="list-group">
                <a href="index.php?halaman=kategori" class="list-group-item list-group-item-action">Artikel</a>
                <a href="index.php?halaman=komentar" class="list-group-item list-group-item-action">Komentar</a>
                <a href="index.php?halaman=kritik-saran" class="list-group-item list-group-item-action">Kritik & Saran</a>
                <a href="index.php?halaman=admin" class="list-group-item list-group-item-action">Admin</a>
                <a href="index.php?halaman=profil" class="list-group-item list-group-item-action">Profil</a>
                <a href="logout.php" class="list-group-item list-group-item-action">Logout</a>
            </div>
        </div> 
        <div class="col-sm-10">
        <?php 
            if(isset($_GET['halaman'])){
                $halaman = $_GET['halaman'];
                switch ($halaman) {
                    case 'kategori':
                        include "artikel/kategori.php";
                        break;
                    case 'artikel':
                        include "artikel/index.php";
                        break;
                    case 'komentar':
                        include "komentar/index.php";
                        break;
                    case 'kritik-saran':
                        include "kritik/index.php";
                        break;
                    case 'admin':
                        include "admin/index.php";
                        break;
                    case 'profil':
                        include "profil/index.php";
                        break;
                    default:
                    echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
                    break;
                }
            }else {
                include "dashboard.php";
            }
        ?>
        </div>
    </div>
    <br>
</div>
<section>
    <footer class="footer-user bg-dark" style=" padding: 20px;">
        <div class="container" style="color: #ccc;">

            <hr> 
            <div class="row">
                <div class="col text-center">
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-c-circle" viewBox="0 0 16 16">
                            <path d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.146 4.992c-1.212 0-1.927.92-1.927 2.502v1.06c0 1.571.703 2.462 1.927 2.462.979 0 1.641-.586 1.729-1.418h1.295v.093c-.1 1.448-1.354 2.467-3.03 2.467-2.091 0-3.269-1.336-3.269-3.603V7.482c0-2.261 1.201-3.638 3.27-3.638 1.681 0 2.935 1.054 3.029 2.572v.088H9.875c-.088-.879-.768-1.512-1.729-1.512"/>
                        </svg> 
                        Copyright 
                        <span>
                            <a 
                                style="font-size: 18px; font-style: italic; font-weight: 600; background: linear-gradient(to right, #ff0b0b, #fff, #ccc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;" class="navbar-brand" href="#"><?php echo $nama_website;?>
                            </a>
                        </span> 
                        2024
                    </p>
                </div>
            </div>
        </div>
    </footer>
</section>
</body>
</html>
