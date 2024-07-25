<!DOCTYPE html>
<html lang="en">
<head>
    <title>Beritaku</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-EXAMPLE_HASH" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>
<body>
<!-- style="background: #F6F8FD;" -->
<nav class="navbar navbar-expand-md bg-dark navbar-dark">
    <!-- Brand -->
    <?php
        include 'config/database.php';
        $ambil_kategori = mysqli_query ($kon,"select * from profil limit 1");
        $row = mysqli_fetch_assoc($ambil_kategori); 
        $nama_website = $row['nama_website'];
        $copy_right = $row['nama_website'];
    ?>
    <a 
        style="font-size: 22px; margin-left: 20px; font-style: italic; font-weight: 600; background: linear-gradient(to right, #ff0b0b, #fff, #ccc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;" class="navbar-brand" href="index.php?halaman=home"><?php echo $nama_website;?>
    </a>

    <!-- Toggler/collapsibe Button -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
        <span class="navbar-toggler-icon"></span>
    </button>

    <!-- Navbar links -->
    <div class="collapse navbar-collapse ml-3" id="collapsibleNavbar">
        
        <ul class="navbar-nav">
        <?php
         
            include 'config/database.php';
            $sql="select * from kategori";
            $hasil=mysqli_query($kon,$sql);
            while ($data = mysqli_fetch_array($hasil)):
        ?>
            <li class="nav-item">
                <a class="nav-link" href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>"><?php echo $data['nama_kategori'];?></a>
            </li>
            <?php endwhile; ?>
        </ul>
        <ul class="navbar-nav ml-auto mr-4">
            <?php 
                session_start();
                if (isset($_SESSION["id_pengguna"])) {
                    echo "<li><a class='nav-link' href='admin/index.php?halaman=kategori'>Halaman Admin</a></li>";
                } else {
                    echo "<li><a class='nav-link' href='index.php?halaman=login'><span class='fas fa-log-in'></span> Login</a></li>";
                    // echo "<li><a class='nav-link' href='index.php?halaman=daftar'><span class='fas fa-user-plus'></span> Daftar</a></li>";
                }
            ?>
        </ul>

    </div>
   
</nav>
<div class="jumbotron text-center">

<?php
    $judul="Selamat Datang";   
    include 'config/database.php';
    if (isset($_GET['id'])) {
        $sql="select * from artikel where status=1 and id_artikel=".$_GET['id']."";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['judul_artikel'];  
    }else if (isset($_GET['kategori'])){
        $sql="select * from kategori where id_kategori=".$_GET['kategori']."";
        $hasil=mysqli_query($kon,$sql);
        $data = mysqli_fetch_array($hasil);
        $judul=$data['nama_kategori'];  
    }

    

?>
    <h1><?php echo $judul;?></h1>

</div>

<div class="container" >
<?php 
    if(isset($_GET['halaman'])){
        $halaman = $_GET['halaman'];
        switch ($halaman) {
            case 'home':
                include "home.php";
                break;
            case 'artikel':
                include "artikel.php";
                break;
            case 'login':
                include "login.php";
                break;
            // case 'daftar':
            //     include "daftar.php";
            //     break;
            default:
            echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
            break;
        }
    }else {
        include "home.php";
    }
?>
</div>

<section>
    <footer class="footer-user bg-dark" style=" padding: 20px;">
        <div class="container" style="color: #ccc;">
            <div class="row align-items-start">
                <div class="col text-left">
                <h5>Menu</h5>
                    <?php
                        include 'config/database.php';
                        $sql="select * from kategori";
                        $hasil=mysqli_query($kon,$sql);
                        while ($data = mysqli_fetch_array($hasil)):
                    ?>
                    <p>
                        <a style="color:#ccc; text-decoration: none; font-weight: 350;" 
                            href="index.php?halaman=home&kategori=<?php echo $data['id_kategori']; ?>"
                            onmouseover="this.style.textDecoration='underline';" 
                            onmouseout="this.style.textDecoration='none';">
                            <?php echo $data['nama_kategori']; ?>
                        </a>
                    </p>
                    <?php endwhile; ?>
                </div>
                <div class="col">
                    <h5>Kritik dan Saran</h5>
                    <form method="post" action="simpan-kritik.php">
                        <div class="form-group w-75">
                            <input type="hidden" name="status" value="0" class="form-control">
                        </div>
                        <div class="form-group w-75">
                            <input type="email" name="email" placeholder="Email" class="form-control">
                        </div>
                        <div class="form-group w-75">
                            <textarea class="form-control" placeholder="Ketik disini" name="isi_kritik" rows="3"></textarea>
                        </div>
                        <div class="form-group w-75">
                            <input type="submit"  name="form_kritik" class="btn btn-secondary" value="Kirim">
                        </div>
                    </form>
                </div>
                <!-- <div class="col"></div> -->
                <div class="col">
                    <h5>Kontak</h5>
                    <a href="#" style="padding-right: 10px; color:#ccc;" onmouseover="this.style.color='#fff';" 
                            onmouseout="this.style.color='#ccc';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-linkedin" viewBox="0 0 16 16">
                            <path d="M0 1.146C0 .513.526 0 1.175 0h13.65C15.474 0 16 .513 16 1.146v13.708c0 .633-.526 1.146-1.175 1.146H1.175C.526 16 0 15.487 0 14.854zm4.943 12.248V6.169H2.542v7.225zm-1.2-8.212c.837 0 1.358-.554 1.358-1.248-.015-.709-.52-1.248-1.342-1.248S2.4 3.226 2.4 3.934c0 .694.521 1.248 1.327 1.248zm4.908 8.212V9.359c0-.216.016-.432.08-.586.173-.431.568-.878 1.232-.878.869 0 1.216.662 1.216 1.634v3.865h2.401V9.25c0-2.22-1.184-3.252-2.764-3.252-1.274 0-1.845.7-2.165 1.193v.025h-.016l.016-.025V6.169h-2.4c.03.678 0 7.225 0 7.225z"/>
                        </svg>
                        
                    </a>
                    <a href="#" style="color:#ccc;" onmouseover="this.style.color='#fff';" 
                    onmouseout="this.style.color='#ccc';">
                        <svg xmlns="http://www.w3.org/2000/svg" width="27" height="27" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                            <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.2-.36-1.02.08-2.12 0 0 .67-.21 2.2.82.64-.18 1.32-.27 2-.27s1.36.09 2 .27c1.53-1.04 2.2-.82 2.2-.82.44 1.1.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.2 0 .21.15.46.55.38A8.01 8.01 0 0 0 16 8c0-4.42-3.58-8-8-8"/>
                        </svg>
                    </a>
                </div>
            </div>
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
                                style="font-size: 18px; font-style: italic; font-weight: 600; background: linear-gradient(to right, #ff0b0b, #fff, #ccc); -webkit-background-clip: text; -webkit-text-fill-color: transparent;" class="navbar-brand" href="index.php?halaman=home"><?php echo $nama_website;?>
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