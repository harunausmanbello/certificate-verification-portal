<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if (loggedin()) {

    if (!isLoginSessionExpired()) {

        if ($auth->role == 'admin') {

            $userName = filter_input(INPUT_POST, 'username');
            $userRole = filter_input(INPUT_POST, 'role');
            $userMail = filter_input(INPUT_POST, 'email');
            $password = "cvp123";
            $userPassword = password_hash($password, PASSWORD_BCRYPT);

            if ((isset($userName) && !empty($userName)) && (isset($userRole) && !empty($userRole))) {

                //checking for existing user
                $exstUserQeury  = "SELECT * FROM usertbl WHERE username = :username";
                $exstUser  = $con->prepare($exstUserQeury);
                $exstUser->bindParam(':username', $userName, PDO::PARAM_STR);
                $exstUser->execute();
                $exstUser->closeCursor();

                if ($exstUser->rowCount() > 0) {

                    echo json_encode([
                        'code' => 419,
                        'msg' => 'User already exist.'
                    ]);
                } else {

                    $addQeury = "INSERT INTO usertbl (username, password, email, role) VALUES (:username, :password, :email, :role)";
                    $add = $con->prepare($addQeury);
                    $add->bindParam(':username', $userName, PDO::PARAM_STR);
                    $add->bindParam(':password', $userPassword, PDO::PARAM_STR);
                    $add->bindParam(':email', $userMail, PDO::PARAM_STR);
                    $add->bindParam(':role', $userRole, PDO::PARAM_STR);
                    $add->execute();
                    $add->closeCursor();

                    if ($add->rowCount() > 0) {

                        echo json_encode([
                            'code' => 200,
                            'msg' => 'The user was added successfully.'
                        ]);
                    } else {

                        echo json_encode([
                            'code' => 419,
                            'msg' => 'Fail to add user.'
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
