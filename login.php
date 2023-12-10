<?php

require "koneksi.php";

function generateRandomCode($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomCode = substr(str_shuffle($characters), 0, $length);
    return $randomCode;
}

if(isset($_POST["signin"])){
	$mail = trim(htmlspecialchars($_POST['mail']));
	$password = trim(htmlspecialchars($_POST['password']));

	$checkMailReady = mysqli_query($conn, "SELECT id, name FROM users WHERE email = '$mail' AND as_admin = 1");

	if(mysqli_num_rows($checkMailReady) > 0){
		$getHashPassword = mysqli_fetch_assoc(mysqli_query($conn, "SELECT password FROM users WHERE email = '$mail' AND as_admin = 1"));
		if(password_verify($password, $getHashPassword['password'])){
			$getID = mysqli_fetch_assoc($checkMailReady);
			$id = $getID['id'];
            $name = $getID['name'];

			// $code = generateRandomCode(8);
			// mysqli_query($conn, "INSERT INTO session_log (user_id, rand_code) VALUES($id, '$code')");
			
			// Menentukan waktu kedaluwarsa cookie (6 jam dalam detik)
			setcookie("_beta_log", "$id", time() + 6 * 60 * 60, "/");
			setcookie("_name_log", "$name", time() + 6 * 60 * 60, "/");
			header("Location: index.php");
			exit;
		}
	}

	if(isset($_COOKIE['failed_log'])){
		// Menentukan waktu kedaluwarsa cookie (1 jam dalam detik)
		setcookie("failed_log", $_COOKIE['failed_log'] + 1, time() + 1 * 60 * 60, "/");
		header("Location: login.php");
	} else {
		// Menentukan waktu kedaluwarsa cookie (1 jam dalam detik)
		setcookie("failed_log", 1, time() + 1 * 60 * 60, "/");
		header("Location: login.php");
	}
	
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />

    <!-- Jquery CDN -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <link rel="stylesheet" href="dist/css/style.css" />
</head>

<body style="background-color: #363740">
    <div class="preloader">
        <div class="loading">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-md-6 col-lg-4 mx-auto mt-5">
                <div class="card">
                    <div class="card-body px-4">
                        <div class="text-center mt-3">
                            <span class="fw-bold fs-4">Sign In BAST IT</span>
                            <p class="text-muted fs-6">Enter your email and password below</p>
                        </div>

                        <form action="" method="POST">
                            <div class=" mb-3">
                                <label for="mail" class="form-label fw-bold fs-6">EMAIL</label>
                                <input type="text" name="mail" id="mail" class="form-control"
                                    placeholder="Type your mail" required />
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label fw-bold fs-6">PASSWORD</label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="Type your password" required />
                            </div>
                            <div class="mb-3 d-grid gap-2">
                                <button name="signin" type="submit" class="btn btn-primary p-3 fs">Sign In</button>
                            </div>
                            <div class="mb-3 text-center fs-6">
                                <a href="mailto:mahmudi.nurhasan@jpc.co.id"
                                    class="text-decoration-none text-decoration-underline text-secondary fw-bold">Contact
                                    administrator</a>
                                , If you don’t have an account.
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4 col-md-6 col-lg-4 mx-auto mt-2 text-white">Search Document <a href="search.html"
                    class="fw-bold text-decoration-none text-decoration-underline text-white">Here</a></div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/b676a664d2.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
        integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        $(".preloader").fadeOut("slow");
    });
    </script>
</body>

</html>