<?php

    use Bramus\Router\Router;

    class DI {

        private static ?Router $router = null;
        private static ?Mustache_Engine $mustache = null;
        private static ?BrowserInfo $browserInfo = null;
        private static ?AppsTargetHelper $appsTargetHelper = null;

        private static ?AppListController $appListController = null;
        private static ?AppListView $appListView = null;
        private static ?AppListSource $appListSource = null;

        /**
         * @return AppListSource
         */
        public static function appListSource(): AppListSource {
            return Utils::lazyInit(self::$appListSource, function () {
                return new AppListSource();
            });
        }

        /**
         * @return AppListView
         */
        public static function appListView(): AppListView {
            return Utils::lazyInit(self::$appListView, function () {
                return new AppListView(self::mustache());
            });
        }

        /**
         * @return AppListController
         */
        public static function appListController(): AppListController {
            return Utils::lazyInit(self::$appListController, function () {
                return new AppListController(
                    self::appListView(),
                    self::appListSource(),
                    self::appsTargetHelper()
                );
            });
        }

        /**
         * @return AppsTargetHelper
         */
        public static function appsTargetHelper(): AppsTargetHelper {
            return Utils::lazyInit(self::$appsTargetHelper, function () {
                return new AppsTargetHelper(self::browserInfo());
            });
        }

        /**
         * @return BrowserInfo
         */
        public static function browserInfo(): BrowserInfo {
            return Utils::lazyInit(self::$browserInfo, function () {
                return new BrowserInfo();
            });
        }

        /**
         * @return Router
         */
        public static function router(): Router {
            return Utils::lazyInit(self::$router, function () {
                require_once dirname(__FILE__) . '/../deps/router/src/Bramus/Router/Router.php';
                return new Router();
            });
        }

        /**
         * @return Mustache_Engine
         */
        public static function mustache(): Mustache_Engine {
            return Utils::lazyInit(self::$mustache, function () {
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

    }

