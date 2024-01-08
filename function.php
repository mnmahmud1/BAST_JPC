<?php

require "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

if (isset($_GET["logout"])) {
    unset($_COOKIE['_beta_log']); 
    setcookie('_beta_log', '', -1, '/'); 
    unset($_COOKIE['_name_log']); 
    setcookie('_name_log', '', -1, '/'); 

    header("Location: login.php");
}

if(isset($_GET["addIncomingGood"])){
    $yearNow = date("Y");
    $monthNow = date("m");
    $testGetDate = "IT/RR/" . $yearNow . "/" . $monthNow . "/";

    $getLastNumber = mysqli_query($conn, "SELECT number FROM good_incoming WHERE number LIKE '%$testGetDate%' ORDER BY number DESC LIMIT 1");
    if(mysqli_num_rows($getLastNumber) == 1){
        // ambil data nomor terakhir terkini
        $getLastNum = mysqli_fetch_assoc($getLastNumber);
        $number = $getLastNum["number"];

        // Pecah Nomor Terakhir berdasar "/"
        $explode_number = explode("/", $number);

        // +1 nomor akhir
        $addNumber = end($explode_number) + 1;

        $finalNumber = $testGetDate . $addNumber;
        $dateTime = date('Y-m-d H:i:s');
        $userCreated = $_COOKIE["_beta_log"];

        mysqli_query($conn, "INSERT INTO good_incoming (number, created_at, created_by) VALUES('$finalNumber','$dateTime', '$userCreated')");

        if(mysqli_affected_rows($conn)){
            // Menentukan waktu kedaluwarsa cookie (2 jam dalam detik)
			setcookie("_rr_number_log", "$finalNumber", time() + 2 * 60 * 60, "/");
            header("Location: tambah-laporan-barang-masuk.php");
        }
    } else if(mysqli_num_rows($getLastNumber) == 0){
        $finalNumber = $testGetDate . "1";
        $dateTime = date('Y-m-d H:i:s');
        $userCreated = $_COOKIE["_beta_log"];

        mysqli_query($conn, "INSERT INTO good_incoming (number, created_at, created_by) VALUES('$finalNumber','$dateTime', '$userCreated')");
        
        if(mysqli_affected_rows($conn)){
            // Menentukan waktu kedaluwarsa cookie (2 jam dalam detik)
			setcookie("_rr_number_log", "$finalNumber", time() + 2 * 60 * 60, "/");
            header("Location: tambah-laporan-barang-masuk.php");
        }
    }
}