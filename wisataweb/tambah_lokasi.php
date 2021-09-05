<?php 
session_start();
include"functions.php";
include"fungsi_keanggotaan.php";

if($_SESSION['legitUser'] != 'qwerty'){
    die(header("location: 404.html"));
}

if(isset($_POST['submit'])){
    $ob_wis = $_POST['nama'];
    $jns = $_POST['jenis'];
    $hrg = $_POST['harga'];
    $jrk = $_POST['jarak'];
    $fsls = $_POST['fasilitas'];
    $pgnj = $_POST['pengunjung'];

    //cek dulu apakah sudah ada di database
    $result1 = mysqli_query($conn,"SELECT * from tempat_wisata_tb WHERE (obyek_wisata = '$ob_wis')");
    $rowcount = mysqli_num_rows($result1);
    if($rowcount > 0){
        $message = "Input gagal, data lokasi sudah ada di database!";
        echo "<script>alert('$message'); window.location.replace('data_lokasi_wisata.php');</script>";
    }else{
        //insert data to tempat_wisata_tb
        $result2 = mysqli_query($conn, "INSERT INTO tempat_wisata_tb(obyek_wisata, jenis, harga, jarak, fasilitas, pengunjung) 
        VALUES('$ob_wis', '$jns','$hrg', '$jrk', '$fsls', '$pgnj')");

        $getid = mysqli_query($conn,"SELECT DISTINCT(id) from tempat_wisata_tb WHERE (obyek_wisata = '$ob_wis')");
        $row = $getid->fetch_row();
        $nid = $row[0] ?? false;
        $id = (int)$nid;
        $hrg = (int)$hrg;
        $jrk = (int)$jrk;
        $fsls = (int)$fsls;
        $pgnj = (int)$pgnj;

        //insert data to fuzzy_fasilitas
        $bawah = getbobot_fasilitas($fsls, "sedikit");
        $tengah = getbobot_fasilitas($fsls, "cukup");
        $atas = getbobot_fasilitas($fsls, "banyak");
        mysqli_query($conn, "INSERT INTO fuzzy_fasilitas(id, obyek_wisata, fasilitas, sedikit, cukup, banyak) 
        VALUES('$id','$ob_wis', '$fsls', '$bawah', '$tengah', '$atas')");

        //insert data to fuzzy_harga
        $bawah = getbobot_harga($hrg, "murah");
        $tengah = getbobot_harga($hrg, "sedang");
        $atas = getbobot_harga($hrg, "mahal");
        mysqli_query($conn, "INSERT INTO fuzzy_harga(id, obyek_wisata, harga, murah, sedang, mahal) 
        VALUES('$id','$ob_wis', '$hrg', '$bawah', '$tengah', '$atas')");

        //insert data to fuzzy_jarak
        $bawah = getbobot_jarak($jrk, "dekat");
        $tengah = getbobot_jarak($jrk, "sedang");
        $atas = getbobot_jarak($jrk, "jauh");
        mysqli_query($conn, "INSERT INTO fuzzy_jarak(id, obyek_wisata, jarak, dekat, sedang, jauh) 
        VALUES('$id','$ob_wis', '$jrk', '$bawah', '$tengah', '$atas')");

        //insert data to fuzzy_pengunjung
        $bawah = getbobot_pengunjung($pgnj, "sepi");
        $tengah = getbobot_pengunjung($pgnj, "biasa");
        $atas = getbobot_pengunjung($pgnj, "ramai");
        mysqli_query($conn, "INSERT INTO fuzzy_pengunjung(id, obyek_wisata, pengunjung, sepi, biasa, ramai) 
        VALUES('$id','$ob_wis', '$pgnj', '$bawah', '$tengah', '$atas')");

        //insert data to fuzzy_jenis
        $bawah = getbobot_jenis($jns)[0];
        $tengah = getbobot_jenis($jns)[1];
        $atas = getbobot_jenis($jns)[2];
        mysqli_query($conn, "INSERT INTO fuzzy_jenis(id, obyek_wisata, jenis, alam, sosial_budaya, religi_sejarah) 
        VALUES('$id','$ob_wis', '$jns', '$bawah', '$tengah', '$atas')");

        if($result2){ 
            $message = "Berhasil menambahkan data lokasi wisata.";
            echo "<script>alert('$message'); window.location.replace('data_lokasi_wisata.php');</script>";
        } else {
            echo $result2;
        } 
    }
}

?>