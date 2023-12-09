<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if (loggedin()) {

    if (!isLoginSessionExpired()) {

        if ($auth->role == 'admin' || $auth->role == 'staff') {

            $userId = $auth->id;

            $coverName = $_FILES['cover_img']['name'];
            $coverTempName = $_FILES['cover_img']['tmp_name'];

            $coverExtension = pathinfo($coverName, PATHINFO_EXTENSION);
            $coverNewName = strtolower(uniqid() . '.' . $coverExtension);
            $coverFolder = $_SERVER['DOCUMENT_ROOT'] . '/assets/img/upload/' . $coverNewName;

            if (isset($coverTempName) && !empty($coverTempName)) {

                $updtCoverImg = $con->prepare("UPDATE usertbl SET cover_img = ? WHERE id = '$userId'");
                $updtCoverImg->execute([$coverNewName]);
                $updtCoverImg->closeCursor();

                if ($updtCoverImg->rowCount() > 0) {

                    move_uploaded_file($coverTempName, $coverFolder);

                    echo json_encode([
                        'code' => 200,
                        'msg' => 'Cover Image updated successfully.'
                    ]);
                } else {
                    echo json_encode([
                        'code' => 419,
                        'msg' => 'Failed to update the Cover Image. Please try again later.'
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
