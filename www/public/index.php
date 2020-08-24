<?
    require dirname(__DIR__) . '/vendor/autoload.php';
    require dirname(__DIR__) . '/app/common/Consts.php';

    use app\common\AppUrlHelper;
    use app\common\Consts;
    use app\common\DI;
    use app\common\Utils;

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php Utils::includeCss("/styles/style.css"); ?>
</head>

<body class="debug_">
<?


    require dirname(__DIR__) . '/app/views/header.php';

    $router = DI::router();

    $router->set404(function () {
        echo '404, route not found!';
    });

    $router->get('/', function () {
        require dirname(__DIR__) . '/app/views/logo.php';
        $appListController = DI::appListController();
        echo $appListController->showList();
    });

    $router->get('/hello', function () {
        echo '<h1>bramus/router</h1><p>Visit <code>/hello/<em>name</em></code> to get your Hello World mojo on!</p>';
    });

    $router->get('/app/{appId}/', function ($appId) use ($router) {
        $appKey = AppUrlHelper::getAppKey($appId);
        echo DI::appDetailView()->render(
            null,
            DI::appItemSource()->getList()[$appKey]
        );
    });

    $router->run();

?>
</body>

</html>
