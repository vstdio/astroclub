<?php require_once ROOT . "/views/layouts/header.php"; ?>
<div id="page">
    <div id="content">
        <p>По вашему запросу <b><?php echo $query; ?></b> было найдено <?php echo count($articles) ?> совпадений.</p>
        <?php foreach ($articles as $article): ?>
            <div class="post">
                <p>
                    <a href="/articles/<?php echo $article["id_article"]; ?>"><?php echo key($articles) + 1 . ". "; echo $article["title"]; ?></a>
                </p>
            </div>
        <?php endforeach; ?>
        <p>
            <a href="/" class="more">На главную</a>
        </p>
        <div style="clear: both;">&nbsp;</div>
    </div>
    <!-- end #content -->
    <?php require_once ROOT . "/views/layouts/sidebar.php"; ?>
    <div style="clear: both;">&nbsp;</div>
</div>
<div class="container"><img src="/template/images/img03.png" width="1000" height="40" alt="" /></div>
<?php require_once ROOT . "/views/layouts/footer.php"; ?>
