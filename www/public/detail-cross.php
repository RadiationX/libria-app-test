<?
    require dirname(__DIR__) . '/vendor/autoload.php';
    use app\common\Utils;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <?php Utils::includeCss("/styles/style.css"); ?>
</head>

<body>
<header class="header">
    <ul class="navbar">
        <li class="bottom_line active"><a href="#">Приложения</a></li>
        <li class="bottom_line"><a href="#">GitHub</a></li>
        <li class="bottom_line"><a href="#">API</a></li>
    </ul>
    <ul class="navbar navbar-right clearfix">
        <li class="bottom_line"><a href="#">Контакты</a></li>
    </ul>
</header>

<div class="divider"></div>


<main class="main detail clearfix">
    <div class="image_wrapper">
        <img src="res/images/app_android_mobile.png" class="app_image">
    </div>
    <div class="app_name">AniLibria Android</div>
    <div class="app_desc">Просто чоткая аппка</div>
    <div class="center_wrapper">
        <a href="#" class="btn_download filled"><img src="res/icons/ic_android_white.svg" alt="" class="app_icon">Скачать
            приложение</a>
        <br>
        <a href="#" class="btn_download small"><img src="res/icons/ic_github_primary.svg" alt="" class="app_icon">Исходный
            код</a>
    </div>
    <div id="how_install" class="text_block  clearfix">
        <h3>Как установить</h3>
        <p style="text-align: left;">
            - Запустите загруженный файл<br>
            - Вы увидите окно с надписью <u>Установка заблокирована</u>, не пугайтесь, нажмите кнопку
            <u>настройки</u>.<br>
            - Найдите пункт <u>Неизвестные источники</u> и выставьте параметр <u>разрешить</u>.<br>
            - Выберите галочку <u>Разрешить только эту установку</u> и нажмите <u>ок</u>.<br>
            - Нажмите установить, когда появится надпись <u>приложение установлено</u>, нажмите <u>открыть</u>.<br>
            - Исходный код доступен на <a href="https://github.com/anilibria/anilibria-app" target="_blank">github</a>.
        </p>
    </div>
</main>
</body>
</html>
