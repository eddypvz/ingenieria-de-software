<?php
include_once ('inc/main.php');

if (is_login()) {
    header('location: file-list.php');
}
else {
    header('location: login.php');
}