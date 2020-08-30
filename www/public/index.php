<?

    $startTime = microtime(true);

    require dirname(__DIR__) . '/vendor/autoload.php';
    require dirname(__DIR__) . '/app/common/Consts.php';

    use app\common\AppUrlHelper;
    use app\common\Consts;
    use app\common\DI;
    use app\common\Utils;

    function pageStat() {
        global $startTime;
        return "Page generated in " . round((microtime(true) - $startTime), 4) . " seconds. Peak memory usage: " . round(memory_get_peak_usage() / 1048576, 2) . " MB";
    }

?>


<!DOCTYPE html>
<html lang="ru">

<head>
    <meta charset="UTF-8">
    <title>AniLibria - Приложения</title>

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
    <!-- /Favicon -->

    <!--<meta name="og:url" content=""/>
    <meta name="og:site_name" content="IMDb"/>
    <meta name="og:title" content="The Rock"/>
    <meta name="og:description" content="A group of U.S. Marines, under command of..."/>
    <meta name="og:image" content="http://ia.media-imdb.com/rock.jpg"/>-->

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php Utils::includeCss("/styles/style.css"); ?>
</head>

<body class="debug_">
<?

    require dirname(__DIR__) . '/app/views/header.php';

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

    $router->run();

?>

<script>console.log("<?php echo pageStat(); ?>");</script>
</body>

</html>
