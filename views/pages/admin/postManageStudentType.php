<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

if (loggedin()) {

    if (!isLoginSessionExpired()) {

        if ($auth->role == 'admin' || $auth->role == 'staff') {

            $type = filter_input(INPUT_POST, 'type');

            if ((isset($type) && !empty($type))) {

                if ($type == 'masters') {
                    header('Location: /admin/manage/student/masters');
                } elseif ($type == 'bachelor') {
                    header('Location: /admin/manage/student/bachelor');
                } else {
                    header('Location: /admin/manage/student/type');
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
