<?
require dirname(__FILE__).'/deps/mustache/src/Mustache/Autoloader.php';
Mustache_Autoloader::register();

$options =  array('extension' => '.html');
$mustache = new Mustache_Engine(array(
    'loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/layouts', $options),
    'partials_loader' => new Mustache_Loader_FilesystemLoader(dirname(__FILE__).'/layouts/partials', $options),
    'escape' => function($value) {
        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
    },
    'charset' => 'UTF-8',
    'logger' => new Mustache_Logger_StreamLogger('php://stderr'),
    'strict_callables' => true
));

$tpl = $mustache->loadTemplate('foo');
echo $tpl->render(array('bar' => 'baz'));


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="styles/style.css">
</head>

<body>
    <?
        require('views/header.php');
        require('views/logo.php');
        require('views/app-items.php');
    ?>
</body>

</html>
