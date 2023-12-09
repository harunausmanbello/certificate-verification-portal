<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if (loggedin()) {

    if (!isLoginSessionExpired()) {

        if ($auth->role == 'admin' || $auth->role == 'staff') {

            $userQeury = "SELECT * FROM bachelor";
            $user = $con->prepare($userQeury);
            $user->execute();
            $userData = $user->fetchAll();
            $user->closeCursor();
            $sn = 1;

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>

    <?php include(__DIR__ . '/../../../include/header/head.php'); ?>
    <title> Manage Bachelor Student | <?= $_ENV['APP_NAME'] ;?> </title>

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
                                        <li class="breadcrumb-item"><a href="/admin/manage/student/type">Type</a></li>
                                        <li class="breadcrumb-item active" aria-current="page">Manage</li>
                                    </ol>
                                </nav>
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.container -->
                </div>
                <!-- /.content-header -->

                <div class="row g-lg-3 font-sans-serif">

                    <div class="col-12">
                        <div class="sticky-sidebar top-navbar-height d-flex flex-column">
                            <div class="card mb-lg-3 order-lg-0 order-1">
                                <div class="card-header bg-300 py-2 d-flex">
                                    <h5 class="mb-0">Manage  Bachelor Student</h5>
                                </div>
                                <div class="card-body">

                                    <div class="row">
                                        <div class="tab-content">
                                            <table class="table table-bordered mb-0 data-table fs--1">
                                                <thead class="bg-200 text-900">
                                                    <tr>
                                                        <th style="width:2%">#</th>
                                                        <th class="sort">Name</th>
                                                        <th style="width:10%" class="sort">Matric No.</th>
                                                        <th style="width:10%" class="sort">Ref No.</th>
                                                        <th style="width:30%" class="sort">Department</th>
                                                        <th style="width:15%" class="sort text-end">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach( $userData as $data) {?>
                                                    <tr>
                                                        <td><?= $sn; ?></td>
                                                        <td><?= strtoupper($data['fullname']) ; ?>
                                                        </td>
                                                        <td><?= strtoupper($data['regno']); ?></td>
                                                        <td><?= strtoupper($data['refno']); ?></td>
                                                        <td><?= strtoupper($data['department']); ?></td>
                                                        <td class="text-center">
                                                            <div class="row">
                                                                <div class="col-sm-6">
                                                                    <a href="/admin/student/bachelor/edit?id=<?= $data['id']; ?>"
                                                                        class="btn text-primary"><i
                                                                            class="fa-solid fa-pen-to-square"></i></a>
                                                                </div>
                                                                <div class="col-sm-6 ">
                                                                    <form class="delUser" method="post">
                                                                        <input type="hidden" name="userId"
                                                                            value="<?= $data['id']; ?>">
                                                                        <button type="submit"
                                                                            class="btn delbtn text-danger">
                                                                            <i class="fa-solid fa-trash"></i>
                                                                        </button>

                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <!--Edit Modal-->

                                                    <?php $sn++; } ?>

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                </div>

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
    $(document).on('submit', '.delUser', function(e) {
        e.preventDefault();
        var $submitButton = $(this).find('.delbtn');

        $submitButton.html(
            '<div class="spinner-border" role="status" style="font-size: 10px;"><span class="sr-only">Loading...</span></div>'
        );
        $submitButton.addClass('disabled');

        var formData = new FormData(this); // Create a new FormData object from the form

        $.ajax({
            url: '/admin/student/bachelor/delete',
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

                    $('#delbtn').html(
                        '<i  class = "fa-solid fa-trash" > < /i>');
                    $('#delbtn').removeClass('disabled');
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
                    $('#delbtn').html(
                        '<i  class = "fa-solid fa-trash" > < /i>');
                    $('#delbtn').removeClass('disabled');
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