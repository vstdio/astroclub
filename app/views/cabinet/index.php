<?php require_once ROOT . "/views/layouts/header.php"; ?>

<div id="page">
    <div id="content">
        <div class="post">
            <h2>Личный кабинет</h2>
            <div style="clear: both;">&nbsp;</div>
            <div class="entry">
                <p>Добро пожаловать, <b><?php echo $user['login']; ?></b>!</p>
                <ul>
                    <li>
                        <a href="/cabinet/edit">Редактировать данные</a>
                    </li>
                    <li>
                        <a href="/user/<?php echo $user['id_user']; ?>">Посмотреть профиль</a>
                    </li>
                    <li>
                        <a href="/articles/add">Добавить статью</a>
                    </li>
                </ul>
                <p class="links">
                    <a href="/" class="more">На главную</a>
                </p>
            </div>
        </div>
        <div style="clear: both;">&nbsp;</div>
    </div>
    <!-- end #content -->
    <?php require_once ROOT . "/views/layouts/sidebar.php"; ?>
    <div style="clear: both;">&nbsp;</div>
</div>
<div class="container"><img src="/template/images/img03.png" width="1000" height="40" alt="" /></div>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>
