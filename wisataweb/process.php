<?php 
session_start();
include"functions.php";

if($_SESSION['legitUser'] != 'qwerty'){
    die(header("location: 404.html"));
}

if(isset($_POST['submit'])){
    $kriteria = $_POST['kriteria'];
    $bawah = $_POST['bawah'];
    $tengah = $_POST['tengah'];
    $atas = $_POST['atas'];

    $result = mysqli_query($conn, "INSERT INTO daftar_kriteria(kriteria, bawah, tengah, atas) 
                VALUES('$kriteria', '$bawah','$tengah', '$atas')");

    if($result){ 
        header('Location: admin_page.php');
    } else {
        echo $result;
    }
}
?>