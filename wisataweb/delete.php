<?php 
session_start();
include"functions.php";

if($_SESSION['legitUser'] != 'qwerty'){
    die(header("location: 404.html"));
}

$id = $_GET['id']; // get id through query string

$del = mysqli_query($conn,"DELETE FROM daftar_kriteria where id = '$id'"); // delete query

if($del)
{
    mysqli_close($db); // Close connection
    header("location:admin_page.php"); // redirects to all records page
    exit;	
}
else
{
    echo "Error deleting record"; // display error message if not delete
}
?>