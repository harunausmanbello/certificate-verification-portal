<?php
ini_set( 'display_errors', 1 );
ini_set( 'display_startup_errors', 1 );
error_reporting( E_ALL );

require_once('core/usercore.php');

$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

if (!empty($username) && !empty($password) ) {

    $query = "SELECT * FROM usertbl WHERE username = :username";
    $statement = $con->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();
    $count = $statement->rowCount();
    $user = $statement->fetch(PDO::FETCH_OBJ);

    if ($count > 0) {

        if (password_verify($password, $user->password)) {          

            $user_id = $user->id;
            $_SESSION['user_id'] = $user_id;
            $_SESSION['loggedin_time'] = time();

            echo json_encode([
                'code' => 200,
                'msg' => 'You have successfully logged in.'
            ]);
            
        }else{

            echo json_encode([
                'code' => 419,
                'msg' => 'Password is invalid.'
            ]);    
        }

    }else{

        echo json_encode([
            'code' => 419,
            'msg' => 'Username is invalid.'
        ]);     
    }

}
else{
    echo json_encode([
        'code' => 419,
        'msg' => 'Please fill in all required fields.'
    ]); 
}