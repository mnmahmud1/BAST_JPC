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
            <div class="col-sm-12 col-md-9 col-lg-8 mx-auto mt-5">
                <div class="card">
                    <div class="card-body px-4">
                        <div class="text-center mt-3">
                            <span class="fw-bold fs-4">Search</span>
                            <p class="text-muted fs-6">Search inventory items or document receipt report</p>
                        </div>

                        <form action="">
                            <div class="mb-3">
                                <label for="identity" class="form-label fw-bold fs-6">SERIAL NUMBER/KODE
                                    UNIK/BAST</label>
                                <div class="row">
                                    <div class="col-sm-11">
                                        <input type="text" name="identity" id="identity" class="form-control"
                                            placeholder="Type identity" required autofocus />
                                    </div>
                                    <div class="col-sm-1">
                                        <button type="submit" class="btn btn-primary btn-form fs">
                                            <i class="fa-solid fa-magnifying-glass"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card mt-4">
                    <div class="card-body">
                        <div class="accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#flush-collapseOne" aria-expanded="false"
                                        aria-controls="flush-collapseOne">
                                        <span class="fw-semibold"> PF32SMG3 - BA202208001 </span>
                                    </button>
                                </h2>
                                <div id="flush-collapseOne" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="row">
                                            <div class="col">
                                                <div class="row">
                                                    <div class="col">
                                                        <span class="text-muted">User : </span>M Nurhasan Mahmudi
                                                        <br />
                                                        <span class="text-muted">Date : </span>
                                                        Senin 16-08-2022 11.43 PM
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col align-self-center text-end">
                                                <a href="#" class="btn btn-sm btn-primary">DOCUMENT</a>
                                                <a href="#" class="btn btn-sm btn-primary disabled">SIGNED</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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