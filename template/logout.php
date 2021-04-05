<?php
require_once '../vendor/DB.php';

unset($_SESSION['logged_user']);

header('Location: /');
