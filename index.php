<?php
include_once ('inc/main.php');

if (is_login()) {
    include_once ('header.php');
    include_once ('home.php');
    include_once ('footer.php');
}
else {
    header('location: login.php');
}