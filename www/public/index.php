<?
    require dirname(__DIR__) . '/vendor/autoload.php';
    require dirname(__DIR__) . '/app/common/Consts.php';

    use app\common\DI;
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="/styles/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<body>
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

    $router->get('/app/{appId}/', function ($appId) {
        echo "App $appId";
    });

    $router->run();

?>
</body>

</html>