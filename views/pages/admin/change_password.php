<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if (loggedin()) {

    if (!isLoginSessionExpired()) {

        if ($auth->role == 'admin' || $auth->role == 'staff') {

            $userId = $auth->id;

            //for user profile password  changing
            $oldPassword = filter_input(INPUT_POST, 'oldpass');
            $newPassword = filter_input(INPUT_POST, 'newpass');
            $confirmPassword = filter_input(INPUT_POST, 'confirmpass');

            //existing password
            $existingPassword = $auth->password;

            $checkPassword = ($newPassword == $confirmPassword);
            $newEncPass = password_hash($newPassword, PASSWORD_BCRYPT);

            if (password_verify($oldPassword, $existingPassword)) {

                if ($checkPassword) {

                    if (strlen($newPassword) >= 6  && preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/', $newPassword)) {

                        $chngPassword = $con->prepare("UPDATE usertbl SET password = ? WHERE id = ?  ");
                        $chngPassword->execute([$newEncPass, $userId]);
                        $chngPassword->closeCursor();

                        if ($chngPassword->rowCount() > 0) {

                            echo json_encode([
                                'code' => 200,
                                'msg' => 'Password updated successfully.'
                            ]);
                        } else {
                            echo json_encode([
                                'code' => 419,
                                'msg' => 'Failed to update the password. Please try again later.'
                            ]);
                        }
                    } else {
                        echo json_encode([
                            'code' => 419,
                            'msg' => 'An error occurred. The password must be 6 characters or longer and must contain only letters and numbers (alphanumeric).'
                        ]);
                    }
                } else {
                    echo json_encode([
                        'code' => 419,
                        'msg' => 'An error occurred. The new password must match.'
                    ]);
                }
            } else {
                echo json_encode([
                    'code' => 419,
                    'msg' => "An error occurred. The old password doesn't exist."
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
