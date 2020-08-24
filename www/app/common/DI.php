<?php
    declare(strict_types=1);

    namespace app\common;

    use app\controllers\AppListController;
    use app\sources\AppItemSource;
    use app\views\AppDetailView;
    use app\views\AppListView;
    use Bramus\Router\Router;
    use Mustache_Engine;
    use Mustache_Loader_FilesystemLoader;
    use Mustache_Logger_StreamLogger;

    class DI {

        private static ?Router $router = null;
        private static ?Mustache_Engine $mustache = null;

        private static ?AppListController $appListController = null;
        private static ?AppDetailView $appDetailView = null;
        private static ?AppListView $appListView = null;
        private static ?AppItemSource $appListSource = null;

        public static function appItemSource(): AppItemSource {
            return Utils::lazyInit(self::$appListSource, function () {
                return new AppItemSource();
            });
        }

        public static function appDetailView(): AppDetailView {
            return Utils::lazyInit(self::$appDetailView, function () {
                return new AppDetailView(self::mustache());
            });
        }

        public static function appListView(): AppListView {
            return Utils::lazyInit(self::$appListView, function () {
                return new AppListView(self::mustache());
            });
        }

        public static function appListController(): AppListController {
            return Utils::lazyInit(self::$appListController, function () {
                return new AppListController(
                    self::appListView(),
                    self::appItemSource()
                );
            });
        }

        public static function router(): Router {
            return Utils::lazyInit(self::$router, function () {
                return new Router();
            });
        }

        public static function mustache(): Mustache_Engine {
            return Utils::lazyInit(self::$mustache, function () {
                $loader = new Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/layouts');
                $pLoader = new Mustache_Loader_FilesystemLoader(dirname(__DIR__) . '/layouts/partials');
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

