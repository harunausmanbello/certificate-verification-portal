<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

$id = filter_input(INPUT_POST, 'id');
$newPass = filter_input(INPUT_POST, 'newpass');
$confirmPass = filter_input(INPUT_POST, 'confirmpass');


if ((isset($id) && !empty($id)) && (isset($newPass) && !empty($newPass)) && (isset($confirmPass) && !empty($confirmPass))) {

    $checkPassword = ($newPass == $confirmPass);
    $encryptpass = password_hash($newPass, PASSWORD_BCRYPT);

    if ($checkPassword) {

        if (strlen($newPass) >= 6  && preg_match('/^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/', $newPass)) {

            $query = "UPDATE usertbl SET password = '$encryptpass' WHERE id = '$id'";
            $statement = $con->prepare($query);
            $statement->execute();

            if ($statement->rowCount() > 0) {

                $response = [
                    'code' => 200,
                    'msg' => 'Password created successfully..',
                ];
                echo json_encode($response);
            } else {

                $response = [
                    'code' => 419,
                    'msg' => 'Failed to create the password. Please try again later.',
                ];
                echo json_encode($response);
            }
        } else {
            echo json_encode([
                'code' => 419,
                'msg' => 'An error occurred. The password must be 6 characters or longer and must contain only letters and numbers (alphanumeric).'
            ]);
        }

    } else {
        $response = [
            'code' => 419,
            'msg' => 'An error occurred. The new password must match.'
        ];
        echo json_encode($response);
    }
} else {
    $response = [
        'code' => 419,
        'msg' => 'Please fill in all required fields.',
    ];
    echo json_encode($response);
}
