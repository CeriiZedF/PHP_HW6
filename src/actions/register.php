<?php
    require_once __DIR__.'/../helpers.php';
    echo 'Hi';

    $avatarPath = null;
    $name = $_POST['name'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $passwordConfirmation = $_POST['password_confirmation'] ?? null;
    $avatar = $_FILES['avatar'] ?? null;


    if(empty($name)) {
        setValidationError('name', 'Невірне ім\'я користувача');
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        setValidationError('email', 'Вказана не вірна пошта');
    }
    if(empty($password)) {
        setValidationError('password', 'Пустий пароль');
    }
    if($password!=$passwordConfirmation) {
        setValidationError('password', 'Паролі не співпадають');
    }
    if(!empty($avatar['name'])){
        $types = ['image/jpeg','image/png'];
        if(!in_array($avatar['type'], $types)){
            setValidationError('avatar', 'Аватар має невірний тип тільи jpg та png');
        }
        if(($avatar['size']/1000000) >=1) {
            setValidationError('avatar', 'Аватар має бути не більше 1Мб');
        }
    }

    if(!empty($_SESSION['validation'])) {
        setOldValue('name', $name);
        setOldValue('email',$email);
        redirect('/register.php');
    }

    if(!empty($avatar['name'])) {
        $avatarPath = uploadFile($avatar, 'avatar');
    }
    $pdo = getPDO();
    $query = "INSERT INTO users (name, email, avatar, password) VALUES(:name, :email, :avatar, :password)";
    $params = [
        'name' => $name,
        'email' =>$email,
        'avatar' => $avatarPath,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ];
    $stmt = $pdo->prepare($query);
try {
    $stmt->execute($params);
} catch(PDOException $e) {
    die($e->getMessage());
}
redirect('/');