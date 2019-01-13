<?php require_once ROOT . "/views/layouts/header.php"; ?>

<div id="page">
    <div id="content">
        <div class="post">
            <h2 class="title" align="center">Профиль <b><?php echo $user['login']; ?></b></h2>
            <div class="entry">
                <p>
                    <ul class="unordered_list">
                        <li>Ранг: <b><?php echo $user['role']; ?></b></li>
                        <li>Дата регистрации: <b><?php echo date("Y-m-d", strtotime($user['registration_date'])); ?></b></li>
                        <li>Количество опубликованных статей: <b><?php echo $userPostCount; ?></b></li>
                        <li>Количество оставленных комментариев: <b><?php echo $userCommentCount; ?></b></li>
                    </ul>
                </p>
                <p class="links">
                    <a href="/" class="more">Назад</a>
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
