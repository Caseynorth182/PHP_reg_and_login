<?php
require_once '../vendor/DB.php';
$data = $_POST;
if (isset($data['do_signup'])) {
    //тут регистрация
    $errors = [];
    if (trim($data['login']) == '') {
        $errors[] = 'Введите логин';
    }
    if (trim($data['email']) == '') {
        $errors[] = 'Введите EMAIL';
    }
    if ($data['pass'] == '') {
        $errors[] = 'Введите пароль';
    }
    if ($data['pass2'] !== $data['pass']) {
        $errors[] = 'Повторный пароль введен не верно';
    }
    //Проверкаб не создан ли пользователь с такми же логино или email
    if (R::count('ho', 'login = ? OR email = ?', [$data['login'], $data['email']]) > 0){
        echo '<div class="alert_out">Пользователь с таким Логином или паролем уже создан</div> <br>';
        echo '<a href="/template/register.php">Вернуться</a>';
        die();
    }

    if (empty($errors)) {
        //все ок регестрируем
        $user = R::dispense('ho');
        $user['login'] = $data['login'];
        $user['email'] = $data['email'];
        $user['date'] = date('Y-m-d');
        //ШИФРОВАНИЕ ПАРОЛЯ ------
        $user['pass'] = password_hash($data['pass'], PASSWORD_DEFAULT);
        //------
        R::store($user);
        echo  '<div class="green">Вы успешно зарегестрировались</div>';
    } else {
        //извлекаем первый элемент массива и выводим его
        echo '<div class="alert_out">' . array_shift($errors) . '</div> <br>';
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
            <form class="form_big" name="form_big" method="post" action="/template/register.php">
                <fieldset>
                    <legend> Регистрация</legend>
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

                    <div class="form-group">
                        <label for="exampleInputEmail1">Ваш Email</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1"
                               aria-describedby="emailHelp" placeholder="Введите Ваш Email"
                               value="<?= @$data['email']?>">
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


                    <button name="do_signup" type="submit" class="btn btn-primary">Зарегестрироватся</button>
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
