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
    <title> Forgot Password | <?= $_ENV['APP_NAME'] ;?> </title>
    <?php include( __DIR__.'/../include/header/head.php' ); ?>
</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">
            <div class="row flex-center min-vh-100 py-6 text-center">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="mb-0">Forgot your password?</h5><small>Enter your email and we'll send you a
                                reset link.</small>
                            <form class="mt-4" method="post" id="resetpassword">
                                <input class="form-control" type="email" name="email" placeholder="Email address" />
                                <div class="mb-3"></div>
                                <button class="btn btn-primary d-block w-100 mt-3" type="submit"
                                    name="submit" id="btnreset">Send reset link</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?php include( __DIR__.'/../include/script/script.php' ); ?>
    <script>
    $(document).on('submit', '#resetpassword', function(e) {
        e.preventDefault();
        $('#btnreset').html(
            '<div class="spinner-border" role="status" style="font-size: 10px;"><span class="sr-only">Loading...</span></div>'
        );
        $('#btnreset').addClass('disabled');

        var formData = new FormData(this); // Create a new FormData object from the form

        $.ajax({
            url: '/password/reset/mail',
            dataType: 'json',
            data: formData,
            type: 'POST',
            contentType: false,
            processData: false,
            success: function(result) {
                if (result.code == '419') {
                    Swal.fire({
                        title: 'Something went wrong.',
                        text: result.msg,
                        icon: 'error',
                        showCancelButton: false,
                        confirmButtonColor: '#007BFF',
                        cancelButtonColor: '#d33',
                    });

                    $('#btnreset').html(
                        'Send reset link');
                    $('#btnreset').removeClass('disabled');
                }
                if (result.code == '200') {
                    Swal.fire({
                        title: 'Completed successfully.',
                        text: result.msg,
                        icon: 'success',
                        showCancelButton: false,
                        confirmButtonColor: '#007BFF',
                        cancelButtonColor: '#d33',
                    });
                    setTimeout(() => {
                        window.location.href = "/password/reset/mail/confirm";
                    }, 500);
                }
                if (result.code == '418') {
                    Swal.fire({
                        icon: 'error',
                        title: result.msg,
                        text: 'Something went wrong!',
                        footer: '<a href="">Why do I have this issue?</a>',
                    });
                    $('#btnreset').html(
                        'Send reset link');
                    $('#btnreset').removeClass('disabled');
                }
            },
        });

    });
    </script>

</body>

</html>
<?php }else{
    header('Location: /');
} ?>