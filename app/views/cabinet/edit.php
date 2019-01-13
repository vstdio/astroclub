<?php require_once ROOT . "/views/layouts/header.php"; ?>

<div id="page">
    <div id="content">
        <div class="post">
                <h2 class="title" align="center">Редактирование данных</h2>
                <div class="entry">
                    <p style="margin-bottom: 40px;" align="center">Пожалуйста, измените нужные вам поля.</p>
                    <?php if (!empty($edited)): ?>
                        <ul style="margin-bottom: 40px;">
                            <?php foreach ($edited as $edit): ?>
                                <li style="color: deepskyblue;"><?php echo $edit; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if (!empty($errors)): ?>
                        <ul style="margin-bottom: 40px;">
                            <?php foreach ($errors as $error): ?>
                                <li style="color: red;"><?php echo $error; ?></li>
                            <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                    <form action="#" method="post">
                        <fieldset class="invisible_form_field_set">
                            <label for="email">E-mail</label>
                            <input type="email" id="email" name="email" placeholder="Новый e-mail" value="<?php echo $email; ?>" class="input_form_element" />
                            <label for="password">Пароль</label>
                            <input type="password" id="password" name="password" placeholder="Новый пароль" value="<?php echo $password; ?>" class="input_form_element" />
                            <label for="password_confirm">Подтвердите пароль</label>
                            <input type="password" id="password_confirm" name="password_confirm" placeholder="Подтверждение нового пароля" value="<?php echo $passwordConfirm; ?>" class="input_form_element" />
                            <label for="phone">Телефон</label>
                            <input type="text" id="phone" name="phone" placeholder="Номер телефона" value="<?php echo $phoneNumber; ?>" class="input_form_element" />
                            <input type="submit" name="submit" value="Сохранить изменения" class="button_form_element" />
                        </fieldset>
                    </form>
                    <p class="links">
                        <a href="/cabinet" class="more">Назад</a>
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
