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
</head>

<body class="">
    <!-- ===============================================-->
    <!--    Main Content-->
    <!-- ===============================================-->
    <main class="main" id="top">

        <!-- ============================================-->
        <!-- <section> begin ============================-->
        <section class="py-0 overflow-hidden" id="banner" data-bs-theme="light">
            <div class="bg-holder overlay"
                style="background-image:url(/assets/img/std_image.jpeg);background-position: center bottom;filter: blur(8px);">
            </div>
            <div class="container">
                <div class="row flex-center pt-8 pt-lg-10 pb-lg-10 pb-xl-0">
                    <h1 class="text-dark">Welcome to the IAEC University Certificate of Completion
                        Verification Portal.</h1>
                    <div class="col-md-11 col-lg-10 col-xl-10 pb-7 pb-xl-9 text-center text-xl-start">
                        <h1 class="text-white fw-light"><span class="typed-text fw-bold"
                                data-typed-text="[&quot;Verify&quot;,&quot;Validate&quot;,&quot;Confirm&quot;,&quot;Affirm&quot;]"></span><span
                                class="typed-cursor" aria-hidden="true">|</span><br>IAEC University Certicate</h1>
                        <p class="lead opacity-100" style="color:  black; font-weight: bold;">
                            On this portal you can verify the authenticity of IAEC University certificate of
                            completion. To verify a certificate of completion simply enter the Certificate Ref
                            Number or Your Matric Number Below.
                            If the Certificate Ref Number or Your Matric Number is valid you will be provided with
                            the student's information. This
                            information can then be verified against the certificate.</p>
                        <form class="row g-3" action="/student/details/verify" method="post">
                            <div class="col-auto">
                                <input type="text" class="form-control" id="number" placeholder="Ref or Matric Number">
                            </div>
                            <div class="col-auto">
                                <button type="submit"
                                    class="btn btn-outline-light border-2 rounded-pill btn-lg mb-1 fs-0 py-1">Verify</button>
                            </div>
                        </form>

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
    <?php include(__DIR__ . '/../../../include/script/script.php'); ?>


</body>

</html>