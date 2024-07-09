<?php
require_once __DIR__.'/src/helpers.php';
checkAuth();
$user = currentUser();
?>
<!DOCTYPE html>
<html lang="ru" data-theme="light">
<?php include_once __DIR__.'/components/head.php' ?>
<body>

<form class="card" action="src/actions/update_profile.php" method="post" enctype="multipart/form-data">
    <h2>Редагування профілю</h2>

    <?php if(hasMessage('success')): ?>
        <div class="notice success"><?php echo getMessage('success') ?></div>
    <?php endif; ?>

    <?php if(hasMessage('error')): ?>
        <div class="notice error"><?php echo getMessage('error') ?></div>
    <?php endif; ?>

    <label for="name">
        Ім'я
        <input
            type="text"
            id="name"
            name="name"
            value="<?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>"
        >
    </label>

    <label for="email">
        Email
        <input
            type="email"
            id="email"
            name="email"
            value="<?php echo htmlspecialchars($user['email'], ENT_QUOTES, 'UTF-8') ?>"
        >
    </label>

    <label for="avatar">
        Аватар
        <input
            type="file"
            id="avatar"
            name="avatar"
        >
    </label>

    <button type="submit">Оновити</button>
</form>

<p><a href="home.php">Назад до профілю</a></p>

<script src="assets/app.js"></script>
</body>
</html>
