<?php require_once ROOT . "/views/layouts/header.php"; ?>

<div id="page">
    <div id="content">
        <div class="post">
            <h2 class="title"><a href="/articles/<?php echo $article["id_article"]; ?>"><?php echo $article["title"]; ?></a></h2>
            <p class="meta"><span class="date"><?php echo date("d.m.Y", strtotime($article["date"])); ?></span><span class="posted">Опубликовал: <a href="<?php echo "/user/" . $article["id_author"]; ?>"><?php echo $article["login"]; ?></a></span></p>
            <div style="clear: both;">&nbsp;</div>
            <div class="entry">
                <p><?php echo $article["content"]; ?></p>
                <p class="links">
                    <a href="/" class="more">Назад</a>
                </p>
            </div>
        </div>
        <?php if (empty($comments)): ?>
            <p>К сожалению, никто ещё не оставил комментарий к данной статье...</p>
        <?php else: ?>
            <div style="margin-bottom: 20px;">Комментарии (<?php echo count($comments); ?>):</div>
            <ol class="comments_list">
                <?php foreach ($comments as $comment): ?>
                    <li class="comment_list_element">
                        <div class="comment_body">
                            <div class="comment_author">
                                <img class="comment_user_avatar" src="/template/images/abstract_user.png" width="40" height="40" />
                                <span><a href="/user/<?php echo $comment['id_user']; ?>"><b><?php echo $comment['login']; ?></b></a> <i>говорит</i>:</span>
                            </div>
                            <div class="comment_date"><?php echo date("d.m.Y", strtotime($comment["date"])); ?></div>
                            <div class="comment_content">
                                <p><?php echo $comment["content"]; ?></p>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>
        <?php if (!User::isLogged()): ?>
            <p>Чтобы оставить свой комментарий, <a href="/user/login" class="important_link">войдите</a> на сайт.</p>
        <?php else: ?>
            <?php foreach ($errors as $error): ?>
                <div><p style="color: red;"><?php echo $error; ?></p></div>
            <?php endforeach; ?>
            <form action="#" method="post">
                <p style="margin-bottom: 0;"><label for="content_textarea"><span><b>Добавить комментарий:</b></span></label></p>
                <textarea id="content_textarea" name="content" class="text_area_comment_content" required></textarea>
                <input type="submit" name="submit" class="button_form_element" value="Добавить" />
            </form>
        <?php endif; ?>
        <div style="clear: both;">&nbsp;</div>
    </div>
    <!-- end #content -->
    <?php require_once ROOT . "/views/layouts/sidebar.php"; ?>
    <div style="clear: both;">&nbsp;</div>
</div>
<div class="container"><img src="/template/images/img03.png" width="1000" height="40" alt="" /></div>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>
