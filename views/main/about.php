<?php require_once ROOT . "/views/layouts/header.php"; ?>

<div id="page">
    <div id="content">
            <div class="post">
                <h2 class="title">Добро пожаловать!</h2>
                <div class="entry">
                    <p style="margin-top: 20px;">Сайт создан для быстрого доступа к новостям астроклуба в Йошкар-Оле.</p>
                    <p>Чтобы, добавить новость на сайт, пожалуйста, <a href="/user/register" class="important_link">зарегистрируйтесь</a>.</p>
                    <p>Нашли ошибку? Пожалуйста, <a href="/contacts" class="important_link">напишите</a> об этом.</p>
                    <h2 style="margin-bottom: 20px;" class="title">Статистика</h2>
                    <?php if (!empty($statistics)): ?>
                        <?php foreach ($statistics as $name => $count): ?>
                            <p>Статей на тему <a class="important_link" href="/categories/<?php echo $name; ?>"}><i><?php echo mb_strtolower(Utils::TranslateCategoryName($name)); ?></i></a>: <?php echo $count; ?></p>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p>К сожалению, никто пока не оставил не одной статьи на сайте</p>
                    <?php endif; ?>
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
