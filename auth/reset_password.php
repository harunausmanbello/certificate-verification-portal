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
            <div class="row flex-center min-vh-100 py-6">
                <div class="col-sm-10 col-md-8 col-lg-6 col-xl-5 col-xxl-4">
                    <div class="card">
                        <div class="card-body p-4 p-sm-5">
                            <h5 class="text-center">Create New Password</h5>
                            <form class="mt-3" id="createpassword" method="post">
                                <div class="mb-3">
                                    <input type="hidden" name="id" class="form-control" value="<?= $_GET['id']; ?>">
                                </div>
                                <div class="mb-3"><label class="form-label"></label><input class="form-control"
                                        type="password" placeholder="New Password" name="newpass" /></div>
                                <div class="mb-3"><input class="form-control" type="password"
                                        placeholder="Confirm Password" name="confirmpass" /></div><button
                                    class="btn btn-primary d-block w-100 mt-3" type="submit" name="submit">Set
                                    Password</button>
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
    <?php include( __DIR__.'/../include/script/script.php' ); ?>
</body>
<script>
$(document).on('submit', '#createpassword', function(e) {
    e.preventDefault();
    $('#btncreate').html(
        '<div class="spinner-border" role="status" style="font-size: 10px;"><span class="sr-only">Loading...</span></div>'
    );
    $('#btncreate').addClass('disabled');

    var formData = new FormData(this); // Create a new FormData object from the form

    $.ajax({
        url: '/password/create/new',
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

                $('#btncreate').html(
                    'Set Password');
                $('#btncreate').removeClass('disabled');
            }
            if (result.code == '200') {
                Swal.fire({
                    title: 'Completed successfully.',
                    text: result.msg,
                    icon: 'success',
                    showCancelButton: false,
                    confirmButtonColor: '#007BFF',
                    cancelButtonColor: '#d33',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = "/";
                    }
                });
            }

            if (result.code == '418') {
                Swal.fire({
                    icon: 'error',
                    title: result.msg,
                    text: 'Something went wrong!',
                    footer: '<a href="">Why do I have this issue?</a>',
                });
                $('#btncreate').html(
                    'Set Password');
                $('#btncreate').removeClass('disabled');
            }
        },
    });

});
</script>

</html>
<?php
}
?>