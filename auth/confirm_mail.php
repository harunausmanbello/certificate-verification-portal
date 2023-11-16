<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once('core/usercore.php');

if (!loggedin()){

 ?>
<!DOCTYPE html>
<html>
<head>


    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title> Confirm Sent Mail | <?= $_ENV['APP_NAME'] ;?> </title>
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
                    <div class="card">
                        <div class="card-body p-4 p-sm-5">
                            <div class="text-center">
                                <h4 class="mb-2">Please check your email!</h4>
                                
                                <p>An email has been sent. Please click on the included
                                    link to reset your password.</p><a class="btn btn-primary btn-sm mt-3"
                                    href="/"><span class="fas fa-chevron-left me-1"
                                        data-fa-transform="shrink-4 down-1"></span>Return to login</a>
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


<!-- Mirrored from prium.github.io/falcon/v3.17.0/pages/authentication/simple/confirm-mail.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 07 Aug 2023 12:07:11 GMT -->

</html>
<?php }else{
    header('Location: /');
} ?>