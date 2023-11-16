<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');
?>
<!DOCTYPE html>
<html>

<head>
    <?php include( __DIR__.'/../include/header/head.php' ); ?>
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">

            <div class="row flex-center min-vh-100 py-6">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <a class="d-flex flex-center mb-4"><img
                            class="me-2" src="/assets/img/<?= $_ENV['APP_LOGO']; ?>" alt="school logo"
                            style="width:50%" /></a>
                        <div class="card">
                            <div class="card-body p-4 p-sm-5">
                                <div class="text-center">

                                    <h4>Logout successfully!</h4>
                                    <p>You are now successfully signed out.</p><a class="btn btn-primary btn-sm mt-3"
                                        href="/"><span class="fas fa-chevron-left me-1"
                                            data-fa-transform="shrink-4 down-1"></span>Return to Login</a>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?php include( __DIR__.'/../include/script/script.php' ); ?>

</body>

</html>