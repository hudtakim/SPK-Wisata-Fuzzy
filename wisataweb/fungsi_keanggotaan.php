<?php
function getbobot_jenis($subkrit){
    if($subkrit == "Alam"){
        $bawah=1; $tengah=0; $atas=0;
        $bobot = array();
        array_push($bobot, $bawah); array_push($bobot, $tengah); array_push($bobot, $atas);
        return $bobot;
    }
    if($subkrit == "Sosial dan Budaya"){
        $bawah=0; $tengah=1; $atas=0;
        $bobot = array();
        array_push($bobot, $bawah); array_push($bobot, $tengah); array_push($bobot, $atas);
        return $bobot;
    }
    if($subkrit == "Religi dan Sejarah"){
        $bawah=0; $tengah=0; $atas=1;
        $bobot = array();
        array_push($bobot, $bawah); array_push($bobot, $tengah); array_push($bobot, $atas);
        return $bobot;
    }
}
function getbobot_harga($value, $subkrit){
    if($subkrit == "murah"){
        if($value <= 10000){
            $bobot = 1; 
            return $bobot;
        } elseif($value >= 10000 && $value <= 25000){
            $bobot= (25000 - $value)/15000;
            return $bobot;
        } else {
            $bobot= 0;
            return $bobot;
        }
    }
    if($subkrit == "sedang"){
        if($value <= 10000 && $value >= 50000){
            $bobot = 0; 
            return $bobot;
        } elseif($value >= 10000 && $value <= 25000){
            $bobot= ($value - 10000)/15000;
            return $bobot;
        } else {
            $bobot= (50000 - $value)/25000;
            return $bobot;
        }
    }
    if($subkrit == "mahal"){
        if($value <= 25000){
            $bobot = 0; 
            return $bobot;
        } elseif($value >= 25000 && $value <= 50000){
            $bobot= ($value - 10000)/15000;
            return $bobot;
        } else {
            $bobot= (50000 - $value)/25000;
            return $bobot;
        }
    }
}
function getbobot_jarak($value, $subkrit){
    if($subkrit == "dekat"){
        if($value <= 5){
            $bobot = 1; 
            return $bobot;
        }elseif($value >= 5 && $value <= 10){
            $bobot= (25000 - $value)/15000;
            return $bobot;
        } else {
            $bobot= 0;
            return $bobot;
        }
    }
    if($subkrit == "sedang"){
        if($value <= 5 && $value >= 10){
            $bobot = 0; 
            return $bobot;
        } elseif($value >= 5 && $value <= 10){
            $bobot= ($value - 5)/5;
            return $bobot;
        } else {
            $bobot= (20 - $value)/10;
            return $bobot;
        }
    }
    if($subkrit == "jauh"){
        if($value <= 20){
            $bobot = 0; 
            return $bobot;
        } elseif($value >= 10 && $value <= 20){
            $bobot= ($value - 10)/10;
            return $bobot;
        } else {
            $bobot= 1;
            return $bobot;
        }
    }
}
function getbobot_fasilitas($value, $subkrit){
    if($subkrit == "sedikit"){
        if($value <= 5){
            $bobot = 1; 
            return $bobot;
        }elseif($value >= 5 && $value <= 10){
            $bobot= (10 - $value)/5;
            return $bobot;
        } else {
            $bobot= 0;
            return $bobot;
        }
    }
    if($subkrit == "cukup"){
        if($value <= 5 && $value >= 10){
            $bobot = 0; 
            return $bobot;
        } elseif($value >= 5 && $value <= 10){
            $bobot= ($value - 5)/5;
            return $bobot;
        } else {
            $bobot= (20 - $value)/10;
            return $bobot;
        }
    }
    if($subkrit == "banyak"){
        if($value <= 20){
            $bobot = 0; 
            return $bobot;
        } elseif($value >= 10 && $value <= 20){
            $bobot= ($value - 10)/10;
            return $bobot;
        } else {
            $bobot= 1;
            return $bobot;
        }
    }
}
function getbobot_pengunjung($value, $subkrit){
    if($subkrit == "sepi"){
        if($value <= 1000){
            $bobot = 1; 
            return $bobot;
        }elseif($value >= 1000 && $value <= 4500){
            $bobot= (4500 - $value)/3500;
            return $bobot;
        } else {
            $bobot= 0;
            return $bobot;
        }
    }
    if($subkrit == "biasa"){
        if($value <= 1000 && $value >= 10000){
            $bobot = 0; 
            return $bobot;
        } elseif($value >= 1000 && $value <= 4500){
            $bobot= ($value - 1000)/3500;
            return $bobot;
        } else {
            $bobot= (10000 - $value)/5500;
            return $bobot;
        }
    }
    if($subkrit == "ramai"){
        if($value <= 4500){
            $bobot = 0; 
            return $bobot;
        } elseif($value >= 4500 && $value <= 10000){
            $bobot= ($value - 4500)/5500;
            return $bobot;
        } else {
            $bobot= 1;
            return $bobot;
        }
    }
}
?>