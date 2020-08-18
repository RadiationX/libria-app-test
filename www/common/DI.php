<?php

    use Bramus\Router\Router;

    class DI {

        private static $appListController = null;
        private static $router = null;
        private static $mustache = null;

        public static function appListController() {
            return self::byLazy(self::$appListController, function () {
                new  AppListController();
            });
        }

        public static function router() {
            return self::byLazy(self::$router, function () {
                require_once dirname(__FILE__) . '/../deps/router/src/Bramus/Router/Router.php';
                return new Router();
            });
        }

        public static function mustache() {
            return self::byLazy(self::$mustache, function () {
                require_once dirname(__FILE__) . '/../deps/mustache/src/Mustache/Autoloader.php';
                Mustache_Autoloader::register();
                $loader = new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/../layouts');
                $pLoader = new Mustache_Loader_FilesystemLoader(dirname(__FILE__) . '/../layouts/partials');
                $logger = new Mustache_Logger_StreamLogger('php://stderr');
                return new Mustache_Engine(array(
                    'loader' => $loader,
                    'partials_loader' => $pLoader,
                    'escape' => function ($value) {
                        return htmlspecialchars($value, ENT_COMPAT, 'UTF-8');
                    },
                    'charset' => 'UTF-8',
                    'logger' => $logger,
                    'strict_callables' => true
                ));
            });
        }

        private static function byLazy($variable, $fn) {
            if ($variable == null && is_callable($fn)) {
                $variable = call_user_func($fn);
            }
            return $variable;
        }
    }

