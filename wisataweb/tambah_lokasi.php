<?php 
session_start();
include"functions.php";
include"fungsi_keanggotaan.php";

if($_SESSION['legitUser'] != 'qwerty'){
    die(header("location: 404.html"));
}

if(isset($_POST['submit'])){
    $ob_wis = $_POST['nama'];

    $arr_kriteria = mysqli_query($conn,"SELECT * from daftar_kriteria_static");
    $jumlah_kriteria = mysqli_num_rows($arr_kriteria);
    $input_kriteria = array();
    $list_kriteria = array();
    $list_kriteria2 = array();
    while($data = mysqli_fetch_array($arr_kriteria)):
        $kriteria = strtolower($data['kriteria']);
        array_push($input_kriteria, $_POST[$kriteria]);
        array_push($list_kriteria, $kriteria);
        array_push($list_kriteria2, $data['kriteria']);
    endwhile;

    //cek dulu apakah sudah ada di database
    $result1 = mysqli_query($conn,"SELECT * from tempat_wisata_tb WHERE (obyek_wisata = '$ob_wis')");
    $rowcount = mysqli_num_rows($result1);
    if($rowcount > 0){
        $message = "Input gagal, data lokasi sudah ada di database!";
        echo "<script>alert('$message'); window.location.replace('data_lokasi_wisata.php');</script>";
    }else{
        //insert data to tempat_wisata_tb
        if($jumlah_kriteria == 0){
            $sukses = mysqli_query($conn, "INSERT INTO tempat_wisata_tb(obyek_wisata) VALUES('$ob_wis')");
        }
        else{
            for($x=0; $x<$jumlah_kriteria; $x++){
                $krit = $list_kriteria[$x];
                $krit2 = $list_kriteria2[$x];
                $valkrit = $input_kriteria[$x];
                $cek = mysqli_query($conn,"SELECT * from tempat_wisata_tb WHERE (obyek_wisata = '$ob_wis')");
                $count_cek = mysqli_num_rows($cek);
                if($count_cek == 0){
                    $sukses = mysqli_query($conn, "INSERT INTO tempat_wisata_tb(obyek_wisata, {$krit}) 
                    VALUES('$ob_wis', '$valkrit')");
                }else{
                    $get_kategori = mysqli_query($conn,"SELECT kategori from daftar_kriteria_static WHERE (kriteria = '$krit2')");
                    $row = $get_kategori->fetch_row();
                    $value = $row[0] ?? false;
                    if($value == "fuzzy"){
                        $sukses = mysqli_query($conn, "UPDATE tempat_wisata_tb SET {$krit} = $valkrit WHERE (obyek_wisata = '$ob_wis')");
                    }else{
                        $get_kategori = mysqli_query($conn,"SELECT bawah, tengah, atas from daftar_kriteria_static WHERE (kriteria = '$krit2')");
                        $row = $get_kategori->fetch_assoc();
                        if($valkrit== "bawah"){$valu = $row['bawah'];}
                        if($valkrit == "tengah"){$valu = $row['tengah'];}
                        if($valkrit == "atas"){$valu = $row['atas'];}
                        $sukses = mysqli_query($conn, "UPDATE tempat_wisata_tb SET {$krit} = '$valu' WHERE (obyek_wisata = '$ob_wis')");
                    }
                }   
            }
        }

        $getid = mysqli_query($conn,"SELECT DISTINCT(id) from tempat_wisata_tb WHERE (obyek_wisata = '$ob_wis')");
        $row = $getid->fetch_row();
        $nid = $row[0] ?? false;
        $id = (int)$nid;
        $it = 0;
        foreach($list_kriteria2 as &$nilai_krit){
            $get_kategori = mysqli_query($conn,"SELECT kategori, nbawah, ntengah, natas, bawah, tengah, atas from daftar_kriteria_static WHERE (kriteria = '$nilai_krit')");
            $row = $get_kategori->fetch_assoc();
            $kategori = $row['kategori'];
            $batas_bawah = $row['nbawah'];
            $batas_tengah = $row['ntengah'];
            $batas_atas = $row['natas'];
            $name_bawah = strtolower($row['bawah']);
            $name_tengah = strtolower($row['tengah']);
            $name_atas = strtolower($row['atas']);
            $name_krit  = $list_kriteria[$it];
            $valinput = $input_kriteria[$it];
            $tname = "fuzzy_";
            $tname .= $list_kriteria[$it];

            if($kategori == "fuzzy"){
                $v0=(int)$valinput ; $v1= $batas_bawah; $v2= $batas_tengah; $v3= $batas_atas;
                $bawah = getbobot($v0, "bawah", $v1, $v2, $v3);
                $tengah = getbobot($v0, "tengah",$v1, $v2, $v3);
                $atas = getbobot($v0, "atas",$v1, $v2, $v3);
                $sukses2 = mysqli_query($conn, "INSERT INTO {$tname}(id, obyek_wisata, {$name_krit}, {$name_bawah}, {$name_tengah}, {$name_atas}) 
                VALUES('$id','$ob_wis', '$v0', '$bawah', '$tengah', '$atas')");
            }else{
                $v0=(string)$valinput;
                if($v0 == "bawah"){$valu = $row['bawah'];}
                if($v0 == "tengah"){$valu = $row['tengah'];}
                if($v0 == "atas"){$valu = $row['atas'];}
                $bawah = getbobot_nonfuzzy($v0)[0];
                $tengah = getbobot_nonfuzzy($v0)[1];
                $atas = getbobot_nonfuzzy($v0)[2];
                $sukses2 = mysqli_query($conn, "INSERT INTO {$tname}(id, obyek_wisata, {$name_krit}, {$name_bawah}, {$name_tengah}, {$name_atas}) 
                VALUES('$id','$ob_wis', '$valu', '$bawah', '$tengah', '$atas')");
            }
            $it++;
        }

        if($sukses && $sukses2){ 
            $message = "Berhasil menambahkan data lokasi wisata.";
            echo "<script>alert('$message'); window.location.replace('data_lokasi_wisata.php');</script>";
        } else {
            echo "<h1>WARNING !!!</h1> <br>";
            echo $sukses;
            echo "<br>---------------------------<br>";
            echo $sukses2;
        } 
    }
}

?>