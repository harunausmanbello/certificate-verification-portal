<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');




?>
<!DOCTYPE html>
<html>

<head>
    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title> Verification | <?= $_ENV['APP_NAME']; ?> </title>
    <?php include(__DIR__ . '/../../../include/header/head.php'); ?>


</head>

<body>

    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-0 overflow-hidden" id="banner" data-bs-theme="light">

            <div class="container">
                <div class="row flex-center pt-8 pt-lg-10 pb-lg-10 pb-xl-0">
                    <button class="btn btn-primary" type="button" id="modalTriggerButton" style="display: none;"
                        data-bs-toggle="modal" data-bs-target="#staticBackdrop"></button>


                    <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" data-bs-backdrop="static"
                        tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg mt-6" role="document">
                            <div class="modal-content border-0">
                                <div class="modal-body p-0">
                                    <div class="bg-light  rounded-top-3 py-3 ps-4 pe-6 text-center">
                                        <img src="/assets/img/iaec-university-logo.png" alt="" class="mx-auto d-block">
                                        <h3>IAEC University Certificate
                                            Verification Portal.</h3>
                                    </div>

                                    <div class="p-4">
                                        <div class="row">
                                            <div class="col-lg-3">
                                                <?php if ($yes) { ?>
                                                <p>yes</p>
                                            </div>
                                            <div class="col-lg-9">
                                                <p>yes</p>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- end of .container-->
        </section><!-- <section> close ============================-->
        <!-- ============================================-->

    </main><!-- ===============================================-->
    <!--    End of Main Content-->
    <!-- ===============================================-->


    <!-- ===============================================-->
    <!--    JavaScripts-->
    <!-- ===============================================-->

    <script>
    $(document).ready(function() {
        $('#modalTriggerButton').click(); // Trigger the modal when the page is loaded
    });
    </script>

    <?php include(__DIR__ . '/../../../include/script/script.php'); ?>

</body>

</html>