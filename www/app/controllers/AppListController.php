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
        private AppsTargetHelper $targetHelper;

        /**
         * AppListController constructor.
         * @param AppListView $view
         * @param AppListSource $source
         * @param AppsTargetHelper $targetHelper
         */
        public function __construct(
            AppListView $view,
            AppListSource $source,
            AppsTargetHelper $targetHelper
        ) {
            $this->view = $view;
            $this->source = $source;
            $this->targetHelper = $targetHelper;
        }

        function showList(): string {
            $appList = $this->source->getList();
            $clientAppKeys = $this->targetHelper->getClientAppKeys();
            $otherAppKeys = $this->targetHelper->getOtherAppKeys();

            $clientApps = array_map(function ($key) use ($appList) {
                return AppItemMapper::toViewModel($appList[$key]);
            }, $clientAppKeys);

            $otherApps = array_map(function ($key) use ($appList) {
                return AppItemMapper::toViewModel($appList[$key]);
            }, $otherAppKeys);

            return $this->view->render($clientApps, $otherApps);
        }
    }

