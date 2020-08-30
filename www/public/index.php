<?

    $startTime = microtime(true);

    require dirname(__DIR__) . '/vendor/autoload.php';
    require dirname(__DIR__) . '/app/common/Consts.php';

    use app\common\AppUrlHelper;
    use app\common\Consts;
    use app\common\DI;
    use app\common\Utils;

    function pageStat(){
        global $startTime;
        return "Page generated in ".round((microtime(true) - $startTime), 4)." seconds. Peak memory usage: ".round(memory_get_peak_usage()/1048576, 2)." MB";
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AniLibria - Приложения</title>
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
