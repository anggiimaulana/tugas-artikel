
<?php
    $kritik_id=$_POST["kritik_id"];
    // mengambil data barang dengan kode paling besar
    include '../../config/database.php';
    $query = mysqli_query($kon, "SELECT * FROM kritik where kritik_id=$kritik_id");
    $data = mysqli_fetch_array($query); 

    $email=$data['email'];
    $isi_kritik=$data['isi_kritik'];

?>
    <form action="kritik/edit.php" method="post">
    <div class="form-group">
            <input name="kritik_id" value="<?php echo $kritik_id; ?>" type="hidden" class="form-control">
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Email:</label>
                    <input name="email" value="<?php echo $email; ?>" type="email" class="form-control" placeholder="Masukan email" required>
                </div>
            </div>
        </div>
   
        <div class="row">
            <div class="col-sm-12">
                <div class="form-group">
                    <label>Kritik & Saran:</label>
                    <textarea name="isi_kritik" class="form-control" rows="5" disable><?php echo $isi_kritik; ?></textarea>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                <label>Status:</label>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                        <input type="radio" <?php if ($data['status']==1) echo "checked"; ?> class="form-check-input" name="status" value="1">Tandai Dibaca
                        </label>
                    </div>
                    <div class="form-check-inline">
                        <label class="form-check-label">
                        <input type="radio" <?php if ($data['status']==0) echo "checked"; ?> class="form-check-input" name="status" value="0">Tandai Belum Dibaca
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" name="simpan_edit" class="btn btn-dark">Update Kritik & Saran</button>
    </form>

<?php
    if (isset($_POST['simpan_edit'])) {
        //Include file koneksi, untuk koneksikan ke database
        include '../../config/database.php';
        
        //Fungsi untuk mencegah inputan karakter yang tidak sesuai
        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }
        $kritik_id=input($_POST["kritik_id"]);
        $email=input($_POST["email"]);
        $isi_kritik=input($_POST["isi_kritik"]);
        $status=input($_POST["status"]);

        //Query input menginput data kedalam tabel anggota
        $sql="update kritik set
        email='$email',
        isi_kritik='$isi_kritik',
        status='$status'
        where kritik_id=$kritik_id";

        //Mengeksekusi/menjalankan query 
        $hasil=mysqli_query($kon,$sql);


        //Kondisi apakah berhasil atau tidak dalam mengeksekusi query diatas
        if ($hasil) {
            header("Location:../index.php?halaman=kritik-saran&edit=berhasil");
        }
        else {
            header("Location:../index.php?halaman=kritik-saran&edit=gagal");;

        }
        
    }
    ?>