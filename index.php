<?php require_once __DIR__.'/src/helpers.php'; checkGuest(); ?>
<!DOCTYPE html>
<html lang="ru" data-theme="light">
<?php include_once __DIR__.'/components/head.php' ?>
<body>

<form class="card" action="src/actions/login.php" method="post">
    <h2>Вхід</h2>

    <?php if(hasMessage('error')): ?>
    <div class="notice error"><?php echo getMessage('error') ?></div>
    <?php endif; ?>

    <!--<div class="notice success">Какое-то сообщение</div>-->

    <label for="email">
        Имя
        <input
            type="text"
            id="email"
            name="email"
            placeholder="введіть email"
            value = "<?php echo old('email') ?>"
            <?php echo validationErrorAttr('email'); ?>
        >
        <?php if(hasValidationError('email')) : ?>
            <small><?php echo validationErrorMessage('email') ?></small>
        <?php endif; ?>
    </label>

    <label for="password">
        Пароль
        <input
            type="password"
            id="password"
            name="password"
            placeholder="******"
        >
    </label>

    <button
        type="submit"
        id="submit"
    >Зайти</button>
</form>

<p>Реєстрація <a href="/register.php"> акаунта</a></p>

<script src="assets/app.js"></script>
</body>
</html>