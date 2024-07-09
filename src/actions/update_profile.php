<?php
require_once __DIR__.'/../helpers.php';
checkAuth();

$user = currentUser();

$name = $_POST['name'];
$email = $_POST['email'];
$avatar = $_FILES['avatar'];

$errors = [];

if (empty($name)) {
    $errors['name'] = 'Ім\'я не може бути порожнім';
}
if (empty($email)) {
    $errors['email'] = 'Email не може бути порожнім';
}


if (!empty($errors)) {
    setMessage('error', $errors);
    header('Location: /edit_profile.php');
    exit;
}


if ($avatar['error'] === UPLOAD_ERR_OK) {
    $uploadDir = __DIR__.'/../../uploads/';
    $uploadFile = $uploadDir . basename($avatar['name']);


    if ($user['avatar'] && file_exists(__DIR__.'/../../' . $user['avatar'])) {
        unlink(__DIR__.'/../../' . $user['avatar']);
    }


    if (move_uploaded_file($avatar['tmp_name'], $uploadFile)) {
        $avatarPath = 'uploads/' . basename($avatar['name']);
    } else {
        $errors['avatar'] = 'Не вдалося завантажити аватар';
        setMessage('error', $errors); // Використовуємо правильну функцію setMessage
        header('Location: /edit_profile.php');
        exit;
    }
} else {
    $avatarPath = $user['avatar'];
}


try {
    $pdo = getPDO();
    $stmt = $pdo->prepare('UPDATE users SET name = ?, email = ?, avatar = ? WHERE id = ?');
    $stmt->execute([$name, $email, $avatarPath, $user['id']]);

    setMessage('success', ['Профіль успішно оновлено']); // Використовуємо правильну функцію setMessage
    header('Location: /edit_profile.php');
    exit;
} catch (PDOException $e) {
    $errors['database'] = 'Не вдалося оновити дані профілю: ' . $e->getMessage();
    setMessage('error', $errors); // Використовуємо правильну функцію setMessage
    header('Location: /edit_profile.php');
    exit;
}
?>
