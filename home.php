<?php
    require_once __DIR__.'/src/helpers.php';
    checkAuth();
    $user = currentUser();
?>
<!DOCTYPE html>
<html lang="ru" data-theme="light">
<?php include_once __DIR__.'/components/head.php' ?>
<body>

<div class="card home">
    <?php if($user['avatar']!=null): ?>
        <img
                class="avatar"
                src="<?php echo htmlspecialchars($user['avatar'], ENT_QUOTES, 'UTF-8') ?>"
                alt="<?php echo htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?>"
        >
    <?php endif; ?>

    <h1>Вітаємо, <?= htmlspecialchars($user['name'], ENT_QUOTES, 'UTF-8') ?></h1>
    <form action="src/actions/logout.php" method="post">
        <button role="button">Вихід</button>
    </form>

    <p><a href="edit_profile.php">Редагувати профіль</a></p>
</div>


<script src="assets/app.js"></script>
</body>
</html>