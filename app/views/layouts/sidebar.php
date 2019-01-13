<?php
    require_once ROOT . "/components/Utils.php";
    require_once ROOT . "/models/User.php";
?>

<div id="sidebar">
    <ul>
        <li>
            <div id="search">
                <form method="get" action="/search">
                    <div>
                        <input type="text" name="query" id="search-text" value="" placeholder="Строка для поиска" required />
                        <input type="submit" id="search-submit" value="Найти" />
                    </div>
                </form>
            </div>
            <div style="clear: both;">&nbsp;</div>
        </li>
        <li>
            <h2>Панель навигации</h2>
            <ul>
                <?php if (!User::isLogged()): ?>
                    <li>
                        <a href="/user/login">Войти</a>
                    </li>
                    <li>
                        <a href="/user/register">Регистрация</a>
                    </li>
                <?php else: ?>
                    <li>
                        <a href="/cabinet">Личный кабинет</a>
                    </li>
                    <li>
                        <a href="/user/logout">Выйти</a>
                    </li>
                <?php endif; ?>
            </ul>
        </li>
        <li>
            <h2>Категории</h2>
            <ul>
                <?php foreach ($categoriesList as $category): ?>
                    <li>
                        <a href="/categories/<?php echo $category["id_category"]; ?>"><?php echo $category["name"]; ?></a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <?php if (!empty($lastArticles)): ?>
            <li>
                <h2>Последние статьи</h2>
                <ul>
                    <?php foreach ($lastArticles as $lastArticle): ?>
                        <li><a style="line-height: 1.5" href="/articles/<?php echo $lastArticle["id_article"]; ?>"><?php echo $lastArticle["title"]; ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </li>
        <?php endif; ?>
        <li>
            <h2>Нашли ошибку?</h2>
            <p>Пожалуйста, <a class="important_link" href="/contacts/">сообщите мне об этом</a>.</p>
        </li>
    </ul>
</div>
