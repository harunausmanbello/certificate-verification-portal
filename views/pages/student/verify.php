<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

$matricNumber = filter_input(INPUT_POST,'matric');

$mscProgram = filter_input(INPUT_POST,'msc');
$bscProgram = filter_input(INPUT_POST,'bsc');

if(isset($mscProgram)){

    $program = $mscProgram;

}else{

    $program = $bscProgram;

}

$bscRowCount = '';
$mscRowCount = '';

  



?>
<!DOCTYPE html>
<html>

<head>
    <!-- ===============================================-->
    <!--    Document Title-->
    <!-- ===============================================-->
    <title> Verification | <?= $_ENV['APP_NAME']; ?> </title>
    <?php include(__DIR__ . '/../../../include/header/head.php'); ?>
    <script>
    if (localStorage.getItem('theme') === 'dark') {
        document.documentElement.setAttribute('data-bs-theme', 'light');
    }
    </script>
</head>

<body>



    <main class="main" id="top">
        <div class="container" data-layout="container">

            <div class="row flex-center min-vh-100 py-6">
                <div class="col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-4">

                    <div class="card">
                        <div class="card-header bg-400 py-2 d-flex">
                            <a class="d-flex flex-center mb-1" style="margin-left: 6em;"><img class=""
                                    src="/assets/img/<?= $_ENV['APP_LOGO']; ?>" alt="school logo" style="width:100%" />
                            </a>
                        </div>
                        <div class="card-body p-4 p-sm-4">
                            <div class="row">

                                <?php
                                  if(empty($matricNumber) && (empty($bscProgram) || empty($mscProgram))){

                                    header('Location: /verify-certificate?error=Please fill in all the required fields.');

                                  }else{
                              
                                      if(isset($bscProgram) && isset($mscProgram)){

                                        header('Location: /verify-certificate?error=Please select only one (1) certificate type and try again.');
                              
                                      }else{
                              
                                          if((isset($bscProgram) && !empty($bscProgram))){

                                            $bscQuery = $con->prepare('SELECT * FROM bachelor WHERE regno = :reg OR refno = :ref');
                                            $bscQuery->bindParam(':reg', $matricNumber, PDO::PARAM_STR);
                                            $bscQuery->bindParam(':ref', $matricNumber, PDO::PARAM_STR);
                                            $bscQuery->execute();
                                            $bscData = $bscQuery->fetch(PDO::FETCH_OBJ);
                                            $bscRowCount = $bscQuery->rowCount();
                                            $bscQuery->closeCursor();
                                            
                              
                                          }elseif((isset($mscProgram) && !empty($mscProgram))){
                                            $mscQuery = $con->prepare('SELECT * FROM masters WHERE regno = :reg OR refno = :ref');
                                            $mscQuery->bindParam(':reg', $matricNumber, PDO::PARAM_STR);
                                            $mscQuery->bindParam(':ref', $matricNumber, PDO::PARAM_STR);
                                            $mscQuery->execute();
                                            $mscData = $mscQuery->fetch(PDO::FETCH_OBJ);
                                            $mscRowCount = $mscQuery->rowCount();
                                            $mscQuery->closeCursor();
                                          }else{

                                            header('Location: /verify-certificate?error=Please select certificate type and try again.');
                              
                                          }
                              
                              
                                      }
                              
                                  }
                                ?>
                                <?php if(( isset($program) && ($program == 'bsc')) && ($bscRowCount > 0) ){  $status = true; ?>
                                <div class="col-sm-12 mb-3">
                                    <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                                        <div class="bg-success me-3 icon-item"><span
                                                class="fas fa-check-circle text-white fs-3"></span></div>
                                        <p class="mb-0 flex-1" style="text-transform: uppercase;">VERIFIED STUDENT OF <?= $_ENV['SCHOOL_NAME']; ?></p>
                                    </div>
                                    <p style="font-weight: bold; color:red">NAME:
                                        <span
                                            style="font-family:'Times New Roman', Times, serif; color:black;"><?= isset($bscData->fullname) ? strtoupper($bscData->fullname) : ''; ?></span>
                                    </p>
                                    <p style="font-weight: bold; color:red">DEPARTMENT:
                                        <span
                                            style="font-family:'Times New Roman', Times, serif; color:black;"><?= isset($bscData->department) ? strtoupper($bscData->department) : ''; ?></span>
                                    </p>
                                    <p style="font-weight: bold; color:red">PROGRAM:
                                        <span
                                            style="font-family:'Times New Roman', Times, serif; color:black;"><?= isset($bscData->program) ? strtoupper($bscData->program) : ''; ?></span>
                                    </p>
                                    <p style="font-weight: bold; color:red">GRADE:
                                        <span
                                            style="font-family:'Times New Roman', Times, serif; color:black;">
                                            <?php
                                            if(isset($bscData->grade) && ($bscData->grade == 'first')){

                                                echo "FIRST CLASS";

                                            }elseif(isset($bscData->grade) && ($bscData->grade == 'upper')){

                                                echo "SECOND CLASS (UPPER DIVISION)";

                                            }elseif(isset($bscData->grade) && ($bscData->grade == 'lower')){

                                                echo "SECOND CLASS (LOWER DIVISION)";

                                            }elseif(isset($bscData->grade) && ($bscData->grade == 'third')){

                                                echo "THIRD CLASS";


                                            }elseif(isset($bscData->grade) && ($bscData->grade == 'pass')){

                                                echo "PASS";

                                            }else{
                                                echo "NO GRADE";
                                            }
                                            ?>
                                        </span>
                                    </p>
                                    <p style="font-weight: bold; color:red">YEAR OF GRADUATION:
                                        <span
                                            style="font-family:'Times New Roman', Times, serif; color:black;"><?= isset($bscData->year) ? strtoupper($bscData->year) : ''; ?></span>
                                    </p>
                                    <p style="font-weight: bold; color:red">CURRENT STATUS:
                                        <span
                                            style="font-family:'Times New Roman', Times, serif; color:black;"><?= isset($bscData->status) ? strtoupper($bscData->status) : ''; ?></span>
                                    </p>

                                </div>
                                <?php }elseif((isset($program) && ($program == 'msc')) && ($mscRowCount > 0 )){ $status = true; ?>
                                <div class="col-sm-12 mb-3">
                                    <div class="alert alert-success border-2 d-flex align-items-center" role="alert">
                                        <div class="bg-success me-3 icon-item"><span
                                                class="fas fa-check-circle text-white fs-3"></span></div>
                                        <p class="mb-0 flex-1" style="text-transform: uppercase;">VERIFIED STUDENT OF <?= $_ENV['SCHOOL_NAME']; ?></p>
                                    </div>
                                    <p style="font-weight: bold; color:red">NAME:
                                        <span
                                            style="font-family:'Times New Roman', Times, serif; color:black;"><?= isset($mscData->fullname) ? strtoupper($mscData->fullname) : ''; ?></span>
                                    </p>
                                    <p style="font-weight: bold; color:red">DEPARTMENT:
                                        <span
                                            style="font-family:'Times New Roman', Times, serif; color:black;"><?= isset($mscData->department) ? strtoupper($mscData->department) : ''; ?></span>
                                    </p>
                                    <p style="font-weight: bold; color:red">PROGRAM:
                                        <span
                                            style="font-family:'Times New Roman', Times, serif; color:black;"><?= isset($mscData->program) ? strtoupper($mscData->program) : ''; ?></span>
                                    </p>
                                    <p style="font-weight: bold; color:red">YEAR OF GRADUATION:
                                        <span
                                            style="font-family:'Times New Roman', Times, serif; color:black;"><?= isset($mscData->year) ? strtoupper($mscData->year) : ''; ?></span>
                                    </p>
                                    <p style="font-weight: bold; color:red">CURRENT STATUS: <span
                                            style="font-family:'Times New Roman', Times, serif; color:black;"><?= isset($mscData->status) ? strtoupper($mscData->status) : ''; ?></span>
                                    </p>
                                </div>
                                <?php }else{  $status = false; ?>

                                <div class="alert alert-danger border-2 d-flex align-items-center" role="alert">
                                    <div class="bg-danger me-3 icon-item"><span
                                            class="fas fa-times-circle text-white fs-3"></span></div>
                                    <p class="mb-0 flex-1">NOT A VERIFIED STUDENT OF <?= $_ENV['SCHOOL_NAME']; ?></p>
                                </div>
                                <?php }?>
                            </div>

                            <div class="row">
                                <div class="col-sm-12">

                                    <a class="btn btn-primary btn-md px-xxl-5 px-4 fw-medium"
                                        href="/verify-certificate">Back</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer bg-400 py-2">
                            <div class="row g-0 justify-content-center">
                                <div class="col-12 col-md-auto">
                                    <h6 style="font-style:italic;color:black">
                                        Certificate Verification Status <img
                                            src="/assets/img/<?php if($status){echo 'verified.png'; }else{echo 'unverified.png';} ?>"
                                            alt="" style="width:3em ;height:3em;margin-left:1em" class="movable-image"
                                            srcset="">
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


</body>

</html>