<?php require_once('connect.php'); ?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Login</title>
    <meta name="description" content="Core HTML Project">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- External CSS -->
    <link rel="stylesheet" href="vendor/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="vendor/select2/select2.min.css">
    <link rel="stylesheet" href="vendor/owlcarousel/owl.carousel.min.css">
    <link rel="stylesheet" href="vendor/lightcase/lightcase.css">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Lato:300,400|Work+Sans:300,400,700" rel="stylesheet">

    <!-- CSS -->
    <link rel="stylesheet" href="css/style.min.css">
    <link rel="stylesheet" href="https://cdn.linearicons.com/free/1.0.0/icon-font.min.css">
    <link href="https://file.myfontastic.com/7vRKgqrN3iFEnLHuqYhYuL/icons.css" rel="stylesheet">

    <!-- Modernizr JS for IE8 support of HTML5 elements and media queries -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>

</head>

<body data-spy="scroll" data-target="#navbar-nav-header" class="static-layout">
    <div class="boxed-page">
        <nav id="gtco-header-navbar" class="navbar navbar-expand-lg py-4">
            <div class="container">
                <a class="navbar-brand d-flex align-items-center">
                    <span class="lnr lnr-moon"></span>
                </a>

            </div>

        </nav>
        <!-- Login Form Section -->
        <section id="gtco-contact-form" class="bg-white">
            <div class="container">
                <div class="section-content">
                    <!-- Section Title -->
                    <div class="title-wrap">
                        <h1 class="display-2 mb-4">Login</h1><br>
                    </div>
                    <!-- End of Section Title -->
                    <div class="row">
                        <!-- Contact Form Holder -->
                        <div class="col-md-8 offset-md-2 contact-form-holder mt-4">
                            <form method="post" name="login-form" action="loginbackend.php">
                                <div class="row">
                                    <div class="col-md-12 form-input">
                                        <input type="text" class="form-control" id="email" name="email"
                                            placeholder="Email">
                                    </div>
                                    <div class="col-md-12 form-input">
                                        <input type="password" class="form-control" id="password" name="password"
                                            placeholder="Password">
                                    </div>
                                    <div class="col-md-12 form-btn text-center">
                                        <input class="btn btn-block btn-secondary btn-red" type="submit" name="login" value="LOGIN">
                                    </div>
                                    <div
                                        class="col-md-6 d-flex align-items-center justify-content-md-start justify-content-center">
                                        <a href="signup.php">
                                            SIGN UP
                                        </a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- End of Contact Form Holder -->
                    </div>
                </div>
            </div>
        </section>
        <!-- End of Contact Form Section -->
        <footer class="mastfoot mb-3 bg-white py-4 border-top">
            <div class="inner container">
                <div class="row">
                    <div class="col-md-6 d-flex align-items-center justify-content-md-start justify-content-center">
                        <p class="mb-0">Project CSS326 Movie Rental System</p>
                    </div>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>