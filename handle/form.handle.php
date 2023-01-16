<?php
include("../classes/db.class.php");
include("../classes/form.class.php");
$name = $_POST['fullname'];
$email = $_POST['email'];
$password = $_POST['password'];
$execute = new Form();
$check = $execute->handleInput($name, $email, $password);
echo $check;
