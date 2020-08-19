<?
    require_once dirname(__FILE__) . '/common/Consts.php';
    require_once dirname(__FILE__) . '/models/AppItem.php';
    require_once dirname(__FILE__) . '/models/AppRequirements.php';
    require_once dirname(__FILE__) . '/common/Utils.php';
    require_once dirname(__FILE__) . '/common/BrowserInfo.php';
    require_once dirname(__FILE__) . '/common/AppsTargetHelper.php';
    require_once dirname(__FILE__) . '/common/DI.php';
    require_once dirname(__FILE__) . '/controllers/AppListController.php';
    require_once dirname(__FILE__) . '/views/AppListView.php';
    require_once dirname(__FILE__) . '/sources/AppListSource.php';
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


    require('views/header.php');

    $router = DI::router();

    $router->set404(function () {
        echo '404, route not found!';
    });

    $router->get('/', function () {
        require('views/logo.php');
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
