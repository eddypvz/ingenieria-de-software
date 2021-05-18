<?php
include_once ('inc/main.php');

if (is_login()) {
    header('location: home.php');
}
else {
    header('location: login.php');
}