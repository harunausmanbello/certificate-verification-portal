<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if (loggedin()) {

    if (!isLoginSessionExpired()) {

        if ($auth->role == 'admin' || $auth->role == 'staff') {

            $fullname = filter_input(INPUT_POST, 'fullname');
            $dept = filter_input(INPUT_POST, 'dept');
            $matric = filter_input(INPUT_POST, 'regno');
            $ref = filter_input(INPUT_POST, 'refno');
            $year = filter_input(INPUT_POST, 'year');
            $program = 'masters degree';
            $status = 'graduate';
           

            if ((isset($fullname) && !empty($fullname)) && (isset($dept) && !empty($dept)) &&
            (isset($matric) && !empty($matric)) && (isset($ref) && !empty($ref)) && (isset($year) && !empty($year))
            ) {

                //checking for existing user
                $exstUserQeury  = "SELECT * FROM masters WHERE regno = :regno OR refno = :refno ";
                $exstUser  = $con->prepare($exstUserQeury);
                $exstUser->bindParam(':regno', $matric, PDO::PARAM_STR);
                $exstUser->bindParam(':refno', $ref, PDO::PARAM_STR);
                $exstUser->execute();
                $exstUser->closeCursor();

                if ($exstUser->rowCount() > 0) {

                    echo json_encode([
                        'code' => 419,
                        'msg' => 'Student already exist.'
                    ]);
                } else {

                    $addQeury = "INSERT INTO masters (fullname, department, regno, refno, year, program, status) 
                    VALUES (:fullname, :dept, :regno, :refno, :year, :program, :status)";
                    $add = $con->prepare($addQeury);
                    $add->bindParam(':fullname', $fullname, PDO::PARAM_STR);
                    $add->bindParam(':dept', $dept, PDO::PARAM_STR);
                    $add->bindParam(':regno', $matric, PDO::PARAM_STR);
                    $add->bindParam(':refno', $ref, PDO::PARAM_STR);
                    $add->bindParam(':year', $year, PDO::PARAM_STR);
                    $add->bindParam(':program', $program, PDO::PARAM_STR);
                    $add->bindParam(':status', $status, PDO::PARAM_STR);
                    $add->execute();
                    $add->closeCursor();

                    if ($add->rowCount() > 0) {

                        echo json_encode([
                            'code' => 200,
                            'msg' => 'The student was added successfully.'
                        ]);

                    } else {

                        echo json_encode([
                            'code' => 419,
                            'msg' => 'Fail to add student.'
                        ]);
                    }
                }
            } else {
                
                echo json_encode([
                    'code' => 419,
                    'msg' => 'Please fill in all the required fields.'
                ]);
            }

        } else {
            header('Location: /404');
        }
    } else {
        header('Location: /admin/logout');
    }
} else {
    header('Location: /');
}
