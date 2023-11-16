<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('core/usercore.php');

$userId = $auth->id;

$fname = filter_input(INPUT_POST, 'fname');
$lname = filter_input(INPUT_POST, 'lname');
$userName = filter_input(INPUT_POST, 'username');
$email = filter_input(INPUT_POST, 'email');
$phone = filter_input(INPUT_POST, 'phone');
$address = filter_input(INPUT_POST, 'address');


if ((isset($fname) && !empty($fname)) && (isset($lname) && !empty($lname)) && (isset($phone) && !empty($phone)) && (isset($address) && !empty($address)) ) {

    $updtProfile = $con->prepare("UPDATE usertbl SET fname = :fname, lname = :lname, username = :username, email = :email, phone = :phone, address = :address WHERE id = :userId ");
    $updtProfile->bindParam(':fname',$fname,PDO::PARAM_STR);
    $updtProfile->bindParam(':lname',$lname,PDO::PARAM_STR);
    $updtProfile->bindParam(':username',$userName,PDO::PARAM_STR);
    $updtProfile->bindParam(':email',$email,PDO::PARAM_STR);
    $updtProfile->bindParam(':phone',$phone,PDO::PARAM_STR);
    $updtProfile->bindParam(':address',$address,PDO::PARAM_STR);
    $updtProfile->bindParam(':userId',$userId,PDO::PARAM_INT);
    $updtProfile->execute();
    $updtProfile->closeCursor();

    if($updtProfile->rowCount() > 0 ){

        echo  json_encode([
            'code' => 200,
            'msg' => 'Profile updated successfully'

        ]);

    }else{

        echo  json_encode([
            'code' => 419,
            'msg' => 'Failed to update the profile. Please try again.'

        ]);

    }
    
} else {
    $response = [
        'code' => 419,
        'msg' => 'Please fill in all required fields.',
    ];
    echo json_encode($response);
}
