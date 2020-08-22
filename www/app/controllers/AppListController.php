<?php
    declare(strict_types=1);

    namespace app\controllers;

    use app\common\AppsTargetHelper;
    use app\models\AppItemMapper;
    use app\sources\AppListSource;
    use app\views\AppListView;

    class AppListController {

        private AppListView $view;
        private AppListSource $source;

        /**
         * AppListController constructor.
         * @param AppListView $view
         * @param AppListSource $source
         */
        public function __construct(
            AppListView $view,
            AppListSource $source
        ) {
            $this->view = $view;
            $this->source = $source;
        }

        function showList(): string {
            $appList = $this->source->getList();
            $clientAppKeys = AppsTargetHelper::getClientAppKeys();
            $otherAppKeys = AppsTargetHelper::getOtherAppKeys();

            $clientApps = array_map(function ($key) use ($appList) {
                return AppItemMapper::toViewModel($appList[$key]);
            }, $clientAppKeys);

            $otherApps = array_map(function ($key) use ($appList) {
                return AppItemMapper::toViewModel($appList[$key]);
            }, $otherAppKeys);

            return $this->view->render($clientApps, $otherApps);
        }
    }

