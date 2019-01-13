<?php require_once ROOT . "/views/layouts/header.php"; ?>

<div id="page">
    <div id="content">
        <div class="post">
            <?php if ($added): ?>
                <p>
                    Поздравляем, статья была добавлена на сайт!
                    <a class="important_link" href="/"><b>Смотреть</b>.</a>
                </p>
                <p class="links">
                    <a href="/" class="more">На главную</a>
                </p>
            <?php elseif (!empty($categoriesList)): ?>
                <h2 class="title" align="center">Добавить статью</h2>
                <div class="entry">
                    <p>
                        <form action="#" method="post">
                            <fieldset class="invisible_form_field_set">
                                <label for="category"><span class="required_form_field_label">Категория статьи</span></label>
                                <select id="category" name="category" class="input_form_element" required>
                                    <option value="" disabled selected>Выберите категорию</option>
                                    <?php foreach ($categoriesList as $index => $category): ?>
                                        <option value="<?php echo $category['id_category']; ?>"><?php echo $category['name']; ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <label for="title"><span class="required_form_field_label">Заголовок статьи</span></label>
                                <input type="text" id="title" name="title" placeholder="Заголовок статьи" class="input_form_element" required />
                                <label for="content_textarea"><span class="required_form_field_label">Содержимое статьи</span></label>
                                <textarea id="content_textarea" name="content" placeholder="Основной текст" class="text_area_article_content" required></textarea>
                                <input type="submit" name="submit" class="button_form_element" value="Добавить" />
                            </fieldset>
                        </form>
                    </p>
                    <p class="links">
                        <a href="/cabinet" class="more">Назад</a>
                    </p>
                </div>
            <?php else: ?>
                <div>No categories</div>
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
