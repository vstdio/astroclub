<?php require_once ROOT . "/views/layouts/header.php"; ?>

<div id="page">
    <div id="content">
        <div class="post">
            <?php if ($send): ?>
                <p>Сообщение успешно доставлено! Мы ответим вам в ближайшее время.</p>
                <p class="links">
                    <a href="/" class="more important_link">На главную</a>
                </p>
            <?php else: ?>
                <h2 class="title" align="center">Обратная связь</h2>
                <div class="entry">
                    <?php if (isset($errors) && !empty($errors)): ?>
                        <p>
                            <ul style="margin-bottom: 40px;">
                                <?php foreach ($errors as $error): ?>
                                    <li style="color: red;"><?php echo $error; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </p>
                    <?php endif; ?>
                    <p>
                        <form action="#" method="post">
                            <fieldset class="invisible_form_field_set">
                                <label for="email"><span class="required_form_field_label">Ваша почта</span></label>
                                <input id="email" type="email" name="email" class="input_form_element" placeholder="johndoe@gmail.com" value="<?php echo $userEmail; ?>" required />
                                <label for="message"><span class="required_form_field_label">Ваше сообщение</span></label>
                                <textarea id="message" name="message" class="text_area_article_content" placeholder="Текст сообщения"><?php echo $message; ?></textarea>
                                <input type="submit" name="submit" class="button_form_element" value="Отправить" />
                            </fieldset>
                        </form>
                    </p>
                    <p class="links">
                        <a href="/" class="more">На главную</a>
                    </p>
                </div>
            <?php endif; ?>
        </div>
        <div style="clear: both;">&nbsp;</div>
    </div>
    <!-- end #content -->
    <?php require_once ROOT . "/views/layouts/sidebar.php"; ?>
    <div style="clear: both;">&nbsp;</div>
</div>
<div class="container"><img src="/template/images/img03.png" width="1000" height="40" alt="" /></div>

<?php require_once ROOT . "/views/layouts/footer.php"; ?>
