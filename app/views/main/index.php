<?php require_once ROOT . "/views/layouts/header.php"; ?>

<div id="page">
    <div id="content">
        <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
                <div class="post">
                    <h2 class="title"><a href="/articles/<?php echo $article["id_article"]; ?>"><?php echo $article["title"]; ?></a></h2>
                    <p class="meta"><span class="date"><?php echo date("d.m.Y", strtotime($article["date"])); ?></span><span class="posted">Опубликовал: <a href="<?php echo "/user/" . $article["id_author"]; ?>"><?php echo $article["author_name"]; ?></a></span></p>
                    <div style="clear: both;">&nbsp;</div>
                    <div class="entry">
                        <?php if (strlen($article["preview"]) != 0): ?>
                            <img src="<?php echo $article["preview"]; ?>" align="middle" />
                        <?php endif; ?>
                        <p><?php echo $article["short_content"]; ?></p>
                        <p class="links">
                            <a href="/articles/<?php echo $article["id_article"]; ?>" class="more">Подробнее</a>
                            <a href="/articles/<?php echo $article["id_article"]; ?>" title="b0x" class="comments">Комментарии (<?php echo $article["comment_count"]; ?>)</a>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
            <div style="clear: both;">&nbsp;</div>
            <?php echo $pagination->get(); ?>
        <?php else: ?>
            <p>К сожалению, сюда ещё пока никто не добавил статью...</p>
            <?php if (!User::isLogged()): ?>
                <p>Чтобы добавить статью, пожалуйста, <a href="/user/login" class="important_link">авторизуйтесь</a> на сайте.</p>
            <?php else: ?>
                <p>Будьте первыми, кто это сделает! <a href="/articles/add" class="important_link">Добавить.</a></p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <!-- end #content -->
    <?php require_once ROOT . "/views/layouts/sidebar.php"; ?>
    <div style="clear: both;">&nbsp;</div>
</div>
<div class="container"><img src="/template/images/img03.png" width="1000" height="40" alt="" /></div>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>
