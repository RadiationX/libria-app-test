<?
    require dirname(__DIR__) . '/vendor/autoload.php';
    require dirname(__DIR__) . '/app/common/Consts.php';

    use app\common\AppUrlHelper;
    use app\common\Consts;
    use app\common\DI;
    use app\common\Utils;

    $router = DI::router();

    $router->set404(function () {
        echo '404, нет такой страницы';
    });

    $router->get('/', function () {
        require dirname(__DIR__) . '/app/views/logo.php';
        $appListController = DI::appListController();
        echo $appListController->showList();
    });

    $router->get('/app/{urlAppId}/', function ($urlAppId) use ($router) {
        try {
            $appId = AppUrlHelper::getAppKey($urlAppId);
            $controller = DI::appDetailController();
            echo $controller->showDetail($appId);
        } catch (Throwable $ex) {
            echo "Произошла ошибка";
        }
    });

    ob_start();
    $router->run();
    $pageContent = ob_get_contents();
    ob_end_clean();

?>


<!DOCTYPE html>
<html lang="ru" prefix="og: http://ogp.me/ns#">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- #Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="/res/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/res/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/res/favicon/favicon-16x16.png">
    <link rel="manifest" href="/res/favicon/site.webmanifest">
    <link rel="mask-icon" href="/res/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <link rel="shortcut icon" href="/res/favicon/favicon.ico">
    <meta name="msapplication-TileColor" content="#ba3c41">
    <meta name="msapplication-config" content="/res/favicon/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    <?php
        echo DI::pageHeadView()->render(DI::pageHeadData())
    ?>

    <?php Utils::includeCss("/styles/style.css"); ?>
</head>

<body class="debug_">
<? require dirname(__DIR__) . '/app/views/header.php'; ?>
<? echo $pageContent; ?>
</body>

</html>
