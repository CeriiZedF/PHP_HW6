<?php
    require_once __DIR__.'/src/helpers.php';
    checkGuest();
?>

<!DOCTYPE html>
<html lang="ru" data-theme="light">
<?php include_once __DIR__.'/components/head.php' ?>
<body>

<form class="card" action="src/actions/register.php" method="post" enctype="multipart/form-data">
    <h2>Реєстрація</h2>

    <label for="name">
        Ім'я
        <input
            type="text"
            id="name"
            name="name"
            placeholder="введіть ім'я"
            value="<?php echo old('name') ?>"
            <?php echo validationErrorAttr('name'); ?>
        >
        <?php if(hasValidationError('name')) : ?>
            <small><?php echo validationErrorMessage('name') ?></small>
        <?php endif; ?>
    </label>

    <label for="email">
        E-mail
        <input
            type="text"
            id="email"
            name="email"
            placeholder="email@com.com"
            value="<?php echo old('email') ?>"
            <?php echo validationErrorAttr('email'); ?>
        >
        <?php if(hasValidationError('email')) : ?>
            <small><?php echo validationErrorMessage('email') ?></small>
        <?php endif; ?>
    </label>

    <label for="avatar">Зображення профілю
        <input
            type="file"
            id="avatar"
            name="avatar"
            <?php echo validationErrorAttr('avatar'); ?>
        >
        <?php if(hasValidationError('avatar')) : ?>
            <small><?php echo validationErrorMessage('avatar') ?></small>
        <?php endif; ?>
    </label>

    <div class="grid">
        <label for="password">
            Пароль
            <input
                type="password"
                id="password"
                name="password"
                placeholder="******"
                <?php echo validationErrorAttr('password'); ?>
            >
            <?php if(hasValidationError('password')) : ?>
                <small><?php echo validationErrorMessage('password') ?></small>
            <?php endif; ?>
        </label>

        <label for="password_confirmation">
            Подтверждение
            <input
                type="password"
                id="password_confirmation"
                name="password_confirmation"
                placeholder="******"
                <?php echo validationErrorAttr('password_confirmation'); ?>
            >
            <?php if(hasValidationError('password_confirmation')) : ?>
                <small><?php echo validationErrorMessage('password_confirmation') ?></small>
            <?php endif; ?>
        </label>
    </div>

    <fieldset>
        <label for="terms">
            <input
                type="checkbox"
                id="terms"
                name="terms"
            >
            Приймаю умови використання
        </label>
    </fieldset>

    <button
        type="submit"
        id="submit"
        disabled
    >Продолжить</button>
</form>

<p>У меня уже есть <a href="/index.php">аккаунт</a></p>

<script src="assets/app.js"></script>
</body>
</html>