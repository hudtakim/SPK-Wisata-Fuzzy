<?php 
session_start();
include"functions.php";
include"fungsi_keanggotaan.php";

if($_SESSION['legitUser'] != 'qwerty'){
    die(header("location: 404.html"));
}

if(isset($_POST['submit'])){
    $kategori = $_POST['kategori'];
    $nama_kriteria = $_POST['nama'];
    $nama_sub1 = $_POST['sub1'];
    $nama_sub2 = $_POST['sub2'];
    $nama_sub3 = $_POST['sub3'];
    $nbawah = (int)$_POST['nbawah'];
    $ntengah = (int)$_POST['ntengah'];
    $natas = (int)$_POST['natas'];

    $nid= array();
    $datakriteria_id = array();
    $datakritnon_id = array();
    $lokasiarr = array();

    //cek dulu apakah kriteria sudah ada di database
    $result = mysqli_query($conn,"SELECT * from daftar_kriteria_static WHERE (kriteria = '$nama_kriteria')");
    $rowcount = mysqli_num_rows($result);
    if($rowcount > 0){
        $message = "Gagal, kriteria yang anda masukkan sudah ada di database!";
        echo "<script>alert('$message'); window.location.replace('tambah_kriteria.php');</script>";
    }else{
        $result = mysqli_query($conn, "INSERT INTO daftar_kriteria_static(kategori, kriteria, bawah, tengah, atas, nbawah, ntengah, natas) 
        VALUES('$kategori','$nama_kriteria', '$nama_sub1','$nama_sub2', '$nama_sub3', '$nbawah', '$ntengah', '$natas')");
        if($result){ 
            $data_array = mysqli_query($conn,"SELECT * from tempat_wisata_tb");
            while($data = mysqli_fetch_array($data_array)):
                $id = (string)$data['id'];
                if($kategori == "fuzzy"){
                    $namecol = "datakriteria";
                } else{
                    $namecol = "datakritnon";
                }
                $namecol.=$id;
                array_push($nid, $data['id']);
                array_push($datakriteria_id, $_POST[$namecol]);
                array_push($lokasiarr, $data['obyek_wisata']);
            endwhile;

            $nk_lowered = strtolower($nama_kriteria);
            if($kategori == "fuzzy"){
                mysqli_query($conn ,"ALTER TABLE tempat_wisata_tb ADD {$nk_lowered} float(20)" ) or die(mysqli_error($conn));
            }else{
                mysqli_query($conn ,"ALTER TABLE tempat_wisata_tb ADD {$nk_lowered} VARCHAR(20) NOT NULL" ) or die(mysqli_error($conn));
            }
            if($kategori == "fuzzy"){
                $it = 0;
                foreach ($datakriteria_id as &$value) {
                    mysqli_query($conn, "UPDATE tempat_wisata_tb SET {$nk_lowered} = $value WHERE id = $nid[$it]");
                    $it++;
                }
            }else{
                $it = 0;
                foreach ($datakriteria_id as &$value) {
                    $str_val = (string)$datakriteria_id[$it];
                    if($str_val == "bawah"){$valu = $nama_sub1;}
                    if($str_val == "tengah"){$valu = $nama_sub2;}
                    if($str_val == "atas"){$valu = $nama_sub3;}
                    $valu = (string)$valu;
                    mysqli_query($conn, "UPDATE tempat_wisata_tb SET {$nk_lowered} = '$valu' WHERE id = $nid[$it]");
                    $it++;
                }
            }
            
            $tname = "fuzzy_";
            $tname.=$nk_lowered;
            $nsub1_lowered = strtolower($nama_sub1);
            $nsub2_lowered = strtolower($nama_sub2);
            $nsub3_lowered = strtolower($nama_sub3);
            if($kategori == "fuzzy"){
                $result = mysqli_query($conn, "CREATE TABLE {$tname}(
                    id INT NOT NULL AUTO_INCREMENT,
                    obyek_wisata VARCHAR(30) NOT NULL,
                    {$nk_lowered} float(20) NOT NULL,
                    {$nsub1_lowered} float(20) NOT NULL,
                    {$nsub2_lowered} float(20) NOT NULL,
                    {$nsub3_lowered} float(20) NOT NULL,
                    PRIMARY KEY ( id )
                 )");
            }else{
                $result = mysqli_query($conn, "CREATE TABLE {$tname}(
                    id INT NOT NULL AUTO_INCREMENT,
                    obyek_wisata VARCHAR(30) NOT NULL,
                    {$nk_lowered} VARCHAR(20) NOT NULL,
                    {$nsub1_lowered} float(20) NOT NULL,
                    {$nsub2_lowered} float(20) NOT NULL,
                    {$nsub3_lowered} float(20) NOT NULL,
                    PRIMARY KEY ( id )
                 )");
            }
            
            if($kategori == "fuzzy"){
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
            }else{
                $it=0;
                foreach ($nid as &$value) {
                    $val = (string)$datakriteria_id[$it];
                    if($val == "bawah"){$valu = $nama_sub1;}
                    if($val == "tengah"){$valu = $nama_sub2;}
                    if($val == "atas"){$valu = $nama_sub3;}
                    $bawah = getbobot_nonfuzzy($val)[0];
                    $tengah = getbobot_nonfuzzy($val)[1];
                    $atas = getbobot_nonfuzzy($val)[2];
                    $result = mysqli_query($conn, "INSERT INTO {$tname}(id, obyek_wisata, {$nk_lowered},{$nsub1_lowered}, {$nsub2_lowered}, {$nsub3_lowered}) 
                    VALUES('$value', '$lokasiarr[$it]', '$valu','$bawah', '$tengah', '$atas')");
                    $it++;
                }
            }
            
            $message = "Berhasil menambahkan kriteria baru.";
            echo "<script>alert('$message'); window.location.replace('admin_page.php');</script>";

        } 
    }
}
?>