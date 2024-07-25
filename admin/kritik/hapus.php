<?php
session_start();
    include '../../config/database.php';

    $kritik_id=$_POST["kritik_id"];

    $sql="delete from kritik where kritik_id=$kritik_id";
    $hapus_komentar=mysqli_query($kon,$sql);


?>