<?php 
session_start();
include"functions.php";
include"fungsi_keanggotaan.php";

if($_SESSION['legitUser'] != 'qwerty'){
    die(header("location: 404.html"));
}

if(isset($_POST['submit'])){
    $nama_kriteria = $_POST['nama'];
    $nama_sub1 = $_POST['sub1'];
    $nama_sub2 = $_POST['sub2'];
    $nama_sub3 = $_POST['sub3'];
    $nbawah = (int)$_POST['nbawah'];
    $ntengah = (int)$_POST['ntengah'];
    $natas = (int)$_POST['natas'];

    $nid= array();
    $datakriteria_id = array();
    $lokasiarr = array();

    //cek dulu apakah kriteria sudah ada di database
    $result = mysqli_query($conn,"SELECT * from daftar_kriteria_static WHERE (kriteria = '$nama_kriteria')");
    $rowcount = mysqli_num_rows($result);
    if($rowcount > 0){
        $message = "Gagal, kriteria yang anda masukkan sudah ada di database!";
        echo "<script>alert('$message'); window.location.replace('tambah_kriteria.php');</script>";
    }else{
        $result = mysqli_query($conn, "INSERT INTO daftar_kriteria_static(kriteria, bawah, tengah, atas, nbawah, ntengah, natas) 
        VALUES('$nama_kriteria', '$nama_sub1','$nama_sub2', '$nama_sub3', '$nbawah', '$ntengah', '$natas')");
        if($result){ 
            $data_array = mysqli_query($conn,"SELECT * from tempat_wisata_tb");
            while($data = mysqli_fetch_array($data_array)):
                $id = (string)$data['id'];
                $namecol = "datakriteria";
                $namecol.=$id;
                array_push($nid, $data['id']);
                array_push($datakriteria_id, $_POST[$namecol]);
                array_push($lokasiarr, $data['obyek_wisata']);
            endwhile;

            $nk_lowered = strtolower($nama_kriteria);
            mysqli_query($conn ,"ALTER TABLE tempat_wisata_tb ADD {$nk_lowered} int(20)" ) or die(mysqli_error($conn));
        
            $it = 0;
            foreach ($datakriteria_id as &$value) {
                mysqli_query($conn, "UPDATE tempat_wisata_tb SET {$nk_lowered} = $value WHERE id = $nid[$it]");
                $it++;
            }
            $tname = "fuzzy_";
            $tname.=$nk_lowered;
            $nsub1_lowered = strtolower($nama_sub1);
            $nsub2_lowered = strtolower($nama_sub2);
            $nsub3_lowered = strtolower($nama_sub3);
            $result = mysqli_query($conn, "CREATE TABLE {$tname}(
                id INT NOT NULL AUTO_INCREMENT,
                obyek_wisata VARCHAR(30) NOT NULL,
                {$nk_lowered} float(20) NOT NULL,
                {$nsub1_lowered} float(20) NOT NULL,
                {$nsub2_lowered} float(20) NOT NULL,
                {$nsub3_lowered} float(20) NOT NULL,
                PRIMARY KEY ( id )
             )");

            $it=0;
            foreach ($nid as &$value) {
                $val = (float)$datakriteria_id[$it];
                $bawah = getbobot($val, "bawah", $nbawah, $ntengah, $natas);
                $tengah = getbobot($val, "tengah", $nbawah, $ntengah, $natas);
                $atas = getbobot($val, "atas", $nbawah, $ntengah, $natas);
                $result = mysqli_query($conn, "INSERT INTO {$tname}(id, obyek_wisata, {$nk_lowered},{$nsub1_lowered}, {$nsub2_lowered}, {$nsub3_lowered}) 
                VALUES('$value', '$lokasiarr[$it]', '$datakriteria_id[$it]','$bawah', '$tengah', '$atas')");
                $it++;
            }
            $message = "Berhasil menambahkan kriteria baru.";
            echo "<script>alert('$message'); window.location.replace('admin_page.php');</script>";

        } 
    }
}
?>