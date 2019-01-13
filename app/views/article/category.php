<?php require_once ROOT . "/views/layouts/header.php"; ?>

<div id="page">
    <div id="content">
        <?php if (empty($articles)): ?>
            <p>К сожалению статей по данной категории ещё не добавлено...</p>
        <?php else: ?>
            <?php foreach ($articles as $article): ?>
                <div class="post">
                    <h2 class="title"><a href="/articles/<?php echo $article["id_article"]; ?>"><?php echo $article["title"]; ?></a></h2>
                    <p class="meta"><span class="date"><?php echo date("d.m.Y", strtotime($article["date"])); ?></span><span class="posted">Опубликовал: <a href="/users/<?php echo $article["id_user"]; ?>"><?php echo $article["login"]; ?></a></span></p>
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
        <?php endif; ?>
        <div style="clear: both;">&nbsp;</div>
        <?php echo $pagination->get(); ?>
    </div>
    <!-- end #content -->
    <?php require_once ROOT . "/views/layouts/sidebar.php"; ?>
    <div style="clear: both;">&nbsp;</div>
</div>
<div class="container"><img src="/template/images/img03.png" width="1000" height="40" alt="" /></div>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>
