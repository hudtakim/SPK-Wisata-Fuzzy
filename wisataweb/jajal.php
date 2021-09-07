<?php 

for($x=0; $x<count($list_kriteria); $x++){
    $krit1 = $list_kriteria[0];
    $valkrit1 = $input_kriteria[0];
    $result2 = mysqli_query($conn, "INSERT INTO tempat_wisata_tb(obyek_wisata, {$krit1}) 
    VALUES('$ob_wis', '$valkrit1')");
}
?>