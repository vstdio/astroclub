<?php require_once ROOT . "/views/layouts/header.php"; ?>

<div id="page">
    <div id="content">
        <div class="post">
            <?php if ($authorized): ?>
                <p>Вы успешно авторизировались под логином <b><?php echo $login; ?></b>!</p>
                <p>Войти в <a class="important_link" href="/cabinet"><b>личный кабинет</b></a>.</p>
                <p class="links">
                    <a href="/" class="more">На главную</a>
                </p>
            <?php else: ?>
                <h2 class="title" align="center">Войти на сайт</h2>
                <div class="entry">
                    <p style="margin-bottom: 40px;" align="center">Пожалуйста, заполните все поля.</p>
                    <?php if (isset($errors) && !empty($errors)): ?>
                        <ul style="margin-bottom: 40px;">
                            <?php foreach ($errors as $error): ?>
                                <li style="color: red;"><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <form action="#" method="post">
                        <fieldset class="invisible_form_field_set">
                            <label for="login">Логин <span style="color: red;">*</span></label>
                            <input type="text" id="login" name="login" placeholder="JohnDoe" value="<?php echo $login; ?>" class="input_form_element" required />
                            <label for="password">Пароль <span style="color: red;">*</span></label>
                            <input type="password" id="password" name="password" placeholder="Не менее 6 символов" value="<?php echo $password; ?>" class="input_form_element" required />
                            <input type="submit" name="submit" class="button_form_element" value="Войти" />
                        </fieldset>
                    </form>
                    <p class="links">
                        <a href="<?php echo isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "/" ?>" class="more">Назад</a>
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
