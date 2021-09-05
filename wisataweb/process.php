<?php 
session_start();
include"functions.php";

if($_SESSION['legitUser'] != 'qwerty'){
    die(header("location: 404.html"));
}

if(isset($_POST['submit'])){
    $kriteria = $_POST['kriteria'];

    //cek dulu apakah ada di database
    $result1 = mysqli_query($conn,"SELECT * from daftar_kriteria_static WHERE (kriteria = '$kriteria')");
    $rowcount=mysqli_num_rows($result1);

    if($rowcount == 0){
        $message = "Data yang anda masukkan tidak ditemukan pada data base!!!";
        echo "<script>alert('$message'); window.location.replace('admin_page.php');</script>";
    }else{
        $result2 = mysqli_query($conn,"SELECT * from daftar_kriteria WHERE (kriteria = '$kriteria')");
        $rowcount=mysqli_num_rows($result2);
        if($rowcount == 0){
            while($data = mysqli_fetch_array($result1)):
                $bawah = $data['bawah'];
                $tengah = $data['tengah'];
                $atas = $data['atas'];
            endwhile;
  
            $result = mysqli_query($conn, "INSERT INTO daftar_kriteria(kriteria, bawah, tengah, atas) 
            VALUES('$kriteria', '$bawah','$tengah', '$atas')");

            if($result){ 
                $message = "Berhasil menambahkan kriteria.";
                echo "<script>alert('$message'); window.location.replace('admin_page.php');</script>";
            } else {
                echo $result;
            }
        }else{
            $message = "Kriteria yang anda masukkan sudah ada.";
            echo "<script>alert('$message'); window.location.replace('admin_page.php');</script>";
        }
    }
}
?>