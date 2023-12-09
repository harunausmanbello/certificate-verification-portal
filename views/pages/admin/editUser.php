<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if (loggedin()) {

    if (!isLoginSessionExpired()) {

        if ($auth->role == 'admin') {

            $id = filter_input(INPUT_GET,'id');

            $userQeury = "SELECT * FROM usertbl WHERE id = :id";
            $user = $con->prepare($userQeury);
            $user->bindParam(':id', $id, PDO::PARAM_STR);
            $user->execute();
            $userData = $user->fetch(PDO::FETCH_OBJ);
            $user->closeCursor();

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>

    <?php include(__DIR__ . '/../../../include/header/head.php'); ?>
    <title> Edit User | <?= $_ENV['APP_NAME'] ;?> </title>

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
                                        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
                                    </ol>
                                </nav>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div>
                <!-- /.content-header -->


                <div class="row g-lg-3 font-sans-serif">
                    
                    <div class="col-lg-6 ">
                        <div class="sticky-sidebar top-navbar-height d-flex flex-column">
                            <div class="card mb-lg-3 order-lg-0 order-1">
                                <div class="card-header bg-300 py-2 d-flex">
                                    <h5 class="mb-0">Edit User</h5>
                                </div>
                                <form action="" method="post" id="editUser">
                                    <div class="card-body">
                                        <div class="row">
                                            <input type="hidden" name="userId" value="<?= $userData->id; ?>">
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 mb-3"><label class="form-label"
                                                    for="course-name">Username
                                                    <span class="text-danger">*</span></label><input
                                                    class="form-control" value="<?= $userData->username; ?>" name="username" id="username" type="text"
                                                    placeholder="username" required="required">
                                            </div>

                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 mb-3"><label class="form-label"
                                                    for="course-name">Email
                                                    <span class="text-danger">*</span></label><input
                                                    class="form-control" name="email" value="<?= $userData->email; ?>" id="email" type="email"
                                                    placeholder="email@example.com" required="required">
                                            </div>

                                        </div>
                                        <div class="row">

                                            <div class="col-sm-12 mb-3"><label for="organizerSingle">Role <span
                                                        class="text-danger">*</span></label><select
                                                    class="form-select js-choice" id="organizerSingle" size="1"
                                                    name="role"
                                                    data-options='{"removeItemButton":true,"placeholder":true}'>
                                                    <option value="">select role...</option>
                                                    <option value="admin" <?php if($userData->role == 'admin'){ echo 'selected = "selected"';}  ?>>admin</option>
                                                    <option value="staff" <?php if($userData->role == 'staff'){ echo 'selected = "selected"';}  ?>>staff</option>
                                                </select>
                                            </div>

                                        </div>
                                        <div class="row">

                                        <div class="col-sm-12 mb-3"><label class="form-label"
                                                    for="course-name">Reset Password?
                                                    </label> <input
                                                     name="reset" value="yes" id="reset" type="checkbox"
                                                    >
                                            </div>

                                        </div>

                                    </div>
                                    <div class="card-footer bg-300 py-2">
                                        <div class="row g-0 justify-content-end">
                                            <div class="col-12 col-md-auto">
                                                <button class="btn btn-primary btn-md px-xxl-5 px-4 fw-medium"
                                                    type="submit" id="btnEditUser">Submit</button>
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
    $(document).on('submit', '#editUser', function(e) {
        e.preventDefault();
        $('#btnEditUser').html(
            '<div class="spinner-border" role="status" style="font-size: 10px;"><span class="sr-only">Loading...</span></div>'
        );
        $('#btnEditUser').addClass('disabled');

        var formData = new FormData(this); // Create a new FormData object from the form

        $.ajax({
            url: '/admin/user/edit',
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

                    $('#btnEditUser').html(
                        'Submit');
                    $('#btnEditUser').removeClass('disabled');
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
                    $('#btnEditUser').html(
                        'Submit');
                    $('#btnEditUser').removeClass('disabled');
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