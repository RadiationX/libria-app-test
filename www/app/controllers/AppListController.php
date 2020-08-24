<?php
    declare(strict_types=1);

    namespace app\controllers;

    use app\common\AppsTargetHelper;
    use app\models\AppMapper;
    use app\sources\AppDetailSource;
    use app\sources\AppItemSource;
    use app\views\AppListView;

    class AppListController {

        private AppListView $view;
        private AppItemSource $itemSource;
        private AppDetailSource $detailSource;

        /**
         * AppListController constructor.
         * @param AppListView $view
         * @param AppItemSource $itemSource
         * @param AppDetailSource $detailSource
         */
        public function __construct(
            AppListView $view,
            AppItemSource $itemSource,
            AppDetailSource $detailSource
        ) {
            $this->view = $view;
            $this->itemSource = $itemSource;
            $this->detailSource = $detailSource;
        }

        function showList(): string {
            $appList = $this->itemSource->getList();
            $clientAppKeys = AppsTargetHelper::getClientAppKeys();
            $otherAppKeys = AppsTargetHelper::getOtherAppKeys();

            $clientApps = array_map(function ($key) use ($appList) {
                return AppMapper::toItemViewModel(
                    $appList[$key],
                    $this->detailSource->getDetail($key)
                );
            }, $clientAppKeys);

            $otherApps = array_map(function ($key) use ($appList) {
                return AppMapper::toItemViewModel(
                    $appList[$key],
                    $this->detailSource->getDetail($key)
                );
            }, $otherAppKeys);

            return $this->view->render($clientApps, $otherApps);
        }
    }

