<?php
require_once 'vendor/DB.php';
/*echo '<pre>';
var_dump($_SESSION);
echo '</pre>';*/
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/toastr.min.css">
    <title>Document</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 mt-4 offset-md-2">
            <div class="jumbotron">
                <?php
                $user = R::load('ho', $_SESSION['logged_user']);
                if (!isset($_SESSION['logged_user'])):

                    ?>
                    <h1 class="display-3">Hello, незнакомец!</h1>
                    <p class="lead">Вы не авторизованы или не зарегестрированы</p>
                    <hr class="my-4">

                    <div class="btn_wrapper">
                        <p class="lead">
                            <a class="btn btn-primary btn-lg" href="/template/register.php"
                               role="button">Регистрация </a>
                        </p>
                        <p class="lead">
                            <a class="btn btn-primary btn-lg" href="/template/login.php" role="button">Авторизация</a>
                        </p>
                    </div>
                <?php
                else :
                    ?>
                    <h1 class="display-3">Hello, <?= $user['login'] ?>!</h1>
                    <p class="lead">Вы Авторизованы.</p>
                    <hr class="my-4">
                    <p>Хотите выйти? </p>
                    <p>
                        <a href="/template/logout.php">ВЫЙТИ</a>
                    </p>

                <?php
                endif;
                ?>

            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
<script src="assets/js/toastr.min.js"></script>
<script src="assets/js/script.js"></script>
</body>
</html>
