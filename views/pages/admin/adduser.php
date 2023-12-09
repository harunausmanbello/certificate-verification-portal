<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if (loggedin()) {

    if (!isLoginSessionExpired()) {

        if ($auth->role == 'admin') {

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>

    <?php include(__DIR__ . '/../../../include/header/head.php'); ?>
    <title> Add User | <?= $_ENV['APP_NAME'] ;?> </title>

</head>

<body>
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">
        <div class="container-fluid" data-layout="container-fluid">


            <!--Sidebar-->
            <?php include(__DIR__ . '/../../../include/sidebar/sidebar.php'); ?>

            <div class="content">

                <!--Navbar-->
                <?php include(__DIR__ . '/../../../include/navbar/navbar.php'); ?>

                <div class="content-header">
                    <div class="container">
                        <div class="row mb-2 py-2 d-flex flex-between-center">
                            <div class="col-sm-6 mb-0 text-sm-start">
                                <h5 class="m-0 heading">
                                </h5>
                            </div><!-- /.col -->
                            <div class="col-sm-6 px-0">
                                <nav style="--falcon-breadcrumb-divider: '»';" aria-label="breadcrumb">
                                    <ol class="breadcrumb float-sm-end">
                                        <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Add User</li>
                                    </ol>
                                </nav>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div>
                <!-- /.content-header -->


                <div class="row g-lg-3 font-sans-serif">

                    <div class="col-lg-6">
                        <div class="sticky-sidebar top-navbar-height d-flex flex-column">
                            <div class="card mb-lg-3 order-lg-0 order-1">
                                <div class="card-header bg-300 py-2 d-flex">
                                    <h5 class="mb-0">Add User</h5>
                                </div>
                                <form action="" method="post" id="addUser">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-12 mb-3"><label class="form-label"
                                                    for="course-name">Username
                                                    <span class="text-danger">*</span></label><input
                                                    class="form-control" name = "username" id="username" type="text"
                                                    placeholder="username" required="required">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 mb-3"><label class="form-label"
                                                    for="course-name">Email
                                                    <span class="text-danger">*</span></label><input
                                                    class="form-control" name = "email" id="email" type="email"
                                                    placeholder="email@example.com" required="required">
                                            </div>

                                        </div>
                                        <div class="row">
                                            
                                            <div class="col-sm-12 mb-3"><label
                                                    for="organizerSingle">Role <span class="text-danger">*</span></label><select
                                                    class="form-select js-choice" id="organizerSingle" size="1"
                                                    name="role"
                                                    data-options='{"removeItemButton":true,"placeholder":true}'>
                                                    <option value="">select role...</option>
                                                    <option value="admin">admin</option>
                                                    <option value="staff">staff</option>
                                                </select>
                                            </div>

                                        </div>
                                        
                                    </div>
                                    <div class="card-footer bg-300 py-2">
                                        <div class="row g-0 justify-content-end">
                                            <div class="col-12 col-md-auto">
                                                <button class="btn btn-primary btn-md px-xxl-5 px-4 fw-medium"
                                                    type="submit" id="btnAddUser">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>

                        </div>
                    </div>

                </div>

                <!--Footer-->
                <?php include(__DIR__ . '/../../../include/footer/footer.php'); ?>
            </div>

        </div>
    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->



    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->
    <?php include(__DIR__ . '/../../../include/script/script.php'); ?>
    <script>
    $(document).on('submit', '#addUser', function(e) {
        e.preventDefault();
        $('#btnAddUser').html(
            '<div class="spinner-border" role="status" style="font-size: 10px;"><span class="sr-only">Loading...</span></div>'
        );
        $('#btnAddUser').addClass('disabled');

        var formData = new FormData(this); // Create a new FormData object from the form

        $.ajax({
            url: '/admin/user/add',
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

                    $('#btnAddUser').html(
                        'Submit');
                    $('#btnAddUser').removeClass('disabled');
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
                        location.reload();
                    }, 1000);
                }
                if (result.code == '418') {
                    Swal.fire({
                        icon: 'error',
                        title: 'Something went wrong!',
                        text: result.msg,
                        footer: '<a href="">Why do I have this issue?</a>',
                    });
                    $('#btnAddUser').html(
                        'Submit');
                    $('#btnAddUser').removeClass('disabled');
                }
            },
        });

    });
    </script>
</body>

</html>

<?php
        } else {
            header('Location: /404');
        }
   } else {
        header('Location: /admin/logout');
    }
} else {
    header('Location: /');
}
?>