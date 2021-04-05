<?php
require_once '../vendor/DB.php';
$data = $_POST;

//Была ли нажата кнопка ЛОГИН
if(isset($data['do_login'])){
    $error = [];
    $user = R::findOne('ho', 'login = ?', [$data['login']]);
    if($user){
        //проверка шифрованого пароля
        //с тем что пользователь ввел и с тем что в БД
        if(password_verify($data['pass'], $user['pass'])){
            //логиним пользователя
            $_SESSION['logged_user'] = $user['id'];
            echo  '<div class="green">Вы успешно вошли</div>';
            echo '<a class="btn btn-success" href="/">Перейи на главную</a>';

        } else {
            $error[] = 'Пользователь с таким логин не найден';

        }
    } else {
        $error[] = 'Пользователь не найден';
    }
    if(! empty($error)){
        echo '<div class="alert_out">' . array_shift($error) . '</div> <br>';
    } else {

    }
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/toastr.min.css">
    <title>Document</title>
</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-md-8 mt-4 offset-md-2">
            <form class="form_big" name="form_big" method="post" action="/template/login.php">
                <fieldset>
                    <legend> Авторизация</legend>
                    <div class="form-group row">

                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Ваше Логин</label>
                        <input name="login"
                               type="text"
                               class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                               placeholder="Введите ваш Логин"

                               value="<?= @$data['login'] ?>">
                    </div>


                    <div class=" form-group">
                        <label for="exampleInputEmail1">Ваше пароль</label>
                        <input name="pass" type="password" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Введите ваш пароль">
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Ваш пароль еще раз</label>
                        <input name="pass2" type="password" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Введите ваш пароль">
                    </div>


                    <button name="do_login" type="submit" class="btn btn-primary">Логин</button>
                </fieldset>
            </form>
            <div class="out"></div>


            <!-- // TOAST-->


        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns"
        crossorigin="anonymous"></script>
<script src="../assets/js/toastr.min.js"></script>
<script src="../assets/js/script.js"></script>
</body>
</html>
