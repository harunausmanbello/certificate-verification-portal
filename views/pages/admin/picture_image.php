<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if (loggedin()) {

    if (!isLoginSessionExpired()) {

        if ($auth->role == 'admin' || $auth->role == 'staff') {

            $userId = $auth->id;

            $profileName = $_FILES['profile_img']['name'];
            $profileTempName = $_FILES['profile_img']['tmp_name'];

            $profileExtension = pathinfo($profileName, PATHINFO_EXTENSION);
            $profileNewName = strtolower(uniqid() . '.' . $profileExtension);
            $profileFolder = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/upload/' . $profileNewName;

            if (isset($profileTempName) && !empty($profileTempName)) {

                $updtprofileImg = $con->prepare("UPDATE usertbl SET profile_img = ? WHERE id = '$userId'");
                $updtprofileImg->execute([$profileNewName]);
                $updtprofileImg->closeCursor();

                if ($updtprofileImg->rowCount() > 0) {

                    move_uploaded_file($profileTempName, $profileFolder);

                    echo json_encode([
                        'code' => 200,
                        'msg' => 'Profile Image updated successfully.'
                    ]);
                } else {
                    echo json_encode([
                        'code' => 419,
                        'msg' => 'Failed to update the profile Image. Please try again later.'
                    ]);
                }
            } else {
                echo json_encode([
                    'code' => 419,
                    'msg' => 'Please fill in all required fields.'
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
