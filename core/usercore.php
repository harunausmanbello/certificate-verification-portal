<?php

require 'server.php';

ob_start();



$current_file = $_SERVER[ 'SCRIPT_NAME' ];

if ( isset( $_SERVER[ 'HTTP_REFERER' ] ) && !empty( $_SERVER[ 'HTTP_REFERER' ] ) ) {
    $http_referer = $_SERVER[ 'HTTP_REFERER' ];
}

function loggedin() {
    if ( isset( $_SESSION[ 'user_id' ] ) && !empty( $_SESSION[ 'user_id' ] ) )
    {
        return true;
    } else {
        return false;
    }
}

if ( loggedin() ) {

    $query = $con->query( "SELECT * FROM usertbl WHERE id='".$_SESSION[ 'user_id' ]."'" );
    $query->execute();
    $auth = $query->fetch( PDO::FETCH_OBJ );

    $current_year = date( 'Y' );
    $current_month = date( 'm' );

    if ( $current_month >= 11 ) {
        $start_year = $current_year;
        $end_year = $current_year + 1;
    } else {
        $start_year = $current_year - 1;
        $end_year = $current_year;
    }

    $start_date = $start_year . '-11-01';
    $end_date = $end_year . '-10-31';
    $current_session = date( 'Y', strtotime( $start_date ) ) . '/' . date( 'Y', strtotime( $end_date ) );

}

function isLoginSessionExpired() {
    
    $login_session_duration = getenv( 'APP_SESSION' );

    $current_time = time();

    if ( isset( $_SESSION[ 'loggedin_time' ] ) and isset( $_SESSION[ 'user_id' ] ) ) {

        if ( ( ( time() - $_SESSION[ 'loggedin_time' ] ) > $login_session_duration ) ) {

            return true;

        }

    }
    return false;
}

?>