<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if(isset($_GET['error'])){
    $error_msg = $_GET['error'];
}
?>
<!DOCTYPE html>
<html>

<head>
    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title> Verification | <?= $_ENV['APP_NAME']; ?> </title>
    <?php include(__DIR__ . '/../../../include/header/head.php'); ?>

    <style type="text/css" data-typed-js-css="true">
    .typed-cursor {
        opacity: 1;
    }

    .typed-cursor.typed-cursor--blink {
        animation: typedjsBlink 0.7s infinite;
        -webkit-animation: typedjsBlink 0.7s infinite;
        animation: typedjsBlink 0.7s infinite;
    }

    @keyframes typedjsBlink {
        50% {
            opacity: 0.0;
        }
    }

    @-webkit-keyframes typedjsBlink {
        0% {
            opacity: 1;
        }

        50% {
            opacity: 0.0;
        }

        100% {
            opacity: 1;
        }
    }
    </style>
    <script>
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.setAttribute('data-bs-theme', 'light');
    }
    </script>
</head>

<body class="">

    <main class="main" id="top">
        <input class="btn-check" id="themeSwitcherLight" style="display: none;" name="theme-color" type="radio"
            value="light" data-theme-control="theme" checked="true">

        <div class="container" data-layout="container">

            <div class="row flex-center min-vh-100 py-6">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4">

                    <div class="card">
                        <div class="card-header bg-400 py-2 d-flex">
                            <a class="d-flex flex-center mb-1" style="margin-left: 6.5em;"><img class="mr-5"
                                    src="/assets/img/<?= $_ENV['APP_LOGO']; ?>" alt="school logo" style="width:100%" />
                            </a>
                        </div>
                        <div class="card-body p-4 p-sm-4">
                            <form action="/certicate/verification" method="post">
                                <div class="row">
                                    <div class="col-sm-12 mb-3"><label class="form-label" for="course-name">Ref/Matric
                                            Number
                                            <span class="text-danger">*</span></label><input class="form-control"
                                            name="matric" id="matric" type="text"
                                            placeholder="Enter the Ref/Matric Number">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 mb-2"><label class="form-label" for="course-name">Select a
                                            Certificate Type<span class="text-danger">*</span>
                                            <div class="form-check mt-2"><input class="form-check-input" id="bsc"
                                                    type="radio" name="bsc" value="bsc" /><label
                                                    class="form-check-label" for="bsc">Bachelor's Certificate</label>
                                            </div>
                                            <div class="form-check "><input class="form-check-input" id="msc"
                                                    type="radio" name="msc" value="msc" /><label
                                                    class="form-check-label" for="msc">Masters's Certificate</label>
                                            </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <button class="btn btn-primary btn-md px-xxl-5 px-4 fw-medium" type="submit"
                                            id="btnAddUser">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-footer bg-400 py-2">
                            <div class="row g-0 justify-content-center">
                                <div class="col-12 col-md-auto">
                                    <h6 style="font-style:italic">
                                        To verify a certificate or certified copy issued by the <?= $_ENV['SCHOOL_NAME']; ?>,
                                        enter the Certificate Verification Number (Ref Number) located on your
                                        certificate or
                                        your school Registration Number (Matric Number).
                                    </h6>

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

    <script src="/Include_files/bootstrap5/jquery/jquery.min.js"></script>
    <script src="/Include_files/bootstrap5/chosen/chosen.jquery.min.js"></script>
    <script>
    window.onload = function() {
        <?php if (isset($error_msg)): ?>
        Swal.fire({
            title: 'Something Went Wrong',
            text: '<?php echo $error_msg; ?>',
            icon: 'error',
            confirmButtonText: 'OK',
            confirmButtonColor: '#0275d8',
        });
        <?php endif; ?>
    }
    </script>




</body>

</html>