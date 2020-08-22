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

<body class="debugs">
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
        <img src="res/images/app_cross_anilibrix.png" class="app_image" alt="anilibrix">
    </div>
    <div class="app_name">AniLibrix</div>
    <!--<div class="app_desc">Просто чоткая аппка</div>-->
    <div class="center_wrapper">
        <div class="app_mod">
            <a href="#" class="btn_download filled">
                <img src="res/icons/ic_apple_white.svg" alt="" class="app_icon">
                <span>Скачать для macOS</span>
            </a>
        </div>
        <div class="app_mod" style="display: none;">
            <a href="#" class="btn_download filled">
                <img src="res/icons/ic_windows_white.svg" alt="" class="app_icon">
                <span>Скачать для Windows</span>
            </a>
        </div>
        <div class="app_mod" style="display: none;">
            <a href="#" class="btn_download filled">
                <img src="res/icons/ic_linux_white.svg" alt="" class="app_icon">
                <span>Скачать для Linux x64</span>
            </a>
        </div>
    </div>
    <div class="center_wrapper">
        <a href="#" class="btn_download small sub">Показать все</a>
    </div>
    <div class="center_wrapper">
        <a href="#" class="btn_download small sub">
            <img src="res/icons/ic_github_primary.svg" alt="" class="app_icon">
            Исходный код
        </a>
    </div>
</main>
</body>
</html>
