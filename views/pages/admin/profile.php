<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if (loggedin()) {

    if (!isLoginSessionExpired()) {

        if ($auth->role == 'admin' || $auth->role == 'staff') {

            

?>
<!DOCTYPE html>
<html data-bs-theme="light" lang="en-US" dir="ltr">

<meta http-equiv="content-type" content="text/html;charset=utf-8" />

<head>

    <?php include(__DIR__ . '/../../../include/header/head.php'); ?>
    <title> Profile | <?= $_ENV['APP_NAME'] ;?> </title>


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
                <div class="row">
                    <div class="col-12">
                        <div class="card mb-3 btn-reveal-trigger">
                            <div class="card-header position-relative min-vh-25 mb-8">
                                <div class="cover-image">
                                    <div class="bg-holder rounded-3 rounded-bottom-0"
                                        style="background-image:url(../../../assets/img/upload/<?php if(isset($auth->cover_img)){ echo $auth->cover_img;}else { echo 'verify5.jpeg'; } ?>);">
                                    </div>

                                    <input class="d-none" id="upload-cover-image" name="cover_img" type="file">
                                    <label class="cover-image-file-input" for="upload-cover-image"><svg
                                            class="svg-inline--fa fa-camera fa-w-16 me-2" aria-hidden="true"
                                            focusable="false" data-prefix="fas" data-icon="camera" role="img"
                                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" data-fa-i2svg="">
                                            <path fill="currentColor"
                                                d="M512 144v288c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48h88l12.3-32.9c7-18.7 24.9-31.1 44.9-31.1h125.5c20 0 37.9 12.4 44.9 31.1L376 96h88c26.5 0 48 21.5 48 48zM376 288c0-66.2-53.8-120-120-120s-120 53.8-120 120 53.8 120 120 120 120-53.8 120-120zm-32 0c0 48.5-39.5 88-88 88s-88-39.5-88-88 39.5-88 88-88 88 39.5 88 88z">
                                            </path>
                                        </svg>
                                        <span>Change
                                            cover photo</span></label>
                                </div>
                                <div class="avatar avatar-5xl avatar-profile shadow-sm img-thumbnail rounded-circle">
                                    <div class="h-100 w-100 rounded-circle overflow-hidden position-relative"> <img
                                            src="../../../assets/img/upload/<?php if(isset($auth->profile_img)){ echo $auth->profile_img;}else { echo 'avatar.svg'; }  ?>"
                                            width="200" alt="" data-dz-thumbnail="data-dz-thumbnail"><input
                                            class="d-none" id="profile-image" type="file" name="profile_img"><label
                                            class="mb-0 overlay-icon d-flex flex-center" for="profile-image"><span
                                                class="bg-holder overlay overlay-0"></span><span
                                                class="z-1 text-white dark__text-white text-center fs--1"><svg
                                                    class="svg-inline--fa fa-camera fa-w-16" aria-hidden="true"
                                                    focusable="false" data-prefix="fas" data-icon="camera" role="img"
                                                    xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                                    data-fa-i2svg="">
                                                    <path fill="currentColor"
                                                        d="M512 144v288c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V144c0-26.5 21.5-48 48-48h88l12.3-32.9c7-18.7 24.9-31.1 44.9-31.1h125.5c20 0 37.9 12.4 44.9 31.1L376 96h88c26.5 0 48 21.5 48 48zM376 288c0-66.2-53.8-120-120-120s-120 53.8-120 120 53.8 120 120 120 120-53.8 120-120zm-32 0c0 48.5-39.5 88-88 88s-88-39.5-88-88 39.5-88 88-88 88 39.5 88 88z">
                                                    </path>
                                                </svg>
                                                <span class="d-block">Update</span></span></label></div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-8">
                                        <h4 class="mb-1"><b>Name:</b> <?= ucwords($auth->fname .' '. $auth->lname); ?>
                                        </h4>
                                        <h5 class="fs-0 fw-normal"><b>Role:</b> <?= ucwords($auth->role); ?></h5>
                                        <h5 class="fs-0 fw-normal"><b>Username:</b> <?= ucwords($auth->username); ?></h5>
                                        <h5 class="fs-0 fw-normal"><b>Email:</b> <?= ucwords($auth->email); ?></h5>
                                        <p class="text-500"><b>Address:</b> <?= ucwords($auth->address); ?></p>
                                        <p class="text-500" style="margin-top: -1em;"><b>Contact:</b> <?= ucwords($auth->phone); ?></p>
                                        <button class="btn btn-falcon-primary btn-sm px-3" type="submit"
                                            id="show_profile">Edit Profile</span></button>
                                        <div class="border-bottom border-dashed my-4 d-lg-none"></div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="row g-0" style="display: none;" id="profile_block">
                    <div class="col-lg-8 pe-lg-2">
                        <div class="card mb-3">
                            <div class="card-header">
                                <h5 class="mb-0">Profile Settings</h5>
                            </div>
                            <div class="card-body bg-light">
                                <form class="row g-3" method="post" id="updateprofile">
                                    <div class="col-lg-6"> <label class="form-label" for="first-name">First
                                            Name</label><input class="form-control" id="first-name" name="fname"
                                            type="text" value="<?= ucwords($auth->fname); ?>"></div>
                                    <div class="col-lg-6"> <label class="form-label" for="last-name">Last
                                            Name</label><input class="form-control" id="last-name" name="lname"
                                            type="text" value="<?= ucwords($auth->lname); ?>"></div>
                                    <div class="col-lg-6"><label class="form-label" for="email3">Username</label><input
                                            class="form-control" id="email3" type="text" name="username"
                                            value="<?= ucwords($auth->username); ?>">
                                    </div>
                                    <div class="col-lg-6"> <label class="form-label" for="email1">Email</label><input
                                            class="form-control" id="email1" type="text" name="email"
                                            value="<?= ucwords($auth->email); ?>">
                                    </div>
                                    <div class="col-lg-6"> <label class="form-label" for="email2">Phone</label><input
                                            class="form-control" id="email2" type="text" name="phone"
                                            value="<?= ucwords($auth->phone); ?>"></div>
                                    <div class="col-lg-6"><label class="form-label" for="address">Address</label><input
                                            class="form-control" id="address" type="text" name="address"
                                            value="<?= ucwords($auth->address); ?>">
                                    </div>

                                    <div class="col-12 d-flex justify-content-end"><button class="btn btn-primary"
                                            type="submit" id="btnprofileupdate">Update </button></div>
                                </form>
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-4 ps-lg-2">
                        <div class="sticky-sidebar">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="mb-0">Change Password</h5>
                                </div>
                                <div class="card-body bg-light">
                                    <form id="changePassword" method="post">
                                        <div class="mb-3"><label class="form-label" for="old-password">Old
                                                Password</label><input class="form-control" name="oldpass"
                                                id="old-password" type="password"></div>
                                        <div class="mb-3"><label class="form-label" for="new-password">New
                                                Password</label><input class="form-control" name="newpass"
                                                id="new-password" type="password"></div>
                                        <div class="mb-3"><label class="form-label" for="confirm-password">Confirm
                                                Password</label><input class="form-control" name="confirmpass"
                                                id="confirm-password" type="password"></div><button
                                            class="btn btn-primary d-block w-100" name="btnupdatepass"
                                            type="submit">Update Password
                                        </button>
                                    </form>
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
    $(document).ready(function() {
        $('#show_profile').click(function() {
            $('#profile_block').slideToggle();
        });
    });
    </script>

    <script>
    $(document).on('submit', '#updateprofile', function(e) {
        e.preventDefault();
        $('#btnprofileupdate').html(
            '<div class="spinner-border" role="status" style="font-size: 10px;"><span class="sr-only">Loading...</span></div>'
        );
        $('#btnprofileupdate').addClass('disabled');

        var formData = new FormData(this); // Create a new FormData object from the form

        $.ajax({
            url: '/admin/profile/update',
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

                    $('#btnprofileupdate').html(
                        'Update');
                    $('#btnprofileupdate').removeClass('disabled');
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
                    }, 500);
                }
                if (result.code == '418') {
                    Swal.fire({
                        icon: 'error',
                        title: result.msg,
                        text: 'Something went wrong!',
                        footer: '<a href="">Why do I have this issue?</a>',
                    });
                    $('#btnprofileupdate').html(
                        'Update');
                    $('#btnprofileupdate').removeClass('disabled');
                }
            },
        });

    });
    </script>

    <script>
    $(document).on('submit', '#changePassword', function(e) {
        e.preventDefault();
        $('#btnupdatepass').html(
            '<div class="spinner-border" role="status" style="font-size: 10px;"><span class="sr-only">Loading...</span></div>'
        );
        $('#btnupdatepass').addClass('disabled');

        var formData = new FormData(this); // Create a new FormData object from the form

        $.ajax({
            url: '/admin/profile/password/update',
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

                    $('#btnupdatepass').html(
                        'Update Password');
                    $('#btnupdatepass').removeClass('disabled');
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
                    }, 500);
                }
                if (result.code == '418') {
                    Swal.fire({
                        icon: 'error',
                        title: result.msg,
                        text: 'Something went wrong!',
                        footer: '<a href="">Why do I have this issue?</a>',
                    });
                    $('#btnupdatepass').html(
                        'Update Password');
                    $('#btnupdatepass').removeClass('disabled');
                }
            },
        });

    });
    </script>

    <script>
    $(document).ready(function() {
        $('#profile-image').change(function() {
            var file = this.files[0];
            var formData = new FormData();
            formData.append('profile_img', file);
            $.ajax({
                type: 'POST',
                url: '/admin/profile/image/picture',
                data: formData,
                dataType: 'json',
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
                        }, 1500);
                    }
                    if (result.code == '418') {
                        Swal.fire({
                            icon: 'error',
                            title: result.msg,
                            text: 'Something went wrong!',
                            footer: '<a href="">Why do I have this issue?</a>',
                        });
                    }
                }
            });
        });
    });
    </script>

    <script>
    $(document).ready(function() {
        $('#upload-cover-image').change(function() {

            var file = this.files[0];
            var formData = new FormData();
            formData.append('cover_img', file);

            $.ajax({
                type: 'POST',
                url: '/admin/profile/image/cover',
                data: formData,
                dataType: 'json',
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
                        }, 1500);
                    }
                    if (result.code == '418') {
                        Swal.fire({
                            icon: 'error',
                            title: result.msg,
                            text: 'Something went wrong!',
                            footer: '<a href="">Why do I have this issue?</a>',
                        });
                    }
                }
            });
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