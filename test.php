<?php

include "koneksi.php";

$mail = "mahmudi.nurhasan@jpc.co.id";

$getHashPassword = mysqli_fetch_assoc(mysqli_query($conn, "SELECT password FROM users WHERE email = '$mail' AND as_admin = 1"));
var_dump(password_verify("admin", $getHashPassword['password']));