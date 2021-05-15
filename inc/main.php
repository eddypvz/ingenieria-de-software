<?php
session_start();

include_once ('db.php');

function dd( $var ) {
    print '<pre>';
    print_r($var);
    print '</pre>';
}

function is_login() {
    if ( !empty($_SESSION['login']) && $_SESSION['login'] === true ) {
        return true;
    }
    else {
        return false;
    }
}

function do_login($user, $password) {
    global $db;
    $strQuery = "SELECT * FROM user WHERE user = '{$user}' AND password = '{$password}'";
    $user = $db->get_one_row($strQuery);

    if (!$user) {
        return false;
    }
    else {
        $_SESSION['login'] = true;
        $_SESSION['login_data'] = [];
        $_SESSION['login_data']['id'] = $user['id_user'];
        $_SESSION['login_data']['user'] = $user['user'];
        $_SESSION['login_data']['name'] = "{$user['name']} {$user['lastname']}";
        return true;
    }
}

// globales
$db = new DB();