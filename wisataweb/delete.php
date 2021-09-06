<?php 
session_start();
include"functions.php";

if($_SESSION['legitUser'] != 'qwerty'){
    die(header("location: 404.html"));
}

$id = $_GET['id']; // get id through query string
$item = $_GET['item']; // get id through query string

if($item == 'kriteria'){
    $del = mysqli_query($conn,"DELETE FROM daftar_kriteria where id = '$id'");
}
if($item == 'lokasi'){
    $del = mysqli_query($conn,"DELETE FROM tempat_wisata_tb where id = '$id'");
    $del = mysqli_query($conn,"DELETE FROM fuzzy_fasilitas where id = '$id'");
    $del = mysqli_query($conn,"DELETE FROM fuzzy_harga where id = '$id'");
    $del = mysqli_query($conn,"DELETE FROM fuzzy_jarak where id = '$id'");
    $del = mysqli_query($conn,"DELETE FROM fuzzy_pengunjung where id = '$id'");
    $del = mysqli_query($conn,"DELETE FROM fuzzy_jenis where id = '$id'");
}

if($del)
{
    mysqli_close($conn); // Close connection
    if($item == 'kriteria'){
        header("location:admin_page.php"); // redirects to all records page
    }
    if($item == 'lokasi'){
        header("location:data_lokasi_wisata.php"); // redirects to all records page
    }
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>