<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if (loggedin()) {

    
    header('Location: /admin/logout');

} else { ?>
<!DOCTYPE html>
<html>

<head>
    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title> Login | <?= $_ENV['APP_NAME']; ?> </title>
    <?php include(__DIR__ . '/../include/header/head.php'); ?>
  

</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container" data-layout="container">

            <div class="row flex-center min-vh-100 py-6">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <a class="d-flex flex-center mb-4"><img class="me-2" src="/assets/img/<?= $_ENV['APP_LOGO']; ?>"
                            alt="school logo" style="width:50%" />
                    </a>
                    <div class="card">
                        <div class="card-body p-4 p-sm-5">
                            <div class="row flex-between-center mb-2">
                                <div class="col-auto">
                                    <h5>Log in</h5>
                                </div>
                            </div>
                            <form id="login" method="post" class="needs-validation">
                                <div class="mb-3">
                                    <input class="form-control" type="text" name="username" placeholder="username" id="username" required/>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" type="password" name="password" placeholder="Password" id="password" required />
                                </div>
                                <div class="row float-end mb-3">
                                    <div class="col-auto">
                                        <a class="fs--1" href="/password/reset">Forgot Password?</a>
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <button class="btn btn-primary d-block w-100 mt-3" type="submit" id="btnlogin"
                                        name="submit">Log
                                        in</button>
                                </div>
                            </form>

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



    <script>
    $(document).on('submit', '#login', function(e) {
        e.preventDefault();
        $('#btnlogin').html(
            '<div class="spinner-border" role="status" style="font-size: 10px;"><span class="sr-only">Loading...</span></div>'
        );
        $('#btnlogin').addClass('disabled');

        var formData = new FormData(this); // Create a new FormData object from the form

        $.ajax({
            url: '/login',
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

                    $('#btnlogin').html(
                        'Log in');
                    $('#btnlogin').removeClass('disabled');
                }
                if (result.code == '200') {
                    setTimeout(() => {
                        window.location.href = "/admin/dashboard";
                    }, 500);
                }
                if (result.code == '418') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong!',
                        text: result.msg,
                        footer: '<a href="">Why do I have this issue?</a>',
                    });
                    $('#btnlogin').html(
                        'Log in');
                    $('#btnlogin').removeClass('disabled');
                }
            },
        });

    });
    </script>

    <?php include(__DIR__ . '/../include/script/script.php'); ?>

</body>

</html>

<?php
}
?>