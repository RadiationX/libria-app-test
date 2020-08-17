<?
    require_once dirname(__FILE__) . '/deps/mustache/src/Mustache/Autoloader.php';
    require_once dirname(__FILE__) . '/deps/router/src/Bramus/Router/Router.php';

    use Bramus\Router\Router;

    Mustache_Autoloader::register();
    $router = new Router();

    $options = array('extension' => '.html');
    $mustache = new Mustache_Engine(array(
        'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/layouts', $options),
        'partials_loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/layouts/partials', $options),
        'escape' => function ($value) {
            return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
        },
        'charset' => 'UTF-8',
        'logger' => new Mustache_Logger_StreamLogger('php://stderr'),
        'strict_callables' => true
    ));


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


    $router->set404(function () {
        echo '404, route not found!';
    });

    $router->get('/', function () use ($mustache) {
        require('views/logo.php');
        require('views/app-items.php');
    });

    $router->get('/hello', function () {
        echo '<h1>bramus/router</h1><p>Visit <code>/hello/<em>name</em></code> to get your Hello World mojo on!</p>';
    });

    $router->run();

?>
</body>

</html>
