<?php

//inclue constants.php from SITEURL

include('../config/constants.php');

//1. Destory the session 
session_destroy(); //unset $_session['user']

//2.Redirect the login page
header('location:'.SITEURL.'admin/login.php');


?>