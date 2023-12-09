<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if (loggedin()) {

    if (!isLoginSessionExpired()) {

        if ($auth->role == 'admin' || $auth->role == 'staff') {

            $userId = filter_input(INPUT_POST, 'userId');

            if ((isset($userId) && !empty($userId))) {

                //checking for existing user
                $delUserQeury  = "DELETE FROM masters WHERE id = :id";
                $delUser  = $con->prepare($delUserQeury);
                $delUser->bindParam(':id', $userId, PDO::PARAM_STR);
                $delUser->execute();
                $delUser->closeCursor();

                if ($delUser->rowCount() > 0) {

                    echo json_encode([
                        'code' => 200,
                        'msg' => 'The student has been deleted successfully.'
                    ]);
                } else {

                    echo json_encode([
                        'code' => 419,
                        'msg' => 'Fail to delete the student.'
                    ]);
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
